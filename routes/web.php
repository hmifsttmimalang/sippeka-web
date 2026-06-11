<?php

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\AuthController;
use App\Livewire\Admin\AnnouncementManager;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\EvaluationManager;
use App\Livewire\Admin\MajorManager;
use App\Livewire\Admin\QuestionManager;
use App\Livewire\Admin\RegistrationList;
use App\Livewire\Admin\RegistrationResultList;
use App\Livewire\Admin\SkillManager;
use App\Livewire\Admin\SkillTestManager;
use App\Livewire\Admin\SkillTestSessionManager;
use App\Livewire\Admin\SubjectManager;
use App\Livewire\Admin\TestScheduleManager;
use App\Livewire\Admin\UserManager;
use App\Livewire\Public\SelectionAnnouncement;
use App\Livewire\Public\TrainingInfo;
use App\Livewire\Registration\Wizard;
use App\Livewire\Student\Dashboard as StudentDashboard;
use App\Livewire\Student\EditProfile;
use App\Livewire\Student\SelectionTest;
use App\Livewire\Student\SimulationTest;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::get('/training-info', TrainingInfo::class)->name('public.training_info');
Route::get('/announcements', SelectionAnnouncement::class)->name('public.selection_announcement');

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.store');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.store');
Route::post('/logout-action', [AuthController::class, 'logout'])->name('auth.logout');

// Add standard 'login' and 'register' routes for Laravel compatibility
Route::get('/login-redirect', function () {
    return redirect()->route('auth.login');
})->name('login');

Route::get('/register-redirect', function () {
    return redirect()->route('auth.register');
})->name('register');

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin Routes
    Route::get('/admin', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/registrations', RegistrationList::class)->name('admin.registration_list');
    Route::get('/admin/question-titles', SubjectManager::class)->name('admin.question_title_manager');
    Route::get('/admin/skills', SkillManager::class)->name('admin.skills');
    Route::get('/admin/skill-tests', SkillTestManager::class)->name('admin.skill_test_manager');
    Route::get('/admin/skill-test-sessions', SkillTestSessionManager::class)->name('admin.skill_test_sessions');
    Route::get('/admin/skill-tests/{testId}/questions', QuestionManager::class)->name('admin.question_manager');
    Route::get('/admin/users', UserManager::class)->name('admin.user_manager');
    Route::get('/admin/evaluations', EvaluationManager::class)->name('admin.evaluation_manager');
    Route::get('/admin/participants', RegistrationResultList::class)->name('admin.participants');
    Route::get('/admin/majors', MajorManager::class)->name('admin.majors');
    Route::get('/admin/test-schedules', TestScheduleManager::class)->name('admin.test_schedules');
    Route::get('/admin/announcements', AnnouncementManager::class)->name('admin.announcements');

    // Reports
    Route::get('/admin/reports/registration/{id}', [ReportController::class, 'downloadRegistrationPdf'])->name('admin.reports.registration');
    Route::get('/admin/reports/participants', [ReportController::class, 'downloadParticipantsPdf'])->name('admin.reports.participants');
});

Route::middleware(['auth', 'role:instructor'])->group(function () {
    // Instructor Routes
    Route::get('/instructor', App\Livewire\Instructor\Dashboard::class)->name('instructor.dashboard');
    Route::get('/instructor/manage', EvaluationManager::class)->name('instructor.evaluation_manager');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    // Student & Registration Routes
    Route::get('/registration', Wizard::class)->name('registration.form');
    Route::get('/edit-profile', EditProfile::class)->name('student.edit_profile');
    Route::get('/simulation/{sessionId}', SimulationTest::class)->name('student.simulation');
    Route::get('/selection/{sessionId}', SelectionTest::class)->name('student.selection');

    // User dashboard
    Route::get('/dashboard', StudentDashboard::class)->name('user.dashboard');

    // Legacy JS Redirects
    Route::get('/{username}/simulation/result', function ($username) {
        return redirect()->route('user.dashboard', ['username' => $username]);
    });
    Route::get('/{username}/selection/result', function ($username) {
        return redirect()->route('user.dashboard', ['username' => $username]);
    });
    Route::get('/{username}/simulation/timeout', function ($username) {
        return redirect()->route('user.dashboard', ['username' => $username])->with('error', 'Simulation time has ended.');
    });
    Route::get('/{username}/selection/timeout', function ($username) {
        return redirect()->route('user.dashboard', ['username' => $username])->with('error', 'Selection time has ended.');
    });
});

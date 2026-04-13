<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\RegistrationList;
use App\Livewire\Admin\QuestionTitleManager;
use App\Livewire\Admin\SkillTestManager;
use App\Livewire\Admin\QuestionManager;
use App\Livewire\Admin\UserManager;
use App\Livewire\Admin\EvaluationManager;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\AuthController;
use App\Livewire\Registration\Wizard;
use App\Livewire\Student\Dashboard as StudentDashboard;
use App\Livewire\Student\Examination;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.store');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.store');
Route::post('/logout-action', [AuthController::class, 'logout'])->name('logout');

// Add standard 'login' and 'register' routes for Laravel compatibility
Route::get('/login-redirect', function() {
    return redirect()->route('auth.login');
})->name('login');

Route::get('/register-redirect', function() {
    return redirect()->route('auth.register');
})->name('register');

Route::middleware(['auth'])->group(function () {
    // Admin Routes
    Route::get('/admin', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/pendaftar', RegistrationList::class)->name('admin.registration_list');
    Route::get('/admin/mata-soal', QuestionTitleManager::class)->name('admin.question_title_manager');
    Route::get('/admin/tes-keahlian', SkillTestManager::class)->name('admin.skill_test_manager');
    Route::get('/admin/tes-keahlian/{testId}/soal', QuestionManager::class)->name('admin.question_manager');
    Route::get('/admin/users', UserManager::class)->name('admin.user_manager');
    Route::get('/admin/evaluasi', EvaluationManager::class)->name('admin.evaluation_manager');

    // Reports
    Route::get('/admin/reports/registration/{id}', [ReportController::class, 'downloadRegistrationPdf'])->name('admin.reports.registration');

    // Instructor / Instruktur Routes
    Route::get('/instruktur', EvaluationManager::class)->name('instruktur.dashboard');
    Route::get('/instruktur/kelola', EvaluationManager::class)->name('instruktur.kelola_data');

    // Student & Registration Routes
    Route::get('/pendaftaran', Wizard::class)->name('pendaftaran.form');
    Route::get('/dashboard', StudentDashboard::class)->name('student.dashboard');
    Route::get('/ujian/{sessionId}', Examination::class)->name('student.examination');
});

<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\RegistrationList;
use App\Livewire\Admin\QuestionTitleManager;
use App\Livewire\Admin\SkillTestManager;
use App\Livewire\Admin\QuestionManager;
use App\Livewire\Admin\UserManager;
use App\Livewire\Admin\EvaluationManager;
use App\Livewire\Admin\PesertaList;
use App\Livewire\Admin\JurusanManager;
use App\Livewire\Admin\SkillManager;
use App\Livewire\Admin\JadwalTesManager;
use App\Livewire\Admin\AnnouncementManager;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\AuthController;
use App\Livewire\Registration\Wizard;
use App\Livewire\Student\Dashboard as StudentDashboard;
use App\Livewire\Student\Examination;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::get('/informasi-pelatihan', \App\Livewire\Public\TrainingInfo::class)->name('public.training_info');
Route::get('/pengumuman', \App\Livewire\Public\SelectionAnnouncement::class)->name('public.selection_announcement');

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.store');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.store');
Route::post('/logout-action', [AuthController::class, 'logout'])->name('auth.logout');

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
    Route::get('/admin/kelas-keahlian', SkillManager::class)->name('admin.kelas_keahlian');
    Route::get('/admin/tes-keahlian', SkillTestManager::class)->name('admin.skill_test_manager');
    Route::get('/admin/sesi-tes-keahlian', \App\Livewire\Admin\SkillTestSessionManager::class)->name('admin.sesi_tes_keahlian');
    Route::get('/admin/tes-keahlian/{testId}/soal', QuestionManager::class)->name('admin.question_manager');
    Route::get('/admin/users', UserManager::class)->name('admin.user_manager');
    Route::get('/admin/evaluasi', EvaluationManager::class)->name('admin.evaluation_manager');
    Route::get('/admin/peserta', PesertaList::class)->name('admin.peserta');
    Route::get('/admin/jurusan', JurusanManager::class)->name('admin.info_jurusan');
    Route::get('/admin/jadwal', JadwalTesManager::class)->name('admin.jadwal_tes');
    Route::get('/admin/pengumuman', AnnouncementManager::class)->name('admin.pengumuman');

    // Reports
    Route::get('/admin/reports/registration/{id}', [ReportController::class, 'downloadRegistrationPdf'])->name('admin.reports.registration');
    Route::get('/admin/reports/participants', [ReportController::class, 'downloadParticipantsPdf'])->name('admin.reports.participants');

    // Instructor / Instruktur Routes
    Route::get('/instruktur', \App\Livewire\Instructor\Dashboard::class)->name('instruktur.dashboard');
    Route::get('/instruktur/kelola', EvaluationManager::class)->name('instruktur.kelola_data');

    // Student & Registration Routes
    Route::get('/pendaftaran', Wizard::class)->name('pendaftaran.form');
    Route::get('/dashboard/{username?}', StudentDashboard::class)->name('user.dashboard');
    Route::get('/profil/edit', \App\Livewire\Student\EditProfile::class)->name('student.edit_profile');
    Route::get('/ujian/{sessionId}', Examination::class)->name('student.examination');
});

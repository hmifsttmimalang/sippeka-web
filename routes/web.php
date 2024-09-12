<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// otentikasi login dan register akun
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// halaman admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/kelola_data', [AdminController::class, 'kelolaData'])->name('admin.kelola_data');
    Route::get('/admin/peserta', [AdminController::class, 'peserta'])->name('admin.peserta');
    Route::get('/admin/info_user', [AdminController::class, 'infoUser'])->name('info.user');
    Route::get('/admin/kelola_data/detail_pendaftar/{user_id}', [AdminController::class, 'show'])->name('admin.detail_pendaftar');

    // mata soal
    Route::get('/admin/mata_soal_keahlian', function () {
        return view('admin.mata-soal.mata-soal');
    })->name('admin.mata_soal_keahlian');
    Route::get('/admin/mata_soal_keahlian/tambah_mata_keahlian', function () {
        return view('admin.mata-soal.tambah-mata-soal');
    });
    Route::get('/admin/mata_soal_keahlian/edit_mata_soal_keahlian/{id}', function () {
        return view('admin.mata-soal.edit-mata-soal');
    });
    Route::get('/admin/mata_soal_keahlian/hapus_mata_soal_keahlian/{id}', function () {
        return view('');
    });

    // keahlian
    Route::get('/admin/kelas_keahlian', [AdminController::class, 'indexKeahlian'])->name('kelas_keahlian.index');
    Route::get('/admin/kelas_keahlian/tambah_kelas_keahlian', [AdminController::class, 'createKeahlian'])->name('keahlian.create');
    Route::post('/admin/kelas_keahlian/tambah_kelas_keahlian', [AdminController::class, 'storeKeahlian'])->name('kelas_keahlian.store');
    Route::get('/admin/kelas_keahlian/edit_kelas_keahlian/{id}', [AdminController::class, 'editKeahlian'])->name('keahlian.edit');
    Route::put('/admin/kelas_keahlian/update_kelas_keahlian/{id}', [AdminController::class, 'updateKeahlian'])->name('kelas_keahlian.update');
    Route::get('/admin/kelas_keahlian/hapus_kelas_keahlian/{id}', [AdminController::class, 'destroyKeahlian'])->name('keahlian.destroy');

    // tes keahlian
    Route::get('/admin/tes_keahlian', function () {
        return view('admin.tes-keahlian.tes-keahlian');
    })->name('admin.tes_keahlian');
    Route::get('/admin/tes_keahlian/tambah_tes_keahlian', function () {
        return view('admin.tes-keahlian.tambah-tes-keahlian');
    });
    Route::get('/admin/tes_keahlian/edit_tes_keahlian/{id}', function () {
        return view('admin.tes-keahlian.edit-tes-keahlian');
    });
    Route::get('/admin/tes_keahlian/hapus_tes_keahlian/{id}', function () {
        return view('');
    });
    
    // soal tes
    Route::get('/admin/tes_keahlian/detail_ujian', function () {
        return view('admin.tes-keahlian.soal-tes.detail-tes-keahlian');
    });
    Route::get('/admin/tes_keahlian/detail_ujian/{id}/tambah_soal_tes_keahlian', function () {
        return view('admin.tes-keahlian.soal-tes.tambah-soal-tes-keahlian');
    });
    Route::get('/admin/tes_keahlian/detail_ujian/{id}/import_soal_tes_keahlian', function () {
        return view('admin.tes-keahlian.soal-tes.import-soal-tes-keahlian');
    });
    Route::get('/admin/tes_keahlian/detail_ujian/edit_soal_tes_keahlian/{id}', function () {
        return view('admin.tes-keahlian.soal-tes.edit-soal-tes-keahlian');
    });
    Route::get('/admin/tes_keahlian/detail_ujian/hapus_soal_tes_keahlian/{id}', function () {
        return view('');
    });

    // sesi tes
    Route::get('/admin/sesi_tes_keahlian', function () {
        return view('admin.sesi-tes-keahlian.sesi-tes-keahlian');
    })->name('admin.sesi_tes_keahlian');
    Route::get('/admin/sesi_tes_keahlian/tambah_sesi_tes_keahlian', function () {
        return view('admin.sesi-tes-keahlian.tambah-sesi-tes-keahlian');
    });
    Route::get('/admin/sesi_tes_keahlian/edit_sesi_tes_keahlian/{id}', function () {
        return view('admin.sesi-tes-keahlian.edit-sesi-tes-keahlian');
    });
    Route::get('/admin/sesi_tes_keahlian/detail_sesi_tes_keahlian/{id}', function () {
        return view('admin.sesi-tes-keahlian.detail-sesi-tes-keahlian');
    });
    Route::get('/admin/sesi_tes_keahlian/hapus_sesi_tes_keahlian/{id}', function () {
        return view('');
    });
});

// halaman user
Route::group(['middleware' => 'user'], function () {

    // pendaftaran
    Route::get('/pendaftaran', [RegistrationController::class, 'index'])->name('pendaftaran.form_registrasi');
    Route::post('/pendaftaran', [RegistrationController::class, 'register'])->name('pendaftaran.register');
    Route::get('/pendaftaran/terkirim', [RegistrationController::class, 'registered'])->name('pendaftaran.terkirim');
    Route::get('/pendaftaran/terdaftar', [RegistrationController::class, 'isRegistered'])->name('pendaftaran.terdaftar');

    // dashboard user
    Route::get('/user/{username}', [UserController::class, 'index'])->name('user.dashboard');
});

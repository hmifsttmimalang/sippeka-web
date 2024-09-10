<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('home');
})->name('home');

// otentikasi login dan register akun
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get();

// halaman admin
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/kelola_data', function () {
        return view('admin.kelola-data');
    });
    Route::get('/admin/peserta', function () {
        return view('admin.peserta');
    });
    Route::get('/admin/info_user', function () {
        return view('admin.info-user');
    });
    Route::get('/admin/detail_pendaftar/{id}', function () {
        return view('admin.detail-pendaftar');
    });

    // mata soal
    Route::get('/admin/mata_soal_keahlian', function () {
        return view('admin.mata-soal.mata-soal');
    });
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
    Route::get('/admin/kelas_keahlian', function () {
        return view('admin.keahlian.keahlian');
    });
    Route::get('/admin/kelas_keahlian/tambah_kelas_keahlian', function () {
        return view('admin.keahlian.tambah-keahlian');
    });
    Route::get('/admin/kelas_keahlian/edit_kelas_keahlian/{id}', function () {
        return view('admin.keahlian.edit-keahlian');
    });
    Route::get('/admin/kelas_keahlian/hapus_kelas_keahlian/{id}', function () {
        return view('');
    });

    // tes keahlian
    Route::get('/admin/tes_keahlian', function () {
        return view('admin.tes-keahlian.tes-keahlian');
    });
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
    });
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
    Route::get('/pendaftaran', function () {
        return view('pendaftaran.index');
    });
});

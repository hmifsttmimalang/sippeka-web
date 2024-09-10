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


    // soal tes


    // sesi tes

});

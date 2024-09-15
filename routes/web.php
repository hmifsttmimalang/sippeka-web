<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SelectionTestController;
use App\Http\Controllers\SimulationTestController;
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

// Otentikasi login dan register akun
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman admin
Route::group(['middleware' => 'admin'], function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/kelola-data', [AdminController::class, 'kelolaData'])->name('admin.kelola_data');
    Route::get('/admin/peserta', [AdminController::class, 'peserta'])->name('admin.peserta');
    Route::get('/admin/info-user', [AdminController::class, 'infoUser'])->name('admin.info_user');

    Route::get('/admin/kelola-data/pendaftar/{user_id}', [AdminController::class, 'detailPendaftar'])->name('admin.detail_pendaftar');
    Route::post('/admin/kelola-data/pendaftar/{user_id}', [AdminController::class, 'validasiTesWawancara'])->name('admin.validasi_wawancara');

    // Mata soal
    Route::get('/admin/mata-soal', [AdminController::class, 'indexMataSoal'])->name('admin.mata_soal');
    Route::get('/admin/mata-soal/tambah', [AdminController::class, 'createMataSoal'])->name('admin.mata_soal.create');
    Route::post('/admin/mata-soal/tambah', [AdminController::class, 'storeMataSoal'])->name('admin.mata_soal.store');
    Route::get('/admin/mata-soal/{id}/edit', [AdminController::class, 'editMataSoal'])->name('admin.mata_soal.edit');
    Route::put('/admin/mata-soal/{id}', [AdminController::class, 'updateMataSoal'])->name('admin.mata_soal.update');
    Route::delete('/admin/mata-soal/{id}', [AdminController::class, 'hapusMataSoal'])->name('admin.mata_soal.delete');

    // Kelas keahlian
    Route::get('/admin/kelas-keahlian', [AdminController::class, 'indexKeahlian'])->name('admin.kelas_keahlian');
    Route::get('/admin/kelas-keahlian/tambah', [AdminController::class, 'createKeahlian'])->name('admin.kelas_keahlian.create');
    Route::post('/admin/kelas-keahlian/tambah', [AdminController::class, 'storeKeahlian'])->name('admin.kelas_keahlian.store');
    Route::get('/admin/kelas-keahlian/{id}/edit', [AdminController::class, 'editKeahlian'])->name('admin.kelas_keahlian.edit');
    Route::put('/admin/kelas-keahlian/{id}', [AdminController::class, 'updateKeahlian'])->name('admin.kelas_keahlian.update');
    Route::delete('/admin/kelas-keahlian/{id}', [AdminController::class, 'destroyKeahlian'])->name('admin.kelas_keahlian.delete');

    // Tes keahlian
    Route::get('/admin/tes-keahlian', [AdminController::class, 'tesKeahlian'])->name('admin.tes_keahlian');
    Route::get('/admin/tes-keahlian/tambah', [AdminController::class, 'tambahTesKeahlian'])->name('admin.tes_keahlian.create');
    Route::post('/admin/tes-keahlian/tambah', [AdminController::class, 'simpanTesKeahlian'])->name('admin.tes_keahlian.store');
    Route::get('/admin/tes-keahlian/{id}/edit', [AdminController::class, 'editTesKeahlian'])->name('admin.tes_keahlian.edit');
    Route::put('/admin/tes-keahlian/{id}', [AdminController::class, 'updateTesKeahlian'])->name('admin.tes_keahlian.update');
    Route::delete('/admin/tes-keahlian/{id}', [AdminController::class, 'hapusTesKeahlian'])->name('admin.tes_keahlian.delete');

    // Soal tes keahlian
    Route::get('/admin/tes-keahlian/{id}/detail', [AdminController::class, 'detailUjian'])->name('admin.ujian.detail');
    Route::get('/admin/tes-keahlian/{id}/soal/tambah', [AdminController::class, 'tambahSoalTesKeahlian'])->name('admin.soal.create');
    Route::post('/admin/tes-keahlian/{id}/soal/tambah', [AdminController::class, 'simpanSoalTesKeahlian'])->name('admin.soal.store');
    Route::get('/admin/tes-keahlian/{id}/soal/import', [AdminController::class, 'importSoalTesKeahlian'])->name('admin.soal.import');
    Route::get('/admin/tes-keahlian/{id}/soal/{soal_id}/edit', [AdminController::class, 'editSoalTesKeahlian'])->name('admin.soal.edit');
    Route::put('/admin/tes-keahlian/{id}/soal/{soal_id}', [AdminController::class, 'updateSoalTesKeahlian'])->name('admin.soal.update');
    Route::delete('/admin/tes-keahlian/{id}/soal/{soal_id}', [AdminController::class, 'hapusSoalTesKeahlian'])->name('admin.soal.delete');

    // Sesi tes keahlian
    Route::get('/admin/sesi-tes-keahlian', [AdminController::class, 'sesiTesKeahlian'])->name('admin.sesi_tes_keahlian');
    Route::get('/admin/sesi-tes-keahlian/tambah', [AdminController::class, 'tambahSesiTesKeahlian'])->name('admin.sesi_tes_keahlian.create');
    Route::post('/admin/sesi-tes-keahlian/tambah', [AdminController::class, 'simpanSesiTesKeahlian'])->name('admin.sesi_tes_keahlian.store');
    Route::get('/admin/sesi-tes-keahlian/{id}', [AdminController::class, 'detailSesiTesKeahlian'])->name('admin.sesi_tes_keahlian.detail');
    Route::get('/admin/sesi-tes-keahlian/{id}/edit', [AdminController::class, 'editSesiTesKeahlian'])->name('admin.sesi_tes_keahlian.edit');
    Route::put('/admin/sesi-tes-keahlian/{id}', [AdminController::class, 'updateSesiTesKeahlian'])->name('admin.sesi_tes_keahlian.update');
    Route::delete('/admin/sesi-tes-keahlian/{id}', [AdminController::class, 'hapusSesiTesKeahlian'])->name('admin.sesi_tes_keahlian.delete');
});

// Halaman user
Route::group(['middleware' => 'user'], function () {

    // Pendaftaran
    Route::get('/pendaftaran', [RegistrationController::class, 'index'])->name('pendaftaran.form');
    Route::post('/pendaftaran', [RegistrationController::class, 'register'])->name('pendaftaran.store');
    Route::get('/pendaftaran/terkirim', [RegistrationController::class, 'registered'])->name('pendaftaran.terkirim');
    Route::get('/pendaftaran/terdaftar', [RegistrationController::class, 'isRegistered'])->name('pendaftaran.terdaftar');

    // Dashboard user
    Route::get('/{username}', [UserController::class, 'index'])->name('user.dashboard');
    Route::post('/{username}/simulasi-login', [AuthController::class, 'loginSimulasi'])->name('user.simulasi_login');
    Route::get('/{username}/seleksi-login', [UserController::class, 'formTesSeleksi'])->name('user.seleksi_login');
    Route::post('/{username}/seleksi-login', [AuthController::class, 'loginSeleksi'])->name('user.seleksi_login.store');
    Route::get('/{username}/edit-profil', [UserController::class, 'editProfil'])->name('user.edit_profil');
    Route::post('/{username}/edit-profil', [UserController::class, 'updateProfil'])->name('user.update_profil');

    // Halaman tes simulasi
    Route::get('/{username}/simulasi', [SimulationTestController::class, 'index'])->middleware('cekPendaftaran')->name('user.simulasi');
    Route::post('/{username}/simulasi', [SimulationTestController::class, 'kirimJawabanSimulasi'])->middleware('cekPendaftaran')->name('user.simulasi.store');
    Route::get('/{username}/hasil-simulasi', [SimulationTestController::class, 'hasilSimulasi'])->middleware('cekPendaftaran')->name('user.hasil_simulasi');
    Route::get('/{username}/simulasi-habis', [SimulationTestController::class, 'waktuSimulasiHabis'])->middleware('cekPendaftaran')->name('user.simulasi_habis');

    // Halaman tes seleksi
    Route::get('/{username}/seleksi', [SelectionTestController::class, 'index'])->middleware('cekPendaftaran')->name('user.seleksi');
    Route::post('/{username}/seleksi', [SelectionTestController::class, 'kirimJawabanSeleksi'])->middleware('cekPendaftaran')->name('user.seleksi.store');
    Route::get('/{username}/seleksi-terkirim', [SelectionTestController::class, 'tesTerkirim'])->middleware('cekPendaftaran')->name('user.seleksi_terkirim');
    Route::get('/{username}/seleksi-selesai', [SelectionTestController::class, 'tesSelesai'])->middleware('cekPendaftaran')->name('user.seleksi_selesai');
    Route::get('/{username}/seleksi-habis', [SelectionTestController::class, 'waktuSeleksiHabis'])->middleware('cekPendaftaran')->name('user.seleksi_habis');
});

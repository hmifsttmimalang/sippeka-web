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

// otentikasi login dan register akun
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// halaman admin
Route::group(['middleware' => 'admin'], function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/kelola_data', [AdminController::class, 'kelolaData'])->name('admin.kelola_data');
    Route::get('/admin/peserta', [AdminController::class, 'peserta'])->name('admin.peserta');
    Route::get('/admin/info_user', [AdminController::class, 'infoUser'])->name('info.user');
    Route::get('/admin/kelola_data/detail_pendaftar/{user_id}', [AdminController::class, 'detailPendaftar'])->name('admin.detail_pendaftar');
    Route::post('/admin/kelola_data/detail_pendaftar/{user_id}', [AdminController::class, 'validasiTesWawancara'])->name('admin.validasi_wawancara');

    // mata soal
    Route::get('/admin/mata_soal_keahlian', [AdminController::class, 'indexMataSoal'])->name('admin.mata_soal_keahlian');
    Route::get('/admin/mata_soal_keahlian/tambah_mata_keahlian', [AdminController::class, 'createMataSoal'])->name('admin.tambah-mata-soal-keahlian');
    Route::post('/admin/mata_soal_keahlian/tambah_mata_keahlian', [AdminController::class, 'storeMataSoal'])->name('admin.tambah-mata-soal-keahlian');
    Route::get('/admin/mata_soal_keahlian/edit_mata_soal_keahlian/{id}', [AdminController::class, 'editMataSoal'])->name('admin.edit-mata-soal');
    Route::put('/admin/mata_soal_keahlian/edit_mata_soal_keahlian/{id}', [AdminController::class, 'updateMataSoal'])->name('admin.update-mata-soal');
    Route::get('/admin/mata_soal_keahlian/hapus_mata_soal_keahlian/{id}', [AdminController::class, 'hapusMataSoal']);

    // keahlian
    Route::get('/admin/kelas_keahlian', [AdminController::class, 'indexKeahlian'])->name('kelas_keahlian.index');
    Route::get('/admin/kelas_keahlian/tambah_kelas_keahlian', [AdminController::class, 'createKeahlian'])->name('keahlian.create');
    Route::post('/admin/kelas_keahlian/tambah_kelas_keahlian', [AdminController::class, 'storeKeahlian'])->name('kelas_keahlian.store');
    Route::get('/admin/kelas_keahlian/edit_kelas_keahlian/{id}', [AdminController::class, 'editKeahlian'])->name('keahlian.edit');
    Route::put('/admin/kelas_keahlian/update_kelas_keahlian/{id}', [AdminController::class, 'updateKeahlian'])->name('kelas_keahlian.update');
    Route::get('/admin/kelas_keahlian/hapus_kelas_keahlian/{id}', [AdminController::class, 'destroyKeahlian'])->name('keahlian.destroy');

    // tes keahlian
    Route::get('/admin/tes_keahlian', [AdminController::class, 'tesKeahlian'])->name('admin.tes_keahlian');
    Route::get('/admin/tes_keahlian/tambah_tes_keahlian', [AdminController::class, 'tambahTesKeahlian'])->name('admin.tambah_tes_keahlian');
    Route::post('/admin/tes_keahlian/tambah_tes_keahlian', [AdminController::class, 'simpanTesKeahlian'])->name('tes_keahlian.store');
    Route::get('/admin/tes_keahlian/edit_tes_keahlian/{id}', [AdminController::class, 'editTesKeahlian'])->name('admin.edit-tes-keahlian');
    Route::put('/admin/tes_keahlian/edit_tes_keahlian/{id}', [AdminController::class, 'updateTesKeahlian'])->name('admin.update-tes-keahlian');
    Route::get('/admin/tes_keahlian/hapus_tes_keahlian/{id}', [AdminController::class, 'hapusTesKeahlian'])->name('admin.hapus-tes-keahlian');
    
    // soal tes
    Route::get('/admin/tes_keahlian/detail_ujian/{id}', [AdminController::class, 'detailUjian'])->name('admin.detail-ujian');
    Route::get('/admin/tes_keahlian/detail_ujian/{id}/tambah_soal_tes_keahlian', [AdminController::class, 'tambahSoalTesKeahlian'])->name('tambah-soal');
    Route::post('/admin/tes_keahlian/detail_ujian/{id}/tambah_soal_tes_keahlian', [AdminController::class, 'simpanSoalTesKeahlian'])->name('simpan-soal');
    Route::get('/admin/tes_keahlian/detail_ujian/{id}/import_soal_tes_keahlian', [AdminController::class, 'importSoalTesKeahlian'])->name('import-soal');
    Route::get('/admin/tes_keahlian/detail_ujian/{id}/edit_soal_tes_keahlian/{soal_id}', [AdminController::class, 'editSoalTesKeahlian'])->name('edit-soal');
    Route::put('/admin/tes_keahlian/detail_ujian/{id}/edit_soal_tes_keahlian/{soal_id}', [AdminController::class, 'updateSoalTesKeahlian'])->name('update-soal');
    Route::get('/admin/tes_keahlian/detail_ujian/{id}/hapus_soal_tes_keahlian/{soal_id}', [AdminController::class, 'hapusSoalTesKeahlian'])->name('hapus-soal');

    // sesi tes
    Route::get('/admin/sesi_tes_keahlian', [AdminController::class, 'sesiTesKeahlian'])->name('admin.sesi_tes_keahlian');
    Route::get('/admin/sesi_tes_keahlian/tambah_sesi_tes_keahlian', [AdminController::class, 'tambahSesiTesKeahlian']);
    Route::post('/admin/sesi_tes_keahlian/tambah_sesi_tes_keahlian', [AdminController::class, 'simpanSesiTesKeahlian'])->name('admin.simpan_tes_keahlian');
    Route::get('/admin/sesi_tes_keahlian/detail_sesi_tes_keahlian/{id}', [AdminController::class, 'detailSesiTesKeahlian'])->name('admin.detail_sesi_tes_keahlian');
    Route::get('/admin/sesi_tes_keahlian/edit_sesi_tes_keahlian/{id}', [AdminController::class, 'editSesiTesKeahlian'])->name('admin.edit_sesi_tes_keahlian');
    Route::put('/admin/sesi_tes_keahlian/edit_sesi_tes_keahlian/{id}', [AdminController::class, 'updateSesiTesKeahlian'])->name('admin.update_sesi_tes_keahlian');
    Route::get('/admin/sesi_tes_keahlian/hapus_sesi_tes_keahlian/{id}', [AdminController::class, 'hapusSesiTesKeahlian'])->name('admin.hapus_sesi_tes_keahlian');
});

// halaman user
Route::group(['middleware' => 'user'], function () {

    // pendaftaran
    Route::get('/pendaftaran', [RegistrationController::class, 'index'])->name('pendaftaran.form_registrasi');
    Route::post('/pendaftaran', [RegistrationController::class, 'register'])->name('pendaftaran.register');
    Route::get('/pendaftaran/terkirim', [RegistrationController::class, 'registered'])->name('pendaftaran.terkirim');
    Route::get('/pendaftaran/terdaftar', [RegistrationController::class, 'isRegistered'])->name('pendaftaran.terdaftar');
    
    // dashboard user
    Route::get('/{username}', [UserController::class, 'index'])->name('user');
    Route::post('/{username}/login_simulasi', [AuthController::class, 'loginSimulasi'])->name('login_simulasi');
    Route::get('/{username}/login_seleksi', [UserController::class, 'formTesSeleksi'])->name('user.login_seleksi');
    Route::post('/{username}/login_seleksi', [AuthController::class, 'loginSeleksi'])->name('login_seleksi');
    Route::get('/{username}/edit_profil', [UserController::class, 'editProfil'])->name('user.edit_profil');
    Route::post('/{username}/edit_profil', [UserController::class, 'updateProfil'])->name('user.update_profil');

    // halaman tes simulasi
    Route::get('/{username}/simulasi', [SimulationTestController::class, 'index'])->middleware('cekPendaftaran')->name('simulasi_peserta');
    Route::post('/{username}/simulasi', [SimulationTestController::class, 'kirimJawabanSimulasi'])->middleware('cekPendaftaran')->name('kirim_jawaban_simulasi');
    Route::get('/{username}/hasil_simulasi', [SimulationTestController::class, 'hasilSimulasi'])->middleware('cekPendaftaran')->name('hasil_simulasi');
    Route::get('/{username}/waktu_simulasi_habis', [SimulationTestController::class, 'waktuSimulasiHabis'])->middleware('cekPendaftaran')->name('waktu_simulasi_habis');
    
    // halaman tes seleksi
    Route::get('/{username}/seleksi', [SelectionTestController::class, 'index'])->middleware('cekPendaftaran')->name('seleksi_peserta');
    Route::post('/{username}/seleksi', [SelectionTestController::class, 'kirimJawabanSeleksi'])->middleware('cekPendaftaran')->name('kirim_jawaban_seleksi');
    Route::get('/{username}/terkirim', [SelectionTestController::class, 'tesTerkirim'])->middleware('cekPendaftaran')->name('seleksi_terkirim');
    Route::get('/{username}/tes_selesai', [SelectionTestController::class, 'tesSelesai'])->middleware('cekPendaftaran')->name('seleksi_selesai');    
    Route::get('/{username}/waktu_habis', [SelectionTestController::class, 'waktuSeleksiHabis'])->middleware('cekPendaftaran')->name('waktu_seleksi_habis');
});

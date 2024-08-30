<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

// otentikasi
Route::get('/login', function () {
    // return view('index');
});
Route::get('/register', function () {
    // return view('index');
});
Route::get('/logout', function () {
    // return view('index');
});

// otentikasi untuk simulasi
Route::get('/login_simulasi', function () {
    // return view('index');
});

// otentikasi untuk seleksi
Route::get('/login_seleksi', function () {
    // return view('index');
});

// pendaftaran
Route::get('/pendaftaran', function () {
    // return view('index');
});

Route::get('/pendaftaran/terdaftar', function () {
    // return view('index');
});

// user
Route::get('/user', function () {
    // return view('index');
});

Route::get('/user/tes_seleksi', function () {
    // return view('index');
});

Route::get('/user/edit_profil', function () {
    // return view('index');
});

// simulasi peserta
Route::get('/simulasi_peserta', function () {
    // return view('index');
});

Route::get('/simulasi_peserta/hasil_simulasi', function () {
    // return view('index');
});

// seleksi peserta
Route::get('/seleksi_peserta', function () {
    // return view('index');
});

// admin
Route::get('/admin', function () {
    // return view('index');
});

Route::get('/admin/kelola_data', function () {
    // return view('index');
});

Route::get('/admin/kelola_data/detail_pendaftar/{id}', function () {
    // return view('index');
});

Route::get('/admin/peserta', function () {
    // return view('index');
});

Route::get('/admin/info_user', function () {
    // return view('index');
});


// admin -> mata soal
Route::get('/admin/mata_soal', function () {
    // return view('index');
});


// admin -> kelas keahlian
Route::get('/admin/keahlian', function () {
    // return view('index');
});


// admin -> tes keahlian
Route::get('/admin/tes_keahlian', function () {
    // return view('index');
});


// admin -> tes keahlian -> soal tes
Route::get('/admin/tes_keahlian/detail_tes/{id}', function () {
    // return view('index');
});


// admin -> sesi tes keahlian
Route::get('/admin/sesi_tes_keahlian', function () {
    // return view('index');
});

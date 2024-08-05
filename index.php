<?php
session_start();
require 'controllers/AuthController.php';
require_once 'connection/database.php';

// Autoload controllers
spl_autoload_register(function ($class_name) {
    if (file_exists('controllers/' . $class_name . '.php')) {
        include 'controllers/' . $class_name . '.php';
    } elseif (file_exists('models/' . $class_name . '.php')) {
        include 'models/' . $class_name . '.php';
    }
});

// Function to handle routing
function route($uri) {
    $routes = [
        '/' => 'HomeController@index',

        // otentikasi
        '/login' => 'AuthController@showLogin',
        '/register' => 'AuthController@showRegister',
        '/auth/login' => 'AuthController@login',
        '/auth/register' => 'AuthController@register',
        '/logout' => 'AuthController@logout',

        // otentikasi untuk simulasi
        '/auth/login_simulasi' => 'AuthController@loginSimulasi',

        // otentikasi untuk masuk seleksi
        '/auth/login_seleksi' => 'AuthController@loginSeleksi',

        // pendaftaran
        '/pendaftaran' => 'RegistrationController@index',
        '/pendaftaran/proses' => 'RegistrationController@register',
        '/pendaftaran/terdaftar' => 'RegistrationController@registered',

        // user
        '/user' => 'UserController@index',
        '/user/tes_seleksi' => 'UserController@showSeleksi',
        '/user/edit_profil' => 'UserController@editProfil',

        // simulasi peserta
        '/simulasi_peserta' => 'SeleksiController@simulasi',

        // seleksi peserta
        '/seleksi_peserta' => 'SeleksiController@tesSeleksi',

        // admin
        '/admin' => 'AdminController@index',
        '/admin/kelola_data' => 'AdminController@kelolaData',
        '/admin/kelola_data/detail_pendaftar' => 'AdminController@detailPendaftar',
        '/admin/peserta' => 'AdminController@peserta',
        '/admin/info_user' => 'AdminController@infoUser',

        // admin->keahlian
        '/admin/mata_soal_keahlian' => 'AdminController@soalKeahlian',
        '/admin/mata_soal_keahlian/tambah_mata_keahlian' => 'AdminController@tambahSoalKeahlian',
        '/admin/mata_soal_keahlian/edit_keahlian' => 'AdminController@ubahSoalKeahlian',
        '/admin/mata_soal_keahlian/hapus_keahlian' => 'AdminController@hapusSoalKeahlian',

        // admin->kelas_keahlian
        '/admin/kelas_keahlian' => 'AdminController@kelasKeahlian',
        '/admin/kelas_keahlian/tambah_kelas_keahlian' => 'AdminController@tambahKelasKeahlian',
        '/admin/kelas_keahlian/edit_kelas_keahlian' => 'AdminController@ubahKelasKeahlian',
        '/admin/kelas_keahlian/hapus_kelas_keahlian' => 'AdminController@hapusKelasKeahlian',

        // admin->tes_keahlian
        '/admin/tes_keahlian' => 'AdminController@tesKeahlian',
        '/admin/tes_keahlian/tambah_soal_keahlian' => 'AdminController@tambahTesKeahlian',
        '/admin/tes_keahlian/edit_soal_keahlian' => 'AdminController@editTesKeahlian',
        '/admin/tes_keahlian/hapus_tes_keahlian' => 'AdminController@hapusTesKeahlian',
        '/admin/tes_keahlian/detail_ujian' => 'AdminController@detailUjian',
        '/admin/tes_keahlian/detail_ujian/tambah_soal_tes_keahlian' => 'AdminController@tambahSoalTesKeahlian',
        '/admin/tes_keahlian/detail_ujian/import_soal_tes_keahlian' => 'AdminController@importSoalTesKeahlian',
        '/admin/tes_keahlian/detail_ujian/edit_soal_tes_keahlian' => 'AdminController@editSoalTesKeahlian',
        '/admin/tes_keahlian/detail_ujian/hapus_soal_tes_keahlian' => 'AdminController@hapusSoalTesKeahlian',

        // admin->sesi_keahlian
        '/admin/sesi_tes_keahlian' => 'AdminController@sesiTesKeahlian',
        '/admin/sesi_tes_keahlian/detail_sesi_tes_keahlian' => 'AdminController@detailSesiTesKeahlian',
        '/admin/sesi_tes_keahlian/tambah_sesi_tes_keahlian' => 'AdminController@tambahSesiTesKeahlian',
        '/admin/sesi_tes_keahlian/edit_sesi_tes_keahlian' => 'AdminController@editSesiTesKeahlian',
        '/admin/sesi_tes_keahlian/hapus_sesi_tes_keahlian' => 'AdminController@hapusSesiTesKeahlian',
    ];

    return $routes[$uri] ?? null;
}

// Get the request URI
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$route = route($request_uri);

if ($route) {
    list($controller, $method) = explode('@', $route);
    $controller_instance = new $controller();
    echo $controller_instance->$method();
} else {
    http_response_code(404);
    include 'views/404.php';
}

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

        // pendaftaran
        '/pendaftaran' => 'RegistrationController@index',
        '/pendaftaran/proses' => 'RegistrationController@register',
        '/pendaftaran/terdaftar' => 'RegistrationController@registered',

        // user
        '/user' => 'UserController@index',
        '/user/tes_seleksi' => 'UserController@showSeleksi',
        '/user/edit_profil' => 'UserController@editProfil',


        // admin
        '/admin' => 'AdminController@index',
        '/admin/kelola_data' => 'AdminController@kelolaData',
        '/admin/peserta' => 'AdminController@peserta',
        '/admin/info_user' => 'AdminController@infoUser',

        // admin->keahlian


        // seleksi peserta


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

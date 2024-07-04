<?php

if ($_SERVER['SERVER_PORT'] == 8080) {
    define('MAIN_URL', 'http://localhost:8080/app_web/public/');
} else {
    define('MAIN_URL', 'http://localhost/app_web/public/');
}

// konfig akun database
define('DB_USER', 'root');
define('DB_PASS', '');

// konfigurasi database MySQL
define('DB_MYSQL', 'mysql');
define('DB_HOST_MYSQL', 'localhost');
define('DB_NAME_MYSQL', 'data_sippeka');

// konfigurasi database PostgreSQL
define('DB_PGSQL', 'pgsql');
define('DB_HOST_PGSQL', 'localhost');
define('DB_PORT_PGSQL', '5432');
define('DB_NAME_PGSQL', 'data_sippeka');

// konfigurasi database SQLite
define('DB_SQLITE', 'sqlite');
define('DB_PATH_SQLITE', __DIR__ . '/../database/data_sippeka.db');

/** menentukan database berdasarkan kebutuhan yang akan digunakan
 *  Jika menggunakan MySQL cukup mengubahnya menjadi DB_MYSQL di bawah ini
 *  Jika menggunakan PostgreSQL cukup mengubahnya menjadi DB_PGSQL di bawah ini
 *  Jika menggunakan SQLite cukup mengubahnya menjadi DB_SQLite di bawah ini
*/
define('DB_TYPE', DB_MYSQL); // ubah di sini
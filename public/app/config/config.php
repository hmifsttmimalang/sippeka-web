<?php

if ($_SERVER['SERVER_PORT'] == 8080) {
    define('MAIN_URL', 'http://localhost:8080/app_web/public/');
} else {
    define('MAIN_URL', 'http://localhost/app_web/public/');
}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'data_sippeka');
<?php

if ($_SERVER['SERVER_NAME'] == 'ecommerce.it') {
    define('BASE_URL', 'http://ecommerce.it');

    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '12345');
    define('DB_NAME', 'ecommerce');
} else {
    define('BASE_URL', 'https://ecommerce.paldidesign.my.id');

    define('DB_HOST', 'localhost');
    define('DB_USER', 'ecok6667_root');
    define('DB_PASS', '#Adm!n-123#');
    define('DB_NAME', 'ecok6667_ecommerce');
}

define('SCRIPT_PATH', BASE_URL . '/app/assets');

define('DEFAULT_PAGINATION', 25);
define('TIMEZONE', 'Asia/Jakarta');
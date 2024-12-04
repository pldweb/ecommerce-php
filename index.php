<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($class) {
    $prefix = 'Carbon\\';
    $baseDir = __DIR__ . '/app/Carbon/';

    if (strpos($class, $prefix) === 0) {
        $relativeClass = str_replace($prefix, '', $class);
        $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
});


require_once "./app/init.php";

$app = new App();
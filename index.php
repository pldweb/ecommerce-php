<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "./vendor/autoload.php";
require_once "./app/init.php";

$app = new App();
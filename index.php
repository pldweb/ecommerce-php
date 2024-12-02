<?php

if (isset($_SESSION['nama'])) {
    session_start();
}
require_once "./app/init.php";

$app = new App();
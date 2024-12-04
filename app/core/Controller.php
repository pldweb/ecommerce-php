<?php

class Controller
{
    public function render($view, $data = [])
    {
        $loginView = 'auth/login/index';
        $daftarView = 'auth/daftar/index';

        if (isset($_SESSION['nama']) && ($view == $loginView || $view == $daftarView)) {
            header('Location:' . BASE_URL . '/user');
            exit;
        }

        if (!isset($_SESSION['nama'])) {
            if ($view == $daftarView) {
                require_once __DIR__ . '/../view/auth/daftar/index.php';
            } else {
                require_once __DIR__ . '/../view/auth/login/index.php';
            }
        } else {
            require_once __DIR__ . '/../view/' . $view . '.php';
        }
    }

    public function model($model)
    {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model;
    }
}
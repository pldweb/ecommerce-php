<?php

namespace App\MyHelper;
class Helper
{
    // Ini paginasi
    public static function pagination($limit = 10)
    {
        $nomor_halaman = isset($_GET['page']) ? $_GET['page'] : 1;
        $nomor_halaman = $nomor_halaman < 1 ? 1 : $nomor_halaman;
        $offset = ($nomor_halaman - 1) * $limit;
        return [$limit, $offset];
    }

    function assets($path)
    {
        return BASE_URL . '/app/assets/' . ltrim($path, '/');
    }
}

function dd($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

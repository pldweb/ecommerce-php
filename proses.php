<?php

include 'src/database.php';

$database = new Database();
$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];
    $nomor_telp = $_POST['nomor_telp'];

    $database->tambah_user($nama, $email, $password, $alamat, $nomor_telp);
    header("location:index.php");
} elseif ($aksi == 'edit') {
    return 'h';
}
?>
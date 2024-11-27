<?php

include 'src/database.php';

$database = new Database();
$aksi = $_GET['aksi'];

// Data User
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];
$alamat = $_POST['alamat'];
$nomor_telp = $_POST['nomor_telp'];

if ($aksi == 'tambah') {
    $database->tambahUser($nama, $email, $password, $alamat, $nomor_telp);
    header("location:index.php");
} elseif ($aksi == 'update') {
    $database->updateUser($_POST['id'], $nama, $email, $password, $alamat, $nomor_telp);
    header("location:index.php");
} elseif ($aksi == 'delete') {
    $database->deleteUser($_POST['id']);
    header("location:index.php");
} else {
    echo 'Belum Ada';
}
?>
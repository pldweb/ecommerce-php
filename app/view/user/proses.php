<?php

use src\database;

include '../src/database.php';

$database = new Database();

if (isset($_GET['aksi'])) {

    // Data User
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];
    $nomor_telp = $_POST['nomor_telp'];
    $role = $_POST['role_id'];

    if ($_GET['aksi'] == 'tambah') {
        $database->tambahUser($nama, $email, $password, $alamat, $nomor_telp, $role);
        header("location:index.php");
    } elseif ($_GET['aksi'] == 'update') {
        $database->updateUser($_POST['id'], $nama, $email, $password, $alamat, $nomor_telp, $role);
        header("location:index.php");
    } elseif ($_GET['aksi'] == 'delete') {
        $database->deleteUser($_POST['id']);
        header("location:index.php");
    } else {
        echo 'Ngga tau aksi apa';
    }
} else {
    echo "Tidak ada aksi";
}


?>
<?php

class database
{
    public $host = "localhost";
    public $username = "root";
    public $password = "12345";
    public $database = "ecommerce";
    public $connect;

    function __construct()
    {
        $this->connect = mysqli_connect($this->host, $this->username, $this->password);
        mysqli_select_db($this->connect, $this->database);
    }

    function data_user()
    {
        $data = mysqli_query($this->connect, "SELECT * FROM user");
        $rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
        return $rows;
    }

    function edit_user($id)
    {
        $data = mysqli_query($this->connect, "SELECT * FROM user WHERE id = '$id'");
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }

    function tambah_user($nama, $email, $password, $alamat, $nomor_telp)
    {
        $query = "INSERT INTO user (nama, email, password, alamat, nomor_telp) VALUES ('$nama', '$email', '$password', '$alamat', '$nomor_telp')";
        mysqli_query($this->connect, $query);
    }
}

?>
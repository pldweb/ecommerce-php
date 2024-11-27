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

    function dataRole()
    {
        $data = mysqli_query($this->connect, "SELECT * FROM role");
        $rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
        return $rows;
    }

    function tambahRole($nama)
    {
        $query = "INSERT INTO role (nama) VALUES ('$nama')";
        mysqli_query($this->connect, $query);
    }

    function hapusRole($id)
    {
        $query = "DELETE FROM role WHERE id = '$id'";
        mysqli_query($this->connect, $query);
    }

    function editRole($id)
    {
        $query = "SELECT * FROM role WHERE id = '$id'";
        $result = mysqli_query($this->connect, $query);
        $data = mysqli_fetch_assoc($result);
        return $data;
    }

    function updateRole($id, $nama)
    {
        $query = "UPDATE role SET nama = '$nama' WHERE id = '$id'";
        mysqli_query($this->connect, $query);
    }

    function dataUser()
    {
        $data = mysqli_query($this->connect, "SELECT * FROM user");
        $rows = mysqli_fetch_all($data, MYSQLI_ASSOC);
        return $rows;
    }

    function tambahUser($nama, $email, $password, $alamat, $nomor_telp, $role)
    {
        $query = "INSERT INTO user (nama, email, password, alamat, nomor_telp, role_id) VALUES ('$nama', '$email', '$password', '$alamat', '$nomor_telp', '$role')";
        mysqli_query($this->connect, $query);
    }

    function editUser($id)
    {
        $data = mysqli_query($this->connect, "SELECT * FROM user WHERE id = '$id'");
        $rows = mysqli_fetch_assoc($data);
        return $rows;
    }

    function updateUser($id, $nama, $email, $password, $alamat, $nomor_telp, $role)
    {
        mysqli_query($this->connect, "UPDATE user SET nama='$nama', email='$email', password='$password' , alamat='$alamat', nomor_telp='$nomor_telp', role_id='$role' WHERE id='$id'");
    }

    function deleteUser($id)
    {
        mysqli_query($this->connect, "DELETE FROM user WHERE id = '$id'");
    }
}

?>
<?php

namespace App\Models;

use app\core\Database;

class AuthModel
{

    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getData($email, $password)
    {
        $this->db->query("SELECT * FROM $this->table WHERE email = :email AND password = :password");
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        return $this->db->resultSet();
    }

    public function daftar($data)
    {
        $query = "INSERT INTO $this->table (nama, email, password, nomor_telp) 
              VALUES (:nama, :email, :password, :nomor_telp)";

        try {
            $this->db->query($query);
            $this->db->bind(":nama", $data['nama']);
            $this->db->bind(":email", $data['email']);
            $this->db->bind(":password", $data['password']);
            $this->db->bind(":nomor_telp", $data['nomor_telp']);
            $this->db->execute();
            return true;

        } catch (\PDOException $e) {
            return false;
        }

    }
}
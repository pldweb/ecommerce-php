<?php

namespace App\Models;

require_once __DIR__ . '/../MyHelper/Helper.php';
require_once __DIR__ . '/../core/Database.php';

use App\MyHelper\Helper;
use App\Core\Database;

class UserModel
{

    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function isEmailExist($email)
    {
        $sql = "SELECT * FROM $this->table WHERE email = :email";

        try {
            $this->db->query($sql);
            $this->db->bind(':email', $email);
            $this->db->execute();
            $result = $this->db->resultSet();
            return !empty($result);
        } catch (\PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function isNomorTelpExist($nomor_telp)
    {
        $sql = "SELECT * FROM $this->table WHERE nomor_telp = :nomor_telp";

        try {
            $this->db->query($sql);
            $this->db->bind(':nomor_telp', $nomor_telp);
            $this->db->execute();
            $result = $this->db->resultSet();
            return !empty($result);
        } catch (\PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }


    public function getUser()
    {
        $paginasi = Helper::pagination();
        $limit = $paginasi[0];
        $offset = $paginasi[1];

//        $this->db->query("SELECT $this->table.*, role.nama as role_nama FROM $this->table LEFT JOIN role ON role.id = $this->table.role_id ORDER BY created_at DESC LIMIT $limit OFFSET $offset");

        $this->db->query("SELECT $this->table.*, role.nama AS role_nama FROM $this->table LEFT JOIN role ON role.id = $this->table.role_id");

        return $this->db->resultSet();
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        try {
            $this->db->query($query);
            $this->db->bind(':id', $id);
            $this->db->execute();
            return true;
        } catch (\PDOException $exception) {
            return false;
        }
    }

    public function updateDataUser($data, $id)
    {
        $query = "UPDATE $this->table SET nama = :nama, email = :email, password = :password, alamat = :alamat, role_id = :role_id, nomor_telp = :nomor_telp WHERE id = :id";

        try {
            $this->db->query($query);
            $this->db->bind(':id', $id);
            $this->db->bind(':nama', $data['nama']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
            $this->db->bind(':alamat', $data['alamat']);
            $this->db->bind(':role_id', $data['role_id']);
            $this->db->bind(':nomor_telp', $data['nomor_telp']);
            $this->db->execute();

            return true;

        } catch (\PDOException $e) {
            return false;
        }
    }

    public function simpanDataUser($data)
    {
        $query = "INSERT INTO $this->table (nama, email, password, alamat, role_id, nomor_telp) 
              VALUES (:nama, :email, :password, :alamat, :role_id, :nomor_telp)";

        try {
            $this->db->query($query);
            $this->db->bind(':nama', $data['nama']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
            $this->db->bind(':alamat', $data['alamat']);
            $this->db->bind(':role_id', $data['role_id']);
            $this->db->bind(':nomor_telp', $data['nomor_telp']);

            $this->db->execute();
            return true;

        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id = '$id'");
        return $this->db->single();
    }
}
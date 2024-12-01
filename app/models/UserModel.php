<?php

class UserModel
{

    private $table = 'user';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUser()
    {
        $this->db->query("SELECT $this->table.*, role.nama as role_nama FROM $this->table INNER JOIN role ON role.id = $this->table.role_id");
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
            return $e->getMessage();
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
            return $this->db->rowCount();

        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id = '$id'");
        return $this->db->single();
    }

    public function getRole()
    {
        $this->db->query("SELECT * FROM role");
        return $this->db->resultSet();
    }
}
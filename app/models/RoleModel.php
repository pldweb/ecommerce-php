<?php

class RoleModel
{

    private $table = 'role';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getRole()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

    public function deleteRole($id)
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

    public function updateDataRole($data, $id)
    {
        $query = "UPDATE $this->table SET nama = :nama WHERE id = :id";

        try {
            $this->db->query($query);
            $this->db->bind(':id', $id);
            $this->db->bind(':nama', $data['nama']);
            $this->db->execute();

            return true;

        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function simpanDataRole($data)
    {
        $query = "INSERT INTO $this->table (nama) VALUES (:nama)";

        try {
            $this->db->query($query);
            $this->db->bind(':nama', $data['nama']);

            $this->db->execute();
            return $this->db->rowCount();

        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getRoleById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id = '$id'");
        return $this->db->single();
    }
}
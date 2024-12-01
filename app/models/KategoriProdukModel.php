<?php

class KategoriProdukModel
{

    private $table = 'kategori_produk';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getKategoriProduk()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

    public function deleteKategoriProduk($id)
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

    public function updateDataKategoriProduk($data, $id)
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

    public function simpanDataKategoriProduk($data)
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

    public function getKategoriProdukById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id = '$id'");
        return $this->db->single();
    }
}
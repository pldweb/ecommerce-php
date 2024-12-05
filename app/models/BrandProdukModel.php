<?php

require_once __DIR__ . '/../MyHelper/Helper.php';
require_once __DIR__ . '/../core/Database.php';

use App\MyHelper\Helper;
use App\Core\Database;

class BrandProdukModel
{

    private $table = 'brand_produk';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getBrandProduk()
    {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

    public function deleteBrandProduk($id)
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

    public function updateDataBrandProduk($data, $id)
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

    public function simpanDataBrandProduk($data)
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

    public function getBrandProdukById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id = '$id'");
        return $this->db->single();
    }
}
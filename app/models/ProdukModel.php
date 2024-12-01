<?php

class ProdukModel
{

    private $table = 'produk';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getProduk()
    {
        $this->db->query("SELECT $this->table.*, brand_produk.nama, kategori_produk.nama FROM $this->table JOIN brand_produk ON brand_produk.id = produk.brand_id JOIN kategori_produk ON kategori_produk.id = produk.kategori_id");
        return $this->db->resultSet();
    }

    public function deleteProduk($id)
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

    public function updateDataProduk($data, $id)
    {
        $query = "UPDATE $this->table SET nama = :nama, brand_id = :brand_id, kategori_id = :kategori_id, harga = :harga, diskon = :diskon, stok = :stok, deskripsi = :deskripsi, foto = :foto WHERE id = :id";

        try {
            $this->db->query($query);
            $this->db->bind(':id', $id);
            $this->db->bind(':nama', $data['nama']);
            $this->db->bind(':brand_id', $data['brand_id']);
            $this->db->bind(':kategori_id', $data['kategori_id']);
            $this->db->bind(':harga', $data['harga']);
            $this->db->bind(':diskon', $data['diskon']);
            $this->db->bind(':stok', $data['stok']);
            $this->db->bind(':deskripsi', $data['deskripsi']);
            $this->db->bind(':foto', $data['foto']);
            $this->db->execute();

            return true;

        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function simpanDataProduk($data)
    {
        $query = "INSERT INTO $this->table (nama, brand_id, kategori_id, harga, diskon, stok, deskripsi, foto) 
              VALUES (:nama, :brand_id, :kategori_id, :harga, :diskon, :stok, :deskripsi, :foto)";

        try {
            $this->db->query($query);
            $this->db->bind(':nama', $data['nama']);
            $this->db->bind(':brand_id', $data['brand_id']);
            $this->db->bind(':kategori_id', $data['kategori_id']);
            $this->db->bind(':harga', $data['harga']);
            $this->db->bind(':diskon', $data['diskon']);
            $this->db->bind(':stok', $data['stok']);
            $this->db->bind(':deskripsi', $data['deskripsi']);
            $this->db->bind(':foto', $data['foto']);
            $this->db->execute();

            $this->db->execute();
            return $this->db->rowCount();

        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getProdukById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id = '$id'");
        return $this->db->single();
    }

    public function getBrandProduk()
    {
        $this->db->query("SELECT * FROM brand_produk");
        return $this->db->resultSet();
    }

    public function getKategoriProduk()
    {
        $this->db->query("SELECT * FROM kategori_produk");
        return $this->db->resultSet();
    }
}
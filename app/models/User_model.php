<?php

class User_model {

    private $dbh; // Database Handler
    private $stmt;

    public function __construct()
    {
        // Data Source Name
        $dsn = 'mysql:host=localhost;dbname=ecommerce;';

        try {
            $this->dbh = new PDO($dsn, 'root', '12345');
        } catch (PDOException $e) {
            echo 'Connection DB failed: ' . $e->getMessage();
        }
    }

    // Contoh struktur data
    private $nama = [
        [
            "id" => 1,
            "nama" => "Yusri",
            "email" => "yusri@gmail.com",
            "alamat" => "Condet",
            "nomor_telp" => "0323513123",
            "role_id" => "user",
        ],
        [
            "id" => 2,
            "nama" => "Jojo",
            "email" => "jojo@gmail.com",
            "alamat" => "Bandar Gebang",
            "nomor_telp" => "12312413231",
            "role_id" => "user",
        ],
    ];

    public function getUser()
    {
        $this->stmt = $this->dbh->prepare("SELECT * FROM user");
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
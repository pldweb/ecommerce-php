<?php

class User_model {
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
        return $this->nama;
    }
}
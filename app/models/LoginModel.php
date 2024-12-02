<?php

class LoginModel
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
}
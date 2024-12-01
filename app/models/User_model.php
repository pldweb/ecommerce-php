<?php

class User_model {

    public function getUser()
    {
        $this->stmt = $this->dbh->prepare("SELECT * FROM user");
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
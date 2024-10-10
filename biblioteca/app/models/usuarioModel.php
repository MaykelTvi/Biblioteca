<?php

class UserModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=tpe_biblioteca;charset=utf8', 'root', '');
    }

    public function getByUser($email) {
        $query = $this->db->prepare('SELECT * FROM `usuarios` WHERE email = ?');
        $query->execute([$email]);

        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }
}
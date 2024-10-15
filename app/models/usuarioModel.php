<?php

class UserModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=tpe_biblioteca;charset=utf8', 'root', '');
    }

    public function getByUser($usuario) {
        $query = $this->db->prepare('SELECT * FROM `usuarios` WHERE usuario = ?');
        $query->execute([$usuario]);

        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }
    
    public function isAdmin($id) {
        $query = $this->db->prepare('SELECT admin FROM `usuarios` WHERE id_usuario = ?');
        $query->execute([$id]);

        $user = $query->fetch(PDO::FETCH_OBJ);
        if ($user) {
            return $user->admin;
        } else {
            return false;
        }
    }
}
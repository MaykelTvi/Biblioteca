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
     //estado administrador
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
        // Método para insertar un nuevo usuario en la base de datos
        public function insertUser($usuario, $password) {
            $query = $this->db->prepare("INSERT INTO usuarios (usuario, password) VALUES (?, ?)");
            return $query->execute([$usuario, $password]); // Retorna true si la inserción es exitosa
        }
}
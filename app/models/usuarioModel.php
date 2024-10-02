<?php

class UsuarioModel {
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=tpe_biblioteca;charset=utf8', 'root', '');
    }

    public function obtenerUsuario($user) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');
        $query->execute([$user]);

        $usuario = $query->fetch(PDO::FETCH_OBJ);

        // Depurar el resultado para verificar el contenido del objeto usuario
        if ($usuario) {
            var_dump($usuario); // Puedes eliminar este var_dump después de la depuración
        }

        return $usuario;
    }
}
<?php
require_once 'config.php';

class UsuarioModel {
    private PDO $db;

    function __construct() {

        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Manejo de errores
    }


    public function obtenerUsuarios() {
        $query = $this->db->prepare('SELECT * FROM usuarios');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public function insertarUsuario($usuario, $admin) {
        $query = $this->db->prepare('INSERT INTO usuarios(usuario, admin) VALUES(?, ?)');
        $query->execute([$usuario, $admin]);
        return $this->db->lastInsertId();
    }


    public function removerUsuario($idusuario) {
        $query = $this->db->prepare('DELETE FROM usuarios WHERE id_usuario = ?');
        $query->execute([$idusuario]);
    }


    public function mostrarUsuario($idusuario) {
        $query = $this->db->prepare('SELECT id_usuario, usuario, admin FROM usuarios WHERE id_usuario = ?');
        $query->execute([$idusuario]);
        return $query->fetch(PDO::FETCH_OBJ);
    }


    public function actualizarUsuario($idusuario, $usuario, $admin) {
        $query = $this->db->prepare("UPDATE usuarios SET usuario = ?, admin = ? WHERE id_usuario = ?");
        $query->execute([$usuario, $admin, $idusuario]);
    }


    public function getByUser($usuario) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE usuario = ?');
        $query->execute([$usuario]);
        return $query->fetch(PDO::FETCH_OBJ);
    }


    public function isAdmin($id) {
        $query = $this->db->prepare('SELECT admin FROM usuarios WHERE id_usuario = ?');
        $query->execute([$id]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user ? $user->admin : false;
    }
}

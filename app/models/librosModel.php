<?php
require_once 'config.php';

class librosModel {
    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }
    function obtenerLibros() {
        $query = $this->db->prepare('SELECT * FROM libros');
        $query->execute();

        $list = $query->fetchAll(PDO::FETCH_OBJ);
        return $list;
    }
    function insertarLibro($titulo, $autor, $prestado, $imagen){
        $query = $this->db->prepare('INSERT INTO libros(titulo, autor, prestado, imagen) VALUES(?,?,?,?)');
        $query->execute (array($titulo, $autor, $prestado, $imagen));

        return $this->db->lastInsertId();
    }
    function removerLibro($idLibro){
       $query = $this->db->prepare('DELETE FROM libros WHERE id_libro = ?');
       $query->execute([$idLibro]);
    }

    function mostrarLibro($idLibro) {
        $query = $this->db->prepare('SELECT titulo, autor, prestado, imagen FROM libros WHERE id_libro = ?');
        $query->execute(array($idLibro));
        $libro = $query->fetch(PDO::FETCH_OBJ);
        
        return $libro;
    }
    function actualizarLibro($idLibro, $newTitulo, $newAutor, $newPrestado, $newImagen = null){
        if ($newImagen) {
            $query = $this->db->prepare("UPDATE libros SET titulo=?, autor=?, prestado=?, imagen=? WHERE id_libro = ?");
            $query->execute(array($newTitulo, $newAutor, $newPrestado, $newImagen, $idLibro));
        } else {
            $query = $this->db->prepare("UPDATE libros SET titulo=?, autor=?, prestado=? WHERE id_libro = ?");
            $query->execute(array($newTitulo, $newAutor, $newPrestado, $idLibro));
        }
    }
    
    
}
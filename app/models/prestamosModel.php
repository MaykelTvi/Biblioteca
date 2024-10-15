<?php

class prestamosModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=tpe_biblioteca;charset=utf8', 'root', '');
    }

    function obtenerPrestamos() {
        $query = $this->db->prepare('SELECT * FROM prestamos');
        $query->execute();

        $list = $query->fetchAll(PDO::FETCH_OBJ);
        return $list;
    }

    function insertarPrestamo($idLibro, $idUsuario, $fecha) {
        $query = $this->db->prepare('INSERT INTO prestamos(id_libro, id_usuario, fecha_prestamo) VALUES(?,?,?)');
        $query->execute (array($idLibro, $idUsuario, $fecha));

        return $this->db->lastInsertId();
    }

    function eliminarPrestamo($id) {
        $query = $this->db->prepare('DELETE FROM prestamos WHERE id_prestamos = ?');
        $query->execute([$id]);
    }

    function actualizarPrestamo($id, $newIdUsuario, $newTitulo, $newFecha) {
        $query = $this->db->prepare("UPDATE prestamos SET id_usuario='$newIdUsuario', titulo_libro='$newTitulo', 
        fecha_prestamo='$newFecha' WHERE id = ?");
        $query->execute(array($id));
    }
}
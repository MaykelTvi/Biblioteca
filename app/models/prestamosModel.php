<?php

class prestamosModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB.';charset=utf8', MYSQL_USER, MYSQL_PASS);
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

    function eliminarPrestamo($prestamoId) {
        $query = $this->db->prepare('DELETE FROM prestamos WHERE id_prestamo = ?');
        $query->execute([$prestamoId]);
    }

    function mostrarPrestamo($prestamoId) {
        $query = $this->db->prepare('SELECT id_libro, id_usuario, fecha_prestamo FROM prestamos WHERE id_prestamo = ?');
        $query->execute(array($prestamoId));
        $prestamo = $query->fetch(PDO::FETCH_OBJ);

        return $prestamo;
    }

    function actualizarPrestamo($id, $newIdLibro, $newIdUsuario, $newFecha) {
        $query = $this->db->prepare("UPDATE prestamos 
            SET id_libro = ?, id_usuario = ?, fecha_prestamo = ? 
            WHERE id_prestamo = ?");
        $query->execute(array($newIdLibro, $newIdUsuario, $newFecha, $id));
    }
}
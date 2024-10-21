<?php

class prestamosView {
    function __construct() {}

    function mostrarAdminPrestamos($list) {
        $count = count($list);
        require './templates/prestamosAdmin.phtml';
    }

    function mostrarListaPrestamos($list) {
        $count = count($list);
        require './templates/prestamos.phtml';
    }
    public function mostrarPrestamo($prestamo) {
        require './templates/prestamo.phtml';
    }
    public function mostrarError($error) {
        require './templates/error.phtml';
    }
    function editarPrestamo($prestamoId, $prestamo) {
        require './templates/prestamoEdit.phtml';
    }
}
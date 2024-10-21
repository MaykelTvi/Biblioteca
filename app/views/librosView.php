<?php

class librosView {
    function __construct(){}

    function mostrarAdminLibros($list) {
        $count = count($list);
        require './templates/librosAdmin.phtml';
    }
    function mostrarLibros($list) {
        $count = count($list);
        require './templates/libros.phtml';
    }
    public function mostrarLibro($libro) {
        require './templates/libro.phtml';
    }
    public function mostrarError($error) {
        require './templates/error.phtml';
    }
    function editarLibro($idLibro, $libro) {
        require './templates/librosEdit.phtml';
    }
}
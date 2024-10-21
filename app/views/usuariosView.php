<?php

class usuariosView {
    function __construct(){}

    function mostrarAdminUsuario($list) {
        $count = count($list);
        require './templates/usuariosAdmin.phtml';
    }
    function mostrarUsuarios($list) {
        $count = count($list);
        require './templates/usuarios.phtml';
    }
    public function mostrarUsuario($usuario) {
        require './templates/usuario.phtml';
    }
    public function mostrarError($error) {
        require './templates/error.phtml';
    }
    function editarUsuario($idusuario, $usuario) {
        require './templates/usuariosEdit.phtml';
    }
}
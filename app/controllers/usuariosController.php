<?php
require_once './app/models/UsuarioModel.php';
require_once './app/views/usuariosView.php';

class UsuariosController {
    private $view;
    private $model;

    function __construct() {
        $this->view = new usuariosView();
        $this->model = new UsuarioModel(); 
    }

    function mostrarUsuarios() {
        AuthHelper::init();
        $list = $this->model->obtenerUsuarios();
        if (isset($_SESSION['id_usuario']) && $this->model->isAdmin($_SESSION['id_usuario'])) {
            $this->view->mostrarAdminUsuario($list);
        } else {
            $this->view->mostrarUsuarios($list);
        }
    }
    
    function agregarUsuario() {
        AuthHelper::verify();
        $usuario = $_POST['usuario'] ?? null;
        $admin = $_POST['admin'] ?? null;
        
        if (empty($usuario) || $admin === null) {
            $this->view->mostrarError("Debe completar todos los campos");
            return;
        }

        $usuario = htmlspecialchars($usuario);

        $id = $this->model->insertarUsuario($usuario, (int) $admin);
        if ($id) {
            header('Location: ' . BASE_URL . 'usuarios');
        } else {
            $this->view->mostrarError("Error al insertar el usuario");
        }
    }

    function eliminarUsuario($idusuario) {
        AuthHelper::verify();
        if ($this->model->isAdmin($_SESSION['id_usuario'])) {
            $this->model->removerUsuario($idusuario);
            header('Location: ' . BASE_URL . 'usuarios');
        }
    }

    function editarUsuario($idusuario) {
        AuthHelper::verify();
        if ($this->model->isAdmin($_SESSION['id_usuario'])) {
            $usuario = $this->model->mostrarUsuario($idusuario);
            $this->view->editarUsuario($idusuario, $usuario);
        }
    }

    function actualizarUsuario($idusuario) {
        AuthHelper::verify();
        $nuevoUsuario = $_POST['usuario'] ?? null;
        $nuevoAdmin = isset($_POST['admin']) ? 1 : 0;
        
        if (empty($nuevoUsuario)) {
            $this->view->mostrarError("El nombre de usuario no puede estar vacío");
            return;
        }

        $nuevoUsuario = htmlspecialchars($nuevoUsuario);

        $this->model->actualizarUsuario($idusuario, $nuevoUsuario, $nuevoAdmin);
        header('Location: ' . BASE_URL . 'usuarios');
    }
    public function mostrarUsuario($idUsuario) {
        $usuario = $this->model->mostrarUsuario($idUsuario);
        $this->view->mostrarUsuario($usuario);
    }

    function mostrarError() {
        $error = "Hubo un error al procesar la solicitud.";
        $this->view->mostrarError($error);
    }
}

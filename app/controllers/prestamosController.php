<?php
require_once './app/models/prestamosModel.php';
require_once './app/views/prestamosView.php';
require_once './app/models/UsuarioModel.php';

class prestamosController {
    private $view;
    private $model;
    private $userModel;

    function __construct() {
        $this->view = new prestamosView();
        $this->model = new prestamosModel();
        $this->userModel = new UsuarioModel();
    }

    function mostrarPrestamos() {
        AuthHelper::init();
        $list = $this->model->obtenerPrestamos();
        if (isset($_SESSION['id_usuario']) && $this->userModel->isAdmin($_SESSION['id_usuario'])) {
            $this->view->mostrarAdminPrestamos($list);
        } else {
            $this->view->mostrarListaPrestamos($list);
        }
    }

    function agregarPrestamo() {
        AuthHelper::verify();
        $libro = $_POST['id_libro'];
        $usuario = $_POST['id_usuario'];
        $fecha = $_POST['fecha_prestamo'];

        if(empty($libro) || empty($usuario) || empty($fecha)) {
            $this->view->mostrarError("Debe completar todos los campos");
            return;
        }
        
        $id = $this->model->insertarPrestamo($libro, $usuario, $fecha);
        if ($id) {
            header('Location: ' . BASE_URL . 'prestamos');
        } else {
            $this->view->mostrarError("Error al insertar el prestamo");
        }
    }

    function eliminarPrestamo($prestamoId){
        AuthHelper::verify();
        if($this->userModel->isAdmin($_SESSION['id_usuario'])) {
            $this->model->eliminarPrestamo($prestamoId);
            header('Location: ' . BASE_URL .'prestamos');
        }

    }


    function editarPrestamo($prestamoId){
        AuthHelper::verify();
        if($this->userModel->isAdmin($_SESSION['id_usuario'])) {
            $prestamo = $this->model->mostrarPrestamo($prestamoId);
            $this->view->editarPrestamo($prestamoId, $prestamo);
        }
    }

    function actualizarPrestamo($prestamoId) {
        AuthHelper::verify();

        $nuevoLibro = $_POST['id_libro'];
        $nuevoUsuario = $_POST['id_usuario'];
        $nuevaFecha = $_POST['fecha_prestamo'];

        $this->model->actualizarPrestamo($prestamoId, $nuevoLibro, $nuevoUsuario, $nuevaFecha);
        header('Location: ' . BASE_URL . 'prestamos');
    }
    function mostrarError() {
        $error = "Hubo un error al procesar la solicitud.";
        $this->view->mostrarError($error);
    }
    public function mostrarPrestamo($prestamoId) {
        $prestamo = $this->model->mostrarPrestamo($prestamoId);
        $this->view->mostrarPrestamo($prestamo);
    }
}
<?php
require_once './app/models/prestamosModel.php';
require_once './app/views/prestamosView.php';

class prestamosController {
    private $view;
    private $model;

    function __construct() {
        $this->view = new prestamosView();
        $this->model = new prestamosModel();
    }

    function mostrarPrestamos() {
        $list = $this->model->obtenerPrestamos();

        if(AuthHelper::login($list)) {
            $this->view->mostrarAdminPrestamos($list);
        }
        else {
            $this->view->mostrarListaPrestamos($list);
        }
    }

    function agregarPrestamo() {
        AuthHelper::verify();
        $usuario = $_POST['id_usuario'];
        $titulo = $_POST['titulo_libro'];
        $fecha = $_POST['fecha_prestamo'];

        if(empty($usuario) || empty($titulo) || empty($fecha)) {
            $this->view->mostrarError("Debe completar todos los campos");
            return;
        }
        
        $id = $this->model->insertarPrestamo($usuario, $titulo, $fecha);
        if ($id) {
            header('Location: ' . BASE_URL . 'prestamos');
        } else {
            $this->view->mostrarError("Error al insertar el prestamo");
        }
    }

    function eliminarPrestamo($id){
        AuthHelper::verify();
        $this->model->eliminarPrestamo($id);
        header('Location: ' . BASE_URL .'prestamos');

    }

    function editarPrestamo($prestamoId){
        AuthHelper::verify();
    $prestamo = $this->model->obtenerPrestamos($prestamoId);
    $this->view->editarPrestamo($prestamo, $prestamoId);
    }

    function actualizarPrestamo($prestamoId) {
        AuthHelper::verify();

        $nuevoUsuario = $_POST['id_usuario'];
        $nuevoTitulo = $_POST['titulo_libro'];
        $nuevaFecha = $_POST['fecha_prestamo'];

        $this->model->actualizarPrestamo($prestamoId, $nuevoUsuario, $nuevoTitulo, $nuevaFecha);
        header('Location: ' . BASE_URL . 'prestamos');
    }
}
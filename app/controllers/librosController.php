<?php
require_once './app/models/librosModel.php';
require_once './app/views/librosView.php';
require_once './app/models/UsuarioModel.php';

class librosController {
    private $view;
    private $model;
    private $userModel;

    function __construct() {
        $this->view = new librosView();
        $this->model = new librosModel();
        $this->userModel = new UsuarioModel();
    }
    function mostrarLibros() {
        AuthHelper::init();
        $list = $this->model->obtenerLibros();
        if (isset($_SESSION['id_usuario']) && $this->userModel->isAdmin($_SESSION['id_usuario'])) {
            $this->view->mostrarAdminLibros($list);
        } else {
          $this->view->mostrarLibros($list);
        }
    }
    function agregarLibro() {
        AuthHelper::verify();
    
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $prestado = $_POST['prestado'];

        if (empty($titulo) || empty($autor)) {
            $this->view->mostrarError("Debe completar todos los campos obligatorios");
            return;
        }
    

        $rutaImagen = null; 
    
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
            $tipoArchivo = $_FILES['imagen']['type'];
    

            if ($tipoArchivo == "image/jpg" || $tipoArchivo == "image/jpeg" || $tipoArchivo == "image/png") {
                $imagenTmp = $_FILES['imagen']['tmp_name'];
                $nombreImagen = uniqid("", true) . "." . strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
                $carpetaDestino = 'app/uploads/libros/';
                $rutaImagen = $carpetaDestino . $nombreImagen;
    

                if (!move_uploaded_file($imagenTmp, $rutaImagen)) {
                    $this->view->mostrarError("Error al subir la imagen.");
                    return;
                }
            } else {
                $this->view->mostrarError("Formato de imagen no permitido.");
                return;
            }
        }
    

        $id = $this->model->insertarLibro($titulo, $autor, $prestado, $rutaImagen);
        if ($id) {
            header('Location: ' . BASE_URL . 'libros');
        } else {
            $this->view->mostrarError("Error al insertar el libro.");
        }
    }
    
    

    function eliminarLibro($idLibro){
        AuthHelper::verify();
        if($this->userModel->isAdmin($_SESSION['id_usuario'])) {
            $this->model->removerLibro($idLibro);
            header('Location: ' . BASE_URL .'libros');
        }

    }


    function editarLibro($idLibro){
        AuthHelper::verify();
        if($this->userModel->isAdmin($_SESSION['id_usuario'])) {
            $libro = $this->model->mostrarLibro($idLibro);
            $this->view->editarLibro($idLibro, $libro);
        }
    }

    function actualizarLibro($idLibro) {
        AuthHelper::verify();
    
        $nuevoTitulo = $_POST['titulo'];
        $nuevoAutor = $_POST['autor'];
        $nuevoPrestado = isset($_POST['prestado']) ? 1 : 0;
    

        $rutaImagen = null;
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
            $tipoArchivo = $_FILES['imagen']['type'];
    

            if ($tipoArchivo == "image/jpg" || $tipoArchivo == "image/jpeg" || $tipoArchivo == "image/png") {
                $imagenTmp = $_FILES['imagen']['tmp_name'];
                $nombreImagen = uniqid("", true) . "." . strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
                $carpetaDestino = 'app/uploads/libros/'; 
                $rutaImagen = $carpetaDestino . $nombreImagen;
    

                if (!move_uploaded_file($imagenTmp, $rutaImagen)) {
                    $this->view->mostrarError("Error al subir la imagen.");
                    return;
                }
            } else {
                $this->view->mostrarError("Formato de imagen no permitido.");
                return;
            }
        
            $this->model->actualizarLibro($idLibro, $nuevoTitulo, $nuevoAutor, $nuevoPrestado, $rutaImagen);
            header('Location: ' . BASE_URL . 'libros');
        }
    
        $this->model->actualizarLibro($idLibro, $nuevoTitulo, $nuevoAutor, $nuevoPrestado, $rutaImagen);
        header('Location: ' . BASE_URL . 'libros');
    }
    
    function mostrarError() {
        $error = "Hubo un error al procesar la solicitud.";
        $this->view->mostrarError($error);
    }

    public function mostrarLibro($idLibro) {
        $libro = $this->model->mostrarLibro($idLibro);
        $this->view->mostrarLibro($libro);
    }
}
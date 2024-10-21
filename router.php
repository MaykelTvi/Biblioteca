<?php
require_once './app/controllers/usuariosController.php';
require_once 'app/controllers/prestamosController.php';
require_once 'app/controllers/authController.php';
require_once 'app/controllers/librosController.php';
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
$action = 'home';
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $prestamosController = new prestamosController();
        $prestamosController->mostrarPrestamos();
        $librosController = new librosController();
        $librosController->mostrarLibros();
        $usuariosController = new usuariosController();
        $usuariosController->mostrarUsuarios();
        break;
    case 'login':
        $authController = new authController();
        $authController->showLogin(); 
        break;
        

    case 'auth':
        $authController = new authController();
        $authController->auth();
        break;

    case 'logout':
        $authController = new authController();
        $authController->logout();
        break;
    

    case 'libros':
        $librosController = new librosController();
        $librosController->mostrarLibros();
        break;
    case 'agregarLibro':
        $librosController = new librosController();
        $librosController->agregarLibro();
        break;
    case 'eliminarLibro':
        $librosController = new librosController();
        $librosController->eliminarLibro($params[1]);
        break;
    case 'editarLibro':
        $librosController = new librosController();
        $librosController->editarLibro($params[1]);
        break;
    case 'actualizarLibro':
        $librosController = new librosController();
        $librosController->actualizarLibro($params[1]);
        break;
    case 'libro':
        $librosController = new librosController();
        $librosController->mostrarLibro($params[1]);
        break;

    case 'usuarios':
        $usuariosController = new usuariosController();
        $usuariosController->mostrarUsuarios();
        break;
    case 'usuario':
        $usuariosController = new usuariosController();
        $usuariosController->mostrarUsuario($params[1]);
        break;
    case 'agregarUsuario':
        $usuariosController = new usuariosController();
        $usuariosController->agregarUsuario();
        break;
    case 'eliminarUsuario':
        $usuariosController = new usuariosController();
        $usuariosController->eliminarUsuario($params[1]);
        break;
    case 'editarUsuario':
        $usuariosController = new usuariosController();
        $usuariosController->editarUsuario($params[1]);
        break;
    case 'actualizarUsuario':
        $usuariosController = new usuariosController();
        $usuariosController->actualizarUsuario($params[1]);
        break;
    case 'usuarios':
        $usuariosController = new usuariosController();
        $usuariosController->mostrarUsuario($params[1]);
        break;


    case 'prestamos':
        $prestamosController = new prestamosController();
        $prestamosController->mostrarPrestamos();
        break;
    case 'prestamo':
        $prestamosController = new prestamosController();
        $prestamosController->mostrarPrestamo($params[1]);
        break;
    case 'agregarPrestamo':
        $prestamosController = new prestamosController();
        $prestamosController->agregarPrestamo($params[1]);
        break;
    case 'eliminarPrestamo':
        $prestamosController = new prestamosController();
        $prestamosController->eliminarPrestamo($params[1]);
        break;
    case 'editarPrestamo':
        $prestamosController = new prestamosController();
        $prestamosController->editarPrestamo($params[1]);
        break;
    case 'actualizarPrestamo':
        $prestamosController = new prestamosController();
        $prestamosController->actualizarPrestamo($params[1]);
        break;

    default:
        echo "404 - Página no encontrada";
        break;
}
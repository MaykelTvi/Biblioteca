<?php
require_once 'app/controllers/prestamosController.php';
require_once 'app/controllers/authController.php';
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    // Rutas relacionadas con la autenticación
    case 'home':
        $prestamosController = new prestamosController();
        $prestamosController->mostrarPrestamos();
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

    // Rutas relacionadas con los préstamos
    case 'prestamos':
        $prestamosController = new prestamosController();
        if (isset($params[1]) && $params[1] == 'agregar') {
            $prestamosController->agregarPrestamo();
        } else if (isset($params[1]) && $params[1] == 'editar' && isset($params[2])) {
            $prestamosController->editarPrestamo($params[2]);
        } else if (isset($params[1]) && $params[1] == 'eliminar' && isset($params[2])) {
            $prestamosController->eliminarPrestamo($params[2]);
        } else if (isset($params[1]) && $params[1] == 'actualizar' && isset($params[2])) {
            $prestamosController->actualizarPrestamo($params[2]);
        } else {
            $prestamosController->mostrarPrestamos(); // Muestra todos los préstamos
        }
        break;

    // Ruta por defecto (puedes redirigir a una vista de inicio o error)
    default:
        echo "404 - Página no encontrada";
        break;
}
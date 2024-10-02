<?php
require_once './app/models/usuarioModel.php';
require_once 'app/views/authView.php';
require_once 'app/helpers/authHelper.php';

class authController {
    private $view;
    private $model;

    function __construct() {
        $this->model = new UsuarioModel();
        $this->view = new AuthView();
    }

    public function mostrarLogin() {
        $this->view->mostrarLogin(); 
    }

    public function auth() {
        $user = $_POST['user'];
        $password = $_POST['password'];

        // Verificar si los campos están vacíos
        if(empty($user) || empty($password)) {
            $this->view->mostrarLogin('Faltan completar datos');
            return;
        }

        // Obtener el usuario de la base de datos
        $user = $this->model->obtenerUsuario($user);

        // Verificar si el usuario existe y si tiene la propiedad password
        if ($user && isset($user->password) && password_verify($password, $user->password)) {
            AuthHelper::login($user);
            header('Location: ' . BASE_URL);
        } else {
            // Si no existe o la contraseña no coincide, mostrar mensaje de error
            $this->view->mostrarLogin('Usuario o contraseña inválidos');
        }
    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);
    }
}
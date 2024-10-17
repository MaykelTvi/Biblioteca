<?php
require_once 'app/models/usuarioModel.php';
require_once 'app/views/authView.php';
require_once 'app/helpers/authHelper.php';

class authController
{
    private $view;
    private $model;

    function __construct()
    {

        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin() {
        return $this->view->showLogin();
    }
    public function showRegister() {
        return $this->view->showRegister();
    }
    

    public function auth() {
        if(!isset($_POST['usuario']) || empty($_POST['usuario'])) {
            return $this->view->showError('Falta completar el usuario');
        }

        if(!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showError('Falta completar la contraseña');
        }

        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        $userFromDB = $this->model->getByUser($usuario);
        if(password_verify($password, $userFromDB->password)) {
            session_start();
            AuthHelper::login($userFromDB);
            $_SESSION['LAST_ACTIVITY'] = time();
            
            header('Location: ' . BASE_URL);
        } else {
            return $this->view->showLogin('Campos incorrectos');
        }
    }

    public function register() {
        // Verificar si los campos usuario y password están completos
        if (!isset($_POST['usuario']) || empty($_POST['usuario'])) {
            return $this->view->showError('Falta completar el usuario');
        }
    
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showError('Falta completar la contraseña');
        }
    
        // Ruta para procesar el registro
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
    
        // Verificar si el usuario ya existe en la base de datos usando el modelo en lugar de $this->db
        $existingUser = $this->model->getByUser($usuario);  // Cambiamos $this->db a $this->model
    
        if ($existingUser) {
            // Si el usuario ya existe, mostramos un error
            return $this->view->showError('El correo ya está registrado. Intenta con otro.');
        } else {
            // Si el usuario no existe, registrar el nuevo usuario
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash seguro de la contraseña
    
            // Insertar el nuevo usuario en la base de datos usando el modelo en lugar de $this->db
            if ($this->model->insertUser($usuario, $hashedPassword)) {  // Cambiamos $this->db a $this->model
                // Si el registro es exitoso, redirigimos al usuario a la página principal
                var_dump($existingUser);
            } else {
                // En caso de error en el registro
                return $this->view->showError('Error en el registro. Inténtalo de nuevo.');
            }
        }
    }
    
    
    public function logout()
    {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);
    }
}
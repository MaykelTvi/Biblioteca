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
    }public function register() {
        // Mostrar los datos enviados (para depurar)
        var_dump($_POST);
    
        // Verificar si los campos 'usuario' y 'password' están completos
        if (empty($_POST['usuario']) || empty($_POST['password'])) {
            echo 'Falta completar todos los campos.';
        } else {
            // Obtener los valores del formulario
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];
    
            // Verificar si el usuario ya existe en la base de datos
            $userFromDB = $this->model->getByUser($usuario);
    
            if ($userFromDB) {
                echo 'El usuario ya está registrado. Intenta con otro.';
            } else {
                // Si el usuario no existe, registrar el nuevo usuario
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
                // Insertar el nuevo usuario en la base de datos
                if ($this->model->insertUser($usuario, $hashedPassword)) {
                    // Redirigir a la página de login si el registro es exitoso
                    header('Location: router.php?action=login');
                    exit();  // Importante detener la ejecución después de la redirección
                } else {
                    echo 'Error en el registro. Inténtalo de nuevo.';
                }
            }
        }
        
        
    }
    
    
    
    public function logout()
    {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);
    }
}
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

    public function auth() {
        if(!isset($_POST['email']) || empty($_POST['email'])) {
            return $this->view->showError('Falta completar el email');
        }

        if(!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showError('Falta completar la contraseña');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $userFromDB = $this->model->getByUser($email);

        if(password_verify($password, $userFromDB->password)) {
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['EMAIL_USER'] = $userFromDB->email;
            $_SESSION['LAST_ACTIVITY'] = time();
            
            header('Location: ' . BASE_URL);
        } else {
            return $this->view->showLogin('Campos incorrectos');
        }
    }

    public function logout()
    {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);
    }
}

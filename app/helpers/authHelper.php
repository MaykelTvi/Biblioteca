<?php

class AuthHelper
{
    /* Verifica el estado de la sesión (si no está iniciada, la inicia)*/
    public static function init()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
    /* Inicia una sesión almacenando el id y usuario */
    public static function login($usuario)
    {
        AuthHelper::init();
        // Acceso si $usuario es un array
        $_SESSION['id_usuario'] = $usuario->id_usuario;
        $_SESSION['usuario'] = $usuario->usuario;
    }

    /* Cierra la sesión */
    public static function logout()
    {
        AuthHelper::init();
        session_destroy();
    }

    /*  Verifica si el usuario está loggeado (si no lo está, redirige al login) */
    public static function verify()
    {
        AuthHelper::init();
        if (!isset($_SESSION['id_usuario'])) {
            header('Location: ' . BASE_URL . 'login');
            die();
        }
    }
}
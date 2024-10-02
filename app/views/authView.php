<?php
class AuthView {
    public function mostrarLogin($error = null) {
        require './templates/login.phtml';
    }
}
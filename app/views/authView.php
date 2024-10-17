<?php
class AuthView {
    public function showLogin($error = null) {
        require './templates/login.phtml';
    }
    public function showRegister($error = null) {
        require './templates/register.phtml';
    }
    public function showError() {
        require 'templates/error.phtml';
    }
}
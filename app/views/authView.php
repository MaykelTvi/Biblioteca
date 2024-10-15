<?php
class AuthView {
    public function showLogin($error = null) {
        require './templates/login.phtml';
    }
    public function showError() {
        require 'templates/error.phtml';
    }
}
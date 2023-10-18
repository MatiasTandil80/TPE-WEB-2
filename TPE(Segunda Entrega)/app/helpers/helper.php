<?php

class AuthHelper {

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function login($user) {
        AuthHelper::init();
        $_SESSION['MAIL'] = $user->mail;
        $_SESSION['PASSWORD'] = $user->password; 
        
    }

    public static function logout() {
        AuthHelper::init();
        session_destroy();
    }

    public static function verify() {
        AuthHelper::init();
        if (!isset($_SESSION['MAIL'])) {
            header('Location: ' . BASE_URL . '/login');
            die();
        }
    }
}
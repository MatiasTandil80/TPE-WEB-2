<?php
require_once './app/models/login.model.php';
require_once './app/views/login.view.php';
require_once './app/helpers/helper.php';

class loginController{

    private $view;
    private $model;

    function __construct(){
        $this->view = new loginView();
        $this->model = new loginModel();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function authUsuario() {
        $mail = $_POST['mail'];
        $password = $_POST['password'];

        if (empty($mail) || empty($password)) {
            $this->view->showLogin('Falta completar datos');
            return;
        }

        // busco el usuario
        $user = $this->model->getByEmail($mail);
    
        if ($user && password_verify($password, $user->password)) {//LO AUTENTICO
        
            AuthHelper::login($user);
            
            header('Location: ' . BASE_URL);
        
        } else {
            $this->view->showLogin("Usuario inválido");
        }
    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);    
    }

}
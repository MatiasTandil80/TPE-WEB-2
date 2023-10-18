<?php

require_once './app/views/varios.view.php';

class VariosController{

    private $view;

    public function __construct()
    {
        $this->view = new VariosView();
    }

    public function showAbout(){
        $this->view->showAbout("Esta pagina fue realizada por Sergio Belaunzaran y Matías Suárez...");
    }

    public function showHome(){
        $this->view->showHome();
    }


}



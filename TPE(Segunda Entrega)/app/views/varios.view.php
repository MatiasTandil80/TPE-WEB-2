<?php

class VariosView {

    public function showHome(){
        require './templates/titulocentral.phtml';
    }

    public function showAbout($msnAbout){
        require './templates/about.phtml';
    }

}




?>
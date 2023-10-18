<?php

class MarcasView {
    public function showMarcas($marcas) {
       
        require './templates/showmarcas.phtml';
    }

    public function showMarca($marca) {

        require './templates/showmarcaespecifica.phtml';
    }

    public function showNombreMarca($marca) {
        
        require './templates/shownombremarca.phtml';
    }


    public function showFormAddMarca(){

        require './templates/formaddmarca.phtml';

    }

    public function showFormUpdateMarca($marca){

        require './templates/formupdatemarca.phtml';
    }



    public function showMessage($msg = null) {
        
         require './templates/mensajes.phtml';

    }


}

?>


<?php
class ModelosView {
    public function showModelos($modelos, $id_marca = null) {
        
        require './templates/showmodelos.phtml';
    }

    public function showModelo($modelo) {
       
        require './templates/showmodelo.phtml';
    }

    public function showFormUpdateModelo($modelo){
        
        require './templates/formupdatemodelo.phtml';

    }

    public function showFormAddModelo($id_marca = null, $lista_marcas = null){

        require './templates/formaddmodelo.phtml';

    }

   public function showMessage($msg) {
    require './templates/mensajes.phtml';
    }



}

?>

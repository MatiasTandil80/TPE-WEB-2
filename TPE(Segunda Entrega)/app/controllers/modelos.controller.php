<?php
require_once './app/models/modelos.model.php';
require_once './app/views/modelos.view.php';
require_once 'marcas.controller.php';


class ModeloController
{
    private $model; //acceso a la tabla modelos
    private $view; //vista de los modelos

    public function __construct()
    {
        $this->model = new ModelosModel();
        $this->view = new ModelosView();
        $this->marcas = new MarcasController();
    }

    public function showModelos()
    {
        // obtengo modelos del controlador
        $modelos = $this->model->getModelos();

        // muestro los modelos desde la vista
        $this->view->showModelos($modelos);
    }

    public function showModelo($id)
    {
        // obtengo el modelo del controlador
        $modelo = $this->model->getModelo($id);

        // muestro el modelo desde la vista
        $this->view->showModelo($modelo);

    }

    public function addModeloDesdeMarca($id_marca){

        //obtener nombre marca 

        $this->view->showFormAddModelo($id_marca,null);

    }

    public function addModelo1($lista_marcas)
    { //muestro el fomulario para añadir el nuevo modelo
        
        $this->view->showFormAddModelo(null,$lista_marcas);

    }

    public function addModelo2()
    { //Tomo los valores del form y los envío a la tabla modelos

        // obtengo los datos del usuario
        $id_marca = $_POST['id_marca'];     
        $nombre = $_POST['nombre'];
        $cilindrada_cm3 = $_POST['cilindrada_cm3'];
        $tipo = $_POST['tipo'];
        $potencia_hp = $_POST['potencia_hp'];
        $peso_kg = $_POST['peso_kg'];

        
        // validaciones
        if (empty($nombre) || empty($cilindrada_cm3) || empty($tipo) || empty($potencia_hp) || empty($peso_kg)) {
            //$this->view->showFormUpdateModelo($modelo);
            $this->view->showFormAddModelo();
            $this->view->showMessage("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertModelo($id_marca, $nombre, $cilindrada_cm3, $tipo, $potencia_hp, $peso_kg);
        if ($id) {
            $this->showModelos();
            $this->view->showMessage("Modelo insertado correctamente");
        } else {
            $this->showModelos();
            $this->view->showMessage("Error al insertar el modelo");
        }
    }

    function removeModelo($id)
    {
        $this->model->deleteModelo($id);
        $this->showModelos();
        $this->view->showMessage("Modelo borrado correctamente");
    }

    function UpdateModelo1($id)
    { //Traigo de la tabla Modelos y muestro el formulario de modificar
        $modelo = $this->model->getModelo($id);

        $this->view->showFormUpdateModelo($modelo);
        //Muestro el form con los datos iniciales

    }

    function UpdateModelo2($id)
    { //Tomo del formulario Modificar y hago el update en la tabla Modelos
        //poner finishUPdate

        $modeloModif = new stdClass();

        $modeloModif->id = $id;
        $modeloModif->nombre = $_POST['nombre'];
        $modeloModif->cilindrada_cm3 = $_POST['cilindrada_cm3'];
        $modeloModif->tipo = $_POST['tipo'];
        $modeloModif->potencia_hp = $_POST['potencia_hp'];
        $modeloModif->peso_kg = $_POST['peso_kg'];

        // validaciones
        if (empty($modeloModif->nombre) || empty($modeloModif->cilindrada_cm3) || empty($modeloModif->tipo) || empty($modeloModif->potencia_hp) || empty($modeloModif->peso_kg)) {
            $this->view->showFormUpdateModelo($modeloModif);
            $this->view->showMessage("Debe completar todos los campos");

           
        } else {
            $this->model->UpdateModelo($modeloModif);
            $this->showModelos();
            $this->view->showMessage("EL modelo fué modificado");

        }

    }

    public function getModelosMarca($id_marca)
    {

        $modelosMarca = $this->model->getModelosMarca($id_marca);
        $this->view->showModelos($modelosMarca, $id_marca);

    }

}
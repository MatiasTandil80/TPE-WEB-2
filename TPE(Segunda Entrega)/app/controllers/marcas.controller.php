<?php
require_once './app/models/marcas.model.php';
require_once './app/views/marcas.view.php';


class MarcasController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new MarcasModel();
        $this->view = new MarcasView();

    }

    public function showMarcas()
    {
        // obtengo modelos del controlador
        $marcas = $this->model->getMarcas();

        // muestro los modelos desde la vista
        $this->view->showMarcas($marcas);
    }

    public function getMarcas(){
        return $this->model->getMarcas();
    }

    public function showMarca($id)
    {
        // obtengo la marca del modelo
        $marca = $this->model->getMarca($id);

        // muestro la marca desde la vista
        $this->view->showMarca($marca);

    }
    public function formularioAddMarca()
    { //muestro el fomulario para añadir el nuevo modelo

        $this->view->showFormAddMarca();

    }

    public function cargarFormularioAddMarca()// 
    {

        // obtengo los datos del formulario 
        $nombre = $_POST['nombre'];
        $origen = $_POST['origen'];
        $año_fundacion = $_POST['año_fundacion'];
        $cant_empleados = $_POST['cant_empleados'];
        $produccion_anual = $_POST['produccion_anual'];
        $facturacion_M_USD = $_POST['facturacion_M_USD'];

        // validaciones
        if (empty($nombre) || empty($origen) || empty($año_fundacion) || empty($cant_empleados) || empty($produccion_anual) || (empty($facturacion_M_USD))) {
            $this->view->showFormAddMarca();
            $this->view->showMessage("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertMarca($nombre, $origen, $año_fundacion, $cant_empleados, $produccion_anual, $facturacion_M_USD);
        $this->showMarcas();
        if ($id) {
            
            $this->view->showMessage("La marca se agregó correctamente");
        } else {
            $this->view->showMessage("Error al insertar la marca");
        }
    }

    function removeMarca($id)
    {
        $this->model->deleteMarca($id);
        $this->showMarcas();
        $this->view->showMessage("La marca fue borrada");
        
    }

    function startUpdateMarca($id)
    { //Trae el formulario a modificar, con los datos originales, y los muestra

        $marca = $this->model->getMarca($id);

        $this->view->showFormUpdateMarca($marca);

    }
    function finishUpdateMarca($id)
    { //Tomo los valores del formulario ya modificado y guardo los datos en la tabla Marcas

        $marcaModif = new stdClass();

        $marcaModif->id = $id;
        $marcaModif->nombre = $_POST['nombre'];
        $marcaModif->origen = $_POST['origen'];
        $marcaModif->año_fundacion = $_POST['año_fundacion'];
        $marcaModif->cant_empleados = $_POST['cant_empleados'];
        $marcaModif->produccion_anual = $_POST['produccion_anual'];
        $marcaModif->facturacion_M_USD = $_POST['facturacion_M_USD'];

        // validaciones
        if (empty($marcaModif->nombre) || empty($marcaModif->origen) || empty($marcaModif->año_fundacion) || empty($marcaModif->cant_empleados) || empty($marcaModif->produccion_anual) || empty($marcaModif->facturacion_M_USD)) {
            $this->view->showFormUpdateMarca($marcaModif);
            $this->view->showMessage("Debe completar todos los campos");
            
        } else {
            $this->model->UpdateMarca($marcaModif);
            $this->showMarcas();
            $this->view->showMessage("La marca fue modificada");
        }

    }


}
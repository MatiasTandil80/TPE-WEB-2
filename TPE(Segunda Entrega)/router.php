<?php
require_once './app/controllers/marcas.controller.php';
require_once './app/controllers/modelos.controller.php';
require_once './app/controllers/login.controller.php';
require_once './app/helpers/helper.php';
require_once './app/controllers/varios.controller.php';

    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
   
    if (!empty($_GET['action'])){
        $action = $_GET['action'];
        
    }
    else {
        $action = 'home';
        
    }

$params = explode('/',$action);

$motosCont=new ModeloController();
$marcasCont= new MarcasController();
$loginCont= new loginController();
$variosCont = new VariosController();

switch ($params[0]){
    case 'home':
        $variosCont->showHome();
        break;
    case 'login';
        $loginCont->showLogin();
        break;
    case 'administrador';
        $loginCont->authUsuario();
        break;
    case 'logout';
        $loginCont->logout();
        break;
    case 'marcas';
        $marcasCont->showMarcas();
        break;
    case 'especificarmarca';
        $marcasCont->showMarca($params[1]);
        break;
    case 'addmodelodesdemarca';
        $motosCont->addModeloDesdeMarca($params[1]);
        
        break;
    case 'modelosmarca';
        $motosCont->getModelosMarca($params[1]);
        break;
    case 'borrarmarca';
        $marcasCont->removeMarca($params[1]);
        break;
    case 'añadirmarca';
        $marcasCont->formularioAddMarca();
        break;
    case 'form-add-marca';
        $marcasCont->cargarFormularioAddMarca();
        break;
    case 'modificarmarca';
        $marcasCont->startUpdateMarca($params[1]);
        break;
    case 'form-update-marca';
        $marcasCont->finishUpdateMarca($params[1]);
        break;
    case 'modificar';
        $motosCont->UpdateModelo1($params[1]);
        break;
    case 'form-update-modelos';
        $motosCont->UpdateModelo2($params[1]);
        break;
    case 'modelos';
        $motosCont->showModelos();
        break;
    case 'especificarmodelo';
        $motosCont->showModelo($params[1]);
        break;
    case 'addModelo';
        $lista_marcas=$marcasCont->getMarcas();
        $motosCont->addModelo1($lista_marcas);
        break;
    case 'form-add-modelo';
       
        $motosCont->addModelo2();
        break;
    case 'borrarModelo';
        $motosCont->removeModelo($params[1]);
        break;
    case 'about';
        $variosCont->showAbout();
        break;
    default:
        echo('404 pagina no encontrada');
        break;
}


?>
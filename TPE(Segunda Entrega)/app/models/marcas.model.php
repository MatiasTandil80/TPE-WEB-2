<?php

class MarcasModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=motos;charset=utf8', 'root', '');
    }

    /**
     * Obtiene y devuelve de la base de datos todas las marcas.
     */
    function getMarcas() {
        $query = $this->db->prepare('SELECT * FROM marcas');
        $query->execute();

        // $modelos es un arreglo de marcas de motos
        $marcas = $query->fetchAll(PDO::FETCH_OBJ);

        return $marcas;
    }

    /**
     * Obtiene y devuelve de la base de datos una marca según un id.
     */
    function getMarca($id) {
        $query = $this->db->prepare('SELECT * FROM marcas WHERE id=?');
        $query->execute([$id]);

        // $marca es un arreglo que contiene una marca de moto
        $marca = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $marca[0];

    }


    /**
     * Inserta un marca en la base de datos
     */
    function insertMarca($nombre, $origen, $año_fundacion, $cant_empleados, $produccion_anual, $facturacion_M_USD) {
        
        $consulta = "SELECT EXISTS(SELECT * FROM marcas WHERE nombre = :nombre);";
        
        $statement = $this->db->prepare($consulta);
        $statement->bindParam(':nombre', $nombre);

        $statement->execute();
   

        if ($statement->fetchColumn() == 0) {
            $query = $this->db->prepare('INSERT INTO marcas (nombre,origen,año_fundacion,cant_empleados,produccion_anual,facturacion_M_USD) VALUES(?,?,?,?,?,?)');
            $query->execute([$nombre, $origen, $año_fundacion, $cant_empleados, $produccion_anual, $facturacion_M_USD]);
            return $this->db->lastInsertId();
        }
        
    }

    
function deleteMarca($id) {
    $query = $this->db->prepare('DELETE FROM marcas WHERE id = ?');
    $query->execute([$id]);
}

function updateMarca($marca) {    
    
    $query = $this->db->prepare('UPDATE marcas SET nombre = ? ,origen = ? ,año_fundacion = ? ,cant_empleados = ? ,produccion_anual = ? ,facturacion_M_USD = ? WHERE id = ?');
    
    $query->execute(array($marca->nombre, $marca->origen, $marca->año_fundacion, $marca->cant_empleados, $marca->produccion_anual, $marca->facturacion_M_USD, $marca->id));
}



}
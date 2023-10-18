<?php

class ModelosModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=motos;charset=utf8', 'root', '');
    }

    /**
     * Obtiene y devuelve de la base de datos todos los modelos.
     */
    function getModelos() {
        $query = $this->db->prepare("SELECT * FROM modelos");
        $query->execute();

        // $modelos es un arreglo de modelos de motos
        $modelos = $query->fetchAll(PDO::FETCH_OBJ);

        return $modelos;
    }


    
    /**
     * Obtiene de la base de datos un modelo de moto, según un id y lo retorna.
     */
    function getModelo($id) {
       $query = $this->db->prepare("SELECT modelos.*, marcas.nombre AS nombre_marca
       FROM modelos
       INNER JOIN marcas ON modelos.id_marca = marcas.id
       WHERE modelos.id = $id");
       
        $query->execute();
        
        // $modelo es un arreglo que contiene un sólo modelo de moto
        $modelos = $query->fetchAll(PDO::FETCH_OBJ);
        $modelo=$modelos[0];
        return $modelo;

    }


    /**
     * Inserta un modelo de moto en la base de datos
     */
    function insertModelo($id_marca, $nombre, $cilindrada_cm3, $tipo, $potencia_hp, $peso_kg) {
        
        $consulta = "SELECT EXISTS(
            SELECT *
            FROM marcas
            WHERE id = :id
        );";
        
        $statement = $this->db->prepare($consulta);
        $statement->bindParam(':id', $id_marca);

        $statement->execute();

        $consulta_nombre = "SELECT EXISTS( SELECT * FROM modelos WHERE nombre = :nombre );";
        
        $statement2 = $this->db->prepare($consulta_nombre);
        $statement2->bindParam(':nombre', $nombre);

        $statement2->execute();
               

        if ($statement->fetchColumn() == 1){
            if($statement2->fetchColumn() == 0) {
                $query = $this->db->prepare('INSERT INTO modelos (id_marca, nombre, cilindrada_cm3, tipo, potencia_hp, peso_kg) VALUES(?,?,?,?,?,?)');
                $query->execute([$id_marca, $nombre, $cilindrada_cm3, $tipo, $potencia_hp, $peso_kg]);
                return $this->db->lastInsertId();
            } 
        
        }
    }

    
function deleteModelo($id) {
    $query = $this->db->prepare('DELETE FROM modelos WHERE id = ?');
    $query->execute([$id]);
}

function updateModelo($modelo) {    
    
    $query = $this->db->prepare('UPDATE modelos SET nombre = ?, cilindrada_cm3 = ?, tipo = ?, potencia_hp = ?, peso_kg = ? WHERE id = ?');
    
    $query->execute(array($modelo->nombre, $modelo->cilindrada_cm3, $modelo->tipo, $modelo->potencia_hp, $modelo->peso_kg, $modelo->id));
}

function getModelosMarca($id_marca) {
    
        $modelos = $this->getModelos();

        $arrModelos=array();

        foreach($modelos as $modelo){
            if($id_marca == $modelo->id_marca){
                array_push($arrModelos,$modelo);
            }

        }
       return $arrModelos;
}

}
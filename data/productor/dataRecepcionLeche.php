<?php

class dataRecepcionLeche {

    private $conexion;

    function dataRecepcionLeche() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }


    function dataRegistrarLeche(){

    	$con=$this->conexion->crearConexion();
        $registrarLeche = $con->query("CALL registrarLecheDiaria('$idpersona','$nombre','$precio','$cantidad','$unidad')");
        if($registrarProducto==1){
            return "true";

        }else{
            return "false";

        }

    }



?>
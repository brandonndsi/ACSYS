<?php

class dataUnidades {

    private $conexion;

    function dataUnidades() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

   
    //Mostrar Unidades
    function unidadesMostrar() {
        $con=$this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $mostrarUnidades = $con->query("CALL mostrarunidades()");
        $datos=array();
        while($result=$mostrarUnidades->fetch_assoc()){
            array_push($datos,$result);  
        }
        return json_encode($datos);

    
    }

    //Mostrar Funciones
     function funcionesMostrar() {
        $con=$this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $mostrarFunciones = $con->query("CALL mostrarfunciones()");
        $datos=array();
        while($result=$mostrarFunciones->fetch_assoc()){
            array_push($datos,$result);  
        }
        return json_encode($datos);

    
    }

    //mostrar Vias de aplicacion
     function viasMostrar() {
        $con=$this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $mostrarVias = $con->query("CALL mostrarvias()");
        $datos=array();
        while($result=$mostrarVias->fetch_assoc()){
            array_push($datos,$result);  
        }
        return json_encode($datos);
    }


}

?>

<?php

class dataUnidades {

    private $conexion;

    function dataUnidades() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

   
    // mostrar todo
    function unidadesMostrar() {
        $con=$this->conexion->crearConexion();
        $mostrarUnidades = $con->query("CALL mostrarunidades()");
        $datos=array();
        while($result=$mostrarUnidades->fetch_assoc()){
            array_push($datos,$result);  
        }
        return json_encode($datos);

    
    }


}

?>

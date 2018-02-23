<?php

class dataJuntaDirectiva {

    private $conexion;

    function dataJuntaDirectiva() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    // mostrar todo
    function juntasDirectivasMostrar() {

        $con = $this->conexion->crearConexion();
        $mostrarJuntasDirectivas = $con->query("CALL mostrarJuntaDirectiva()");
        $datos = array();
        while ($result = $mostrarJuntasDirectivas->fetch_assoc()) {
            array_push($datos, $result);
        }
        return json_encode($datos);
    }

    // registrar
    function juntaDirectivaRegistrar() {


    }

    //modificar

    function juntaDirectivaModificar() {


    }

    //eliminar
    function juntaDirectivaEliminar($id) {


    }

}

?>

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
    function juntaDirectivaRegistrar($presidente, $vicepresidente, $secretario, $tesorero, $fiscal, $vocal1, $vocal2, $inicio, $final) {

        $con = $this->conexion->crearConexion();
        /* registra la junta */
        $registrarJunta = $con->query("CALL registrarjuntadirectiva('$presidente','$vicepresidente','$secretario','$tesorero','$fiscal','$vocal1','$vocal2','$inicio','$final')");

        if ($registrarJunta == 1) {
            return "true";
        } else {
            return "false";
        }
    }

    //modificar
    function juntaDirectivaModificar($presidente, $vicepresidente, $secretario, $tesorero, $fiscal, $vocal1, $vocal2, $inicio, $final, $id) {

        $con = $this->conexion->crearConexion();

        $modificarJunta = $con->query("CALL modificarJuntaDirectiva('$presidente','$vicepresidente','$secretario','$tesorero','$fiscal','$vocal1','$vocal2','$inicio','$final','$id')");

        if ($modificarJunta == 1) {
            return "true";
        } else {
            return "false";
        }
    }

}

?>

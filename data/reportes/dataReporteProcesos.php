<?php

class dataReporteProcesos {

    private $conexion;

    function dataReporteProcesos() {
        include_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    public function ventaProcesos($fechainicial, $fechafinal) {

        $con = $this->conexion->crearConexion();
        $ventabuscarproceso = $con->query("CALL sacarReportesProcesos('$fechainicial','$fechafinal');");
        $datos = array();
        while ($result = $ventabuscarproceso->fetch_assoc()) {
            array_push($datos, $result);
        }
        echo json_encode($datos);
    }

}

?>
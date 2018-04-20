<?php 
class dataReportePagoLeche {

    private $conexion;

    function dataReportePagoLeche() {
        include_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    function verReportePagoLeche($fechaInicio,$fechaFinal){

    	$con=$this->conexion->crearConexion();
        $mostrar = $con->query("CALL verReportePagoLeche('$fechaInicio', '$fechaFinal');");
        $datos=array();
        while($result=$mostrar->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
    }

   }

?>
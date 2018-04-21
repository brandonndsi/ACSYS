<?php 
class dataReportePagoPrestamo {

    private $conexion;

    function dataReportePagoPrestamo() {
        include_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    function verPagosPrestamos($fechaInicio,$fechaFinal,$idPrestamo){

    	$con=$this->conexion->crearConexion();

        $mostrar = $con->query("CALL verReportePagoPrestramo('$fechaInicio', '$fechaFinal','$idPrestamo');");
        $datos=array();
        while($result=$mostrar->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
    }

    function obtenerPrestamosSocio($id){

        $con=$this->conexion->crearConexion();
        $con->set_charset('UTF8');
        $result=$con->query("SELECT tbprestamos.idprestamo, tbprestamos.montototalprestamo FROM tbprestamos WHERE idpersonaprestamo='$id'");
        $array=array();
        while($re=$result->fetch_assoc()){
             array_push($array,$re);  
        }
        echo json_encode($array); 
    }

   }



?>
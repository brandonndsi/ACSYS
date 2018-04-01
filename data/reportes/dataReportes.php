<?php 
class dataReportes {

    private $conexion;

    function dataReportes() {
        include_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    public function ventabuscar($fechainicial,$fechafinal){
    	$con=$this->conexion->crearConexion();
        $mostrarProductores = $con->query("CALL sacarreportesventa('$fechainicial','$fechafinal');");
        $datos=array();
        while($result=$mostrarProductores->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
	}

}
/*$dota=new dataReportes();
$d=$dota->ventabuscar('2018-03-01','2018-03-29');
print_r($d);*/
 ?>
<?php 
class dataReportes {

    private $conexion;

    function dataReportes() {
        include_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    public function ventabuscar($fechainicial,$fechafinal){
    	$con=$this->conexion->crearConexion();
        $ventabuscar = $con->query("CALL sacarreportesventa('$fechainicial','$fechafinal');");
        $datos=array();
        while($result=$ventabuscar->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
	}

    public function buscarDetalleVeterinario($idventa){
        
        $con=$this->conexion->crearConexion();
        $mostrarDetalleVeterinario = $con->query("CALL sacarDetalleVeterinario('$idventa');");
        $datos=array();
        while($result=$mostrarDetalleVeterinario->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
    }

    public function ventaNombre($id){
        $con=$this->conexion->crearConexion();
        $mostrarDetalleVentaNombre = $con->query("CALL sacarDetalleVentaNombre('$id');");
        $datos="";
        while($row=$mostrarDetalleVentaNombre->fetch_assoc()){
            $datos=$row['nombrepersona']." ".$row['apellido1persona']." ".$row['apellido2persona'];
        }

        echo $datos;
    }

}
/*$dota=new dataReportes();
$d=$dota->buscarDetalleVeterinario(5);
print_r($d);*/
 ?>
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
        $con=$this->conexion->cerrarConexion();
        $datos=array();
        while($result=$ventabuscar->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
	}
    public function ventabuscarDistribuidor($fechainicial,$fechafinal){
      
        $con=$this->conexion->crearConexion();
        $ventabuscar = $con->query("CALL sacarreporteventadistribuidor('$fechainicial','$fechafinal');");
        $con=$this->conexion->cerrarConexion();
        $datos=array();
        while($result=$ventabuscar->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
    }
    public function ventabuscarVentanilla($fechainicial,$fechafinal){
        $con=$this->conexion->crearConexion();
        $ventabuscar = $con->query("CALL sacarreporteventaventanilla('$fechainicial','$fechafinal');");
        $con=$this->conexion->cerrarConexion();
        $datos=array();
        while($result=$ventabuscar->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
    }
    public function buscarDetalleVeterinario($idventa){
        
        $con=$this->conexion->crearConexion();
        $mostrarDetalleVeterinario = $con->query("CALL sacarDetalleVeterinario('$idventa');");
        $con=$this->conexion->cerrarConexion();
        $datos=array();
        while($result=$mostrarDetalleVeterinario->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
    }
    public function buscarDetalleVentanilla($idventa){
        $con=$this->conexion->crearConexion();
        $mostrarDetalleVeterinario = $con->query("CALL sacarDetalleVentaVentanilla('$idventa');");
        $con=$this->conexion->cerrarConexion();
        $datos=array();
        while($result=$mostrarDetalleVeterinario->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 

    }
    public function ventaNombre($id){
        $con=$this->conexion->crearConexion();
        $mostrarDetalleVentaNombre = $con->query("CALL sacarDetalleVentaNombre('$id');");
        $con=$this->conexion->cerrarConexion();
        $datos="";
        while($row=$mostrarDetalleVentaNombre->fetch_assoc()){
            $datos=$row['nombrepersona']." ".$row['apellido1persona']." ".$row['apellido2persona'];
        }

        echo $datos;
    }

    public function buscarDetalleDistribidor($id){
       
        $con=$this->conexion->crearConexion();
        $mostrarDetalleVentaDistribuidor = $con->query("CALL sacarDetalleVentaDistribuidor('$id');");
        $con=$this->conexion->cerrarConexion();
        $datos=array();
        while($row=$mostrarDetalleVentaDistribuidor->fetch_assoc()){
            array_push($datos,$row);  
        }
        echo json_encode($datos); 
    }
    public function buscarDetalleDistribuidor($idventa){
        
        $con=$this->conexion->crearConexion();
        $mostrarDetalleVeterinario = $con->query("CALL sacarDetalleVentaDistribuidor('$idventa');");
        $con=$this->conexion->cerrarConexion();
        $datos=array();
        while($result=$mostrarDetalleVeterinario->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
    }
    public function ventaPrestamos($fechainicial,$fechafinal){

        $con=$this->conexion->crearConexion();
        $ventabuscar = $con->query("CALL sacarreportesPrestamos('$fechainicial','$fechafinal');");
        $con=$this->conexion->cerrarConexion();
        $datos=array();
        while($result=$ventabuscar->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
    }

    public function ventaPagos($fechainicial,$fechafinal){
        //print("hola");
        $con=$this->conexion->crearConexion();
        $ventaProto = $con->query("CALL sacarreportespagosll('$fechainicial','$fechafinal');");
        $con=$this->conexion->cerrarConexion();
        $datos=array();
        while($result=$ventaProto->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
    }

}
/*$dota=new dataReportes();
$d=$dota->buscarDetalleVentanilla('35');

print_r($d);*/
 ?>
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

    public function buscarDetalleDistribidor($id){
       
        $con=$this->conexion->crearConexion();
        $mostrarDetalleVentaDistribuidor = $con->query("CALL sacarDetalleVentaDistribuidor('$id');");
        $datos=array();
        while($row=$mostrarDetalleVentaDistribuidor->fetch_assoc()){
            array_push($datos,$row);  
        }
        echo json_encode($datos); 
    }

    public function ventaPrestamos($fechainicial,$fechafinal){
        /*
     
        SELECT s.idsolicitud, p.nombrepersona,
        p.apellido1persona ,p.apellido2persona,
        r.porcentaje,s.cantidadsolicitud, s.plazo, t.tipopagoprestamo,
        s.fecha , s.estado FROM tbsolicitudprestamo s
        INNER JOIN tbperiodopagoprestamo t ON 
        t.idperiodopagoprestamo=s.idmodoplazo
        INNER JOIN tbinteresprestamo r ON
        r.idinteres=s.idinteres
        INNER JOIN tbpersona p ON
        p.idpersona=s.idpersona
        WHERE s.estado='Solicitud' AND 
        fecha>=inicial AND fecha<=final;
         */

        $con=$this->conexion->crearConexion();
        $ventabuscar = $con->query("CALL sacarreportesPrestamos('$fechainicial','$fechafinal');");
        $datos=array();
        while($result=$ventabuscar->fetch_assoc()){
            array_push($datos,$result);  
        }
        echo json_encode($datos); 
    }

}
/*$dota=new dataReportes();
$d=$dota->ventaPrestamos('2018-04-05','2018-04-07');
print_r($d);*/
 ?>
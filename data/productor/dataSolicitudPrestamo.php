<?php
    class dataSolicitudPrestamo{

        private $conexion;

        function dataSolicitudPrestamo(){
            include '../../data/conexion/conexion.php';
            $this->conexion = new conexion();
        }

       

        
        function consultarSolicitud(){
            $resultado=$this->consultas("CALL mostrarSolicitudes()");
            $array=array();
            while($resul=$resultado->fetch_assoc()){
                array_push($array,$resul);

            }
            return json_encode($array);

           
        }
        
        function aprobarSolicitud($idSolicitud){
          $datos = $this->consultarDatos($idSolicitud);
          $idPersona = $datos['idpersona'];
          $interes=$datos['porcentaje'];
          $plazo=$datos['plazo'];
          $montoTotal=(double)$datos['cantidadsolicitud'];
          $montoCuota=(double)$montoTotal*(double)$interes;
          $montoCuota=(double)$montoCuota+(double)$montoTotal;
          $montoCuota = (double)$montoCuota/(double)$plazo;
          $fecha=$datos['fecha'];

          $resultado=$this->consultas("CALL aprobarSolicitud('$idSolicitud','$idPersona','$interes','$montoTotal','$montoCuota','$fecha')");
          if($resultado==1){
            return "true" ;
          }else{

            return "false" ;
          }
          
        }

        function rechazarSolicitud($idSolicitud){

          $resultado=$this->consultas("CALL rechazarSolicitud('$idSolicitud')");
          if($resultado==1){
            return "true" ;
          }else{

            return "false" ;
          }
        }  
         
        function consultas($query){
          $con = $this->conexion->crearConexion();
          $con->set_charset("UTF8");
          $resultado = $con->query($query);
          return $resultado;
        }

        function consultarDatos($idSolicitud){
          $resultado = $this->consultas("SELECT tbsolicitudprestamo.idpersona,tbsolicitudprestamo.plazo,tbsolicitudprestamo.cantidadsolicitud,tbinteresprestamo.porcentaje,tbsolicitudprestamo.fecha FROM tbsolicitudprestamo INNER JOIN tbinteresprestamo ON tbinteresprestamo.idinteres= tbsolicitudprestamo.idinteres WHERE tbsolicitudprestamo.idsolicitud='$idSolicitud'");
          $resultado = $resultado->fetch_assoc();
          return $resultado;

        }


        
      }

?>
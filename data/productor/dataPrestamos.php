<?php
    class dataPrestamos{

        private $conexion;

        function dataPrestamos(){
            include '../../data/conexion/conexion.php';
            $this->conexion = new conexion();
        }

        function registrarSolicitudPrestamo($idPersona,$interes,$montoPrestamo,$plazo,$modoPlazo){
          $con = $this->conexion->crearConexion();
          $con->set_charset("UTF8");
          $date = date("Y-m-d");
          $interes = $this->obtenerInteresId($interes);
          $modoPlazo = $this->obtnerModoPlazoId($modoPlazo);
          $resultado = $con->query("CALL registrarSolicitudPrestamo('$idPersona','$interes','$montoPrestamo','$plazo','$modoPlazo','$date')");
          if($resultado == 1){
            return "true";
          }else{
            return "false";
          }
        }

        function obtenerInteresId($interes){
          $con = $this->conexion->crearConexion();
          $con->set_charset("UTF8");
          $result = $con->query("SELECT idinteres FROM tbinteresprestamo WHERE porcentaje='$interes'");
          return $result->fetch_assoc()['idinteres'];
        }

        function obtnerModoPlazoId($modoPlazo){
          $con = $this->conexion->crearConexion();
          $con->set_charset("UTF8");
          $result = $con->query("SELECT idperiodopagoprestamo FROM tbperiodopagoprestamo WHERE tipopagoprestamo='$modoPlazo'");
          return $result->fetch_assoc()['idperiodopagoprestamo'];
        }
      }

?>

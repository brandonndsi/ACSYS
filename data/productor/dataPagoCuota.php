<?php
    class dataPagoCuota{

        private $conexion;

        function dataPagoCuota(){
            include '../../data/conexion/conexion.php';
            $this->conexion = new conexion();
        }

       function registrarPagoCuota($idProductor,$cuota,$saldoAnterior){
          $hora=date("g:i A");
          $fechaPago=date();
          $resultado = $this->consultas("CALL registrarPagoCuota('$idPersona','$cuota','$saldoAnterior','$saldoActual','$fecha','$hora')");
            if($resultado == 1){
              return "true";
            }else{
              return "false";
            }
        }

        function obtenerPrestamosActivosProductor($id){

          $resultado=$this->consultas("CALL obtenerPrestamosActivos('$id')");
          $array=array();
          while($resul=$resultado->fetch_assoc()){
              array_push($array,$resul);
          }
          return json_encode($array);
        }

        function obtenerSaldoActual(){


        }   
          
         
        function consultas($query){
          $con = $this->conexion->crearConexion();
          $con->set_charset("UTF8");
          $resultado = $con->query($query);
          return $resultado;
        }


        
      }

?>
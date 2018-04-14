<?php
    class dataPagoCuota{

        private $conexion;

        function dataPagoCuota(){
            include '../../data/conexion/conexion.php';
            $this->conexion = new conexion();
        }

       function registrarPagoCuota($idPrestamoCobrar,$cuota){
          $hora=date("g:i A");
          $fecha=date("Y-m-d");
          $estado="activo";
          $saldoActual=$this->consultas("SELECT saldoactualprestamoporcobrar FROM tbprestamosporcobrar WHERE idprestamoporcobrar='$idPrestamoCobrar'")->fetch_assoc()['saldoactualprestamoporcobrar'];

          $nuevoSaldo= $saldoActual-$cuota;
          if($nuevoSaldo<0){
            return "false";

          }else{
            if($nuevoSaldo==0){
              $estado="pagado";
            }

            $resultado = $this->consultas("CALL registrarPagoCuota('$idPrestamoCobrar','$saldoActual','$nuevoSaldo','$cuota','$fecha','$hora','$estado')");
              if($resultado == 1){
                return "true";
              }else{
                return "false";
              }
            }

          
        }

        function obtenerPrestamosActivosProductor($id){

          $resultado=$this->consultas("CALL obtenerPrestamosActivos('$id')");
          $array=array();
          while($resul=$resultado->fetch_assoc()){
            $idprestamoporcobrar=$resul['idprestamoporcobrar'];
            $fechapagoprestamo=$this->consultas("SELECT fechapagoprestamo FROM tbpagoprestamo WHERE idprestamoporcobrar='$idprestamoporcobrar' ORDER BY idpagoprestamo DESC LIMIT 1")->fetch_assoc()['fechapagoprestamo'];
            if($fechapagoprestamo==null){
               $fechapagoprestamo="No se ha realizado ningún pago";
            }
            $dato = array('idprestamo' => $resul['idprestamo'],'montototalprestamo'=>$resul['montototalprestamo'],'fechaprestamo'=>$resul['fechaprestamo'],'montocuota'=>$resul['montocuota'],'saldoactualprestamoporcobrar'=>$resul['saldoactualprestamoporcobrar'],'fechapagoprestamo'=>$fechapagoprestamo,'idprestamoporcobrar'=>$idprestamoporcobrar);
            array_push($array,$dato);

          }
          return json_encode($array);
        }

     
          
         
        function consultas($query){
          $con = $this->conexion->crearConexion();
          $con->set_charset("UTF8");
          $resultado = $con->query($query);
          return $resultado;
        }


        
      }

?>
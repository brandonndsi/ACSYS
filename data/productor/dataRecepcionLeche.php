<?php

class dataRecepcionLeche {

    private $conexion;

    function dataRecepcionLeche() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }


    function registrarLeche($cliente,$fecha,$turno,$peso){
        if($this->verificarTurno($cliente,$fecha,$turno)){

            $con=$this->conexion->crearConexion();
            $con->set_charset("UTF8");
            $registrarLeche = $con->query("CALL registrarLecheDiaria('$cliente','$fecha','$turno','$peso')");
            if($registrarLeche==1){
                return "Se ingresó el registro de leche correctamente";

            }else{
                return "Error al registrar el turno para este cliente";

            }
        }else{

            return "El turno ingresado ya está registrado para este cliente";
        }
    	
       
        

    }

    function verificarTurno($cliente,$fecha,$turno){

        $con=$this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $verificar=$con->query("CALL verificarturno('$fecha','$turno','$cliente')");
        $bandera = true;
        while($datos=$verificar->fetch_assoc()){
            $bandera=false;
        }
        return $bandera;
        

    }

    function consultar
}
?>
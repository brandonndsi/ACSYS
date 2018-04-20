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
    //verifica que el registro de leche en x turno no se haya realizado con anterioridad
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

    function consultarRecepcion($fecha){
        $con=$this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $consultar=$con->query("CALL consultarRecepcion('$fecha')");
        $datos=array();
        while($result=$consultar->fetch_assoc()){
            $bandera = false;
            $i = 0;
            foreach ($datos as $dato => $value) {
                if($value['idpersona'] == $result['idpersona']){
                    if($result['turnopesolechediario']=="Mañana"){
                        $datos[$i]['turnomanana'] = $result['pesoturno'];
                    }else{
                        $datos[$i]['turnotarde'] = $result['pesoturno'];
                    }
                    $bandera = true;
                }
                $i++;
            }
            if(!$bandera){
                if($result['turnopesolechediario']=="Mañana"){
                    $recepcion = array('idpersona' => $result['idpersona'],'idpesalechediario' => $result['idpesalechediario'] ,'nombrepersona' => $result['nombrepersona'],'apellido1persona' => $result['apellido1persona'],'apellido2persona' => $result['apellido2persona'],'turnomanana' => $result['pesoturno'],'turnotarde' =>0,'turno' =>$result['turnopesolechediario'],'fechaentregalechediario'=>$fecha);
                }else{
                    $recepcion = array('idpersona' => $result['idpersona'],'idpesalechediario' => $result['idpesalechediario'] ,'nombrepersona' => $result['nombrepersona'],'apellido1persona' => $result['apellido1persona'],'apellido2persona' => $result['apellido2persona'],'turnomanana' => 0,'turnotarde' =>$result['pesoturno'],'turno' =>$result['turnopesolechediario'],'fechaentregalechediario'=>$fecha );
                }
                array_push($datos,$recepcion);
            }
            
        }
        return json_encode($datos);

    }
}
?>
<?php

class dataProductor {

    private $conexion;

    function dataProductor() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

   
    // mostrar todo
    function productoresMostrar() {
        $con=$this->conexion->crearConexion();
        $mostrarProductores = $con->query("CALL mostrarproductores()");
        $datos=array();
        while($result=$mostrarProductores->fetch_assoc()){
            array_push($datos,$result);  
        }
        return json_encode($datos);

    
    }

    function productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){
        $con=$this->conexion->crearConexion();
        $modificarProductor = $con->query("CALL modificarproductores('$cedula','$nombre','$apellido1','$apellido2','$telefono','$direccion','$correo','$id')");
        if($modificarProductor==1){
            return "true";

        }else{
            return "false";

        }

    }

}

?>

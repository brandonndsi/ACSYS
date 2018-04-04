<?php

class dataProductorSocio {

    private $conexion;

    function dataProductorSocio() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

   function imagenesProductorSocio($idproductorcliente){
        $con=$this->conexion->crearConexion();
        $mostrarProductores = $con->query("CALL sacarimagenproductorsocio('$idproductorcliente
            ');");
        $datos=array();
        while($result=$mostrarProductores->fetch_assoc()){
            array_push($datos,$result);  
        }
        return $datos; 
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

    function productorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){
        $con=$this->conexion->crearConexion();
        $registrarProductor = $con->query("CALL registrarpersona('$cedula','$nombre','$apellido1','$apellido2','$telefono','$direccion','$correo')");
        if($registrarProductor==1){
            $registrarProductor = $con->query("CALL registrarproductorsocio()");
            return "true";

        }else{
            return "false";

        }

    }

    function productorEliminar($id){
        
        $con=$this->conexion->crearConexion();
        $eliminarProductor = $con->query("CALL eliminarproductorsocio('$id')");
        if($eliminarProductor==1){
            return "true";

        }else{
            return "false";


        }

    }

}

?>

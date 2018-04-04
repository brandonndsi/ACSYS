<?php

class dataProductorCliente {

    private $conexion;

    function dataProductorCliente() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    function imagenesProductorCliente($idproductorcliente){
        $con=$this->conexion->crearConexion();
        $mostrarProductores = $con->query("CALL sacarimagenproductorcliente('$idproductorcliente
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
        $mostrarProductores = $con->query("CALL mostrarproductoresclientes()");
        $datos=array();
        while($result=$mostrarProductores->fetch_assoc()){
            array_push($datos,$result);  
        }
        return json_encode($datos);

    
    }

    function productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){
        $con=$this->conexion->crearConexion();
        $modificarProductor = $con->query("CALL modificarproductorcliente('$id','$nombre','$cedula','$apellido1','$apellido2','$telefono','$direccion','$correo')");
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
            $registrarProductor = $con->query("CALL registrarproductorcliente()");
            return "true";

        }else{
            return "false";

        }

    }

    function productorEliminar($id){
        
        $con=$this->conexion->crearConexion();
        $eliminarProductor = $con->query("CALL eliminarproductorcliente('$id')");
        if($eliminarProductor==1){
            return "true";

        }else{
            return "falsee";


        }

    }

}

?>

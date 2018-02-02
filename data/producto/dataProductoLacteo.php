<?php

class dataProductoLacteo {

    private $conexion;

    function dataProductoLacteo() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

   
    // mostrar todo
    function productoMostrar() {
        $con=$this->conexion->crearConexion();
        $mostrarProducto = $con->query("CALL mostrarproductolacteo()");
        $datos=array();
        while($result=$mostrarProducto->fetch_assoc()){
            array_push($datos,$result);  
        }
        return json_encode($datos);

    
    }

    function productoModificar($codigo,$nombre,$precio,$cantidad,$unidad){
        $con=$this->conexion->crearConexion();
        $modificarProducto = $con->query("CALL modificarproductolacteo('$codigo','$nombre','$precio','$cantidad','$unidad')");
        if($modificarProducto==1){
            return "true";

        }else{
            return "falsee";

        }

    }

    function productoRegistrar($codigo,$nombre,$precio,$cantidad,$unidad){
        $con=$this->conexion->crearConexion();
        $registrarProductor = $con->query("CALL registrarproductolacteo('$codigo','$nombre','$precio','$cantidad','$unidad')");
        if($registrarProductor==1){
            return "true";

        }else{
            return "false";

        }

    }

    function productoEliminar($id){
        
        $con=$this->conexion->crearConexion();
        $eliminarProductor = $con->query("CALL eliminarproductolacteo('$id')");
        if($eliminarProductor==1){
            return "true";

        }else{
            return "falsee";


        }

    }

}

?>

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

    function productoModificar($codigo,$nombre,$precio,$unidad){
        $con=$this->conexion->crearConexion();
        $modificarProducto = $con->query("CALL modificarproductolacteo('$codigo','$nombre','$precio','0','$unidad')");
        if($modificarProducto==1){
            return "true";

        }else{
            return "falsee";

        }

    }

    function productoRegistrar($codigo,$nombre,$precio,$unidad){
        $con=$this->conexion->crearConexion();
        $registrarProducto = $con->query("CALL registrarproductolacteo('$codigo','$nombre','$precio','0','$unidad')");
        if($registrarProducto==1){
            return "true";

        }else{
            return "false";

        }

    }

    function productoEliminar($codigo){
        
        $con=$this->conexion->crearConexion();
        $eliminarProducto = $con->query("CALL eliminarproductolacteo('$codigo')");
        if($eliminarProducto==1){
            return "true";

        }else{
            return "false";


        }

    }

}

?>

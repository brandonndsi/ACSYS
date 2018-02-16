<?php

class dataProductoVeterinario {

    private $conexion;

    function dataProductoVeterinario() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

   
    // mostrar todo
    function productoMostrar() {
        $con=$this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $mostrarProducto = $con->query("CALL mostrarproductoveterinario()");
        $productos = array();
        while($result=$mostrarProducto->fetch_assoc()){
            $productos[] = $result;
        }
       return $productos;

    
    }
    function productoModificar($codigo,$nombre,$descripcion,$precio,$dosis,$dias,$via,$funcion){
        $con=$this->conexion->crearConexion();
        $con->set_charset("UTF8");
       
        $modificarProducto = $con->query("CALL modificarproductoveterinario('$codigo','$nombre','$descripcion','$dosis','$dias','$via','$funcion','$precio')");
                                                                          
        if($modificarProducto==1){
            return "true";

        }else{
            return "falsee";

        }
          
    }

    function productoRegistrar($codigo,$nombre,$descripcion,$precio,$dosis,$dias,$via,$funcion){
        $con=$this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $registrarProducto = $con->query("CALL registrarproductoveterinario('$codigo','$nombre','$descripcion','$dosis','$dias','$via','$funcion','$precio')");

        if($registrarProducto==1){
            return "true";

        }else{
            return "false";

        }

    }

    function productoEliminar($codigo){
        
        $con=$this->conexion->crearConexion();
        $eliminarProducto = $con->query("CALL eliminarproductoveterinario('$codigo')");
        if($eliminarProducto==1){
            return "true";

        }else{
            return "false";


        }

    }

}

?>

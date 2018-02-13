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
        $mostrarProducto = $con->query("CALL mostrarproductoveterinario()");
        $datos=array();
        while($result=$mostrarProducto->fetch_assoc()){
            array_push($datos,$result);
            echo json_encode($result);  
        }

        return json_encode($datos);

    
    }

    function productoModificar($codigo,$nombre,$descripcion,$precio,$dosis,$dias,$via,$funcion){
        $con=$this->conexion->crearConexion();
        $modificarProducto = $con->query("CALL modificarproductoveterinario('$codigo','$nombre','$descripcion','$precio','$dosis','$dias','$via','$funcion')");
        if($modificarProducto==1){
            return "true";

        }else{
            return "falsee";

        }
          
    }

    function productoRegistrar($codigo,$nombre,$descripcion,$precio,$dosis,$dias,$via,$funcion){
        $con=$this->conexion->crearConexion();
        $registrarProducto = $con->query("CALL registrarproductoveterinario('$codigo','$nombre','$descripcion','$precio','$dosis','$dias','$via','$funcion')");
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

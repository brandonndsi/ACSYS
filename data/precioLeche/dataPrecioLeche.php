<?php

class dataPrecioLeche {

    private $conexion;

    function dataPrecioLeche() {
        date_default_timezone_set("America/Costa_Rica");
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    function verPrecio() {
        $con = $this->conexion->crearConexion();
        $verPrecioLeche = $con->query("CALL verPrecioLeche()");
        $datos = array();
        while ($result = $verPrecioLeche->fetch_assoc()) {
            array_push($datos, $result);
        }
        return json_encode($datos);
    }

    function actualizarPrecio($id, $precio) {

        $con = $this->conexion->crearConexion();
        $fecha = date('Y-m-d');
        $actualizarPrecio = $con->query("CALL actualizarPrecioLeche('$precio','$fecha','$id')");

        if ($actualizarPrecio == 1 && $precio > 0) {
            return "true";
        } else {
            return "false";
        }
    }
}
?>

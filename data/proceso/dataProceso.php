<?php

class dataProceso {

    private $conexion;

    function dataProceso() {
        date_default_timezone_set("America/Costa_Rica");
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    // mostrar todo
    function procesosMostrar() {

        $con = $this->conexion->crearConexion();
        $mostrarProcesos = $con->query("CALL mostrarProcesos()");
        $datos = array();
        while ($result = $mostrarProcesos->fetch_assoc()) {
            array_push($datos, $result);
        }
        return json_encode($datos);
    }

    function consultarProducto() {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $mostrarProducto = $con->query("CALL mostrarproductolacteo()");
        $datos = array();
        while ($result = $mostrarProducto->fetch_assoc()) {
            array_push($datos, $result);
        }
        return json_encode($datos);
    }

    // registrar
    function procesoRegistrar($nombre, $cantidad, $porcentaje, $entera, $descremada, $cuajo, $cloruro, $sal, $cultivo, $estabilizador, $colorante, $crema1, $leche1, $crema2, $leche2) {

        $con = $this->conexion->crearConexion();
        $fecha = date('Y-m-d');
        $hora = date("g:i A");
        $registrarProceso = $con->query("CALL registrarProceso('$nombre','$cantidad','$porcentaje','$entera','$descremada','$cuajo','$cloruro','$sal','$cultivo','$estabilizador','$colorante','$crema1','$leche1','$crema2','$leche2','$hora','$fecha')");

        if ($registrarProceso == 1) {
            $cox = $this->conexion->crearConexion();
            $cox->set_charset("utf8");
            $sumastock = $cox->query("CALL sumastockproceso('$cantidad','$nombre')");
            return "true";
        } else {
            return "false";
        }
    }

    function procesoEliminar($cantidad, $nombre, $id) {
        $cox = $this->conexion->crearConexion();
        $cox->set_charset("utf8");
        $restatock = $cox->query("CALL restastockproceso('$cantidad','$nombre')");
        
        if ($restatock == 1) {
            $con = $this->conexion->crearConexion();
            $eliminarProceso = $con->query("CALL eliminarproceso('$id')");
            return "true";
        } else {
            return "false";
        }
    }

    // modifica
    function procesoModificar($nombre, $nuevo, $viejo, $porcentaje, $entera, $descremada, $cuajo, $cloruro, $sal, $cultivo, $estabilizador, $colorante, $crema1, $leche1, $crema2, $leche2, $hora, $fecha, $id) {

        $con = $this->conexion->crearConexion();
        /* modifica */
        $registrarProceso = $con->query("CALL modificarProceso('$nombre','$nuevo','$porcentaje','$entera','$descremada','$cuajo','$cloruro','$sal','$cultivo','$estabilizador','$colorante','$crema1','$leche1','$crema2','$leche2','$hora','$fecha','$id')");

        if ($registrarProceso == 1) {
            if ($nuevo > $viejo) {

                $cantidad = $nuevo - $viejo;
                $cox = $this->conexion->crearConexion();
                $cox->set_charset("utf8");
                $sumastock = $cox->query("CALL sumastockproceso('$cantidad','$nombre')");

                return "true";
            } else {

                $cantidad = $viejo - $nuevo;
                $cox = $this->conexion->crearConexion();
                $cox->set_charset("utf8");
                $restatock = $cox->query("CALL restastockproceso('$cantidad','$nombre')");

                return "true";
            }
        } else {
            return "false";
        }
    }

}

?>

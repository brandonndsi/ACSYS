<?php

class dataVentaVentanilla {

    private $conexion;

    function dataVentaVentanilla() {
        date_default_timezone_set("America/Costa_Rica");
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    function searchProduct($code) {
        $con = $this->conexion->crearConexion();
        $con->set_charset("utf8");
        $query = $con->query("CALL searchproductlacteo('$code')");
        return json_encode($query->fetch_assoc());
    }

    function procesarVenta($productos, $idCliente, $totalNeto, $totalBruto) {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $facturaVenta = $this->getFactura();
        $idVenta = $this->registrarVenta($idCliente, $totalNeto, $totalBruto, $facturaVenta);
        //$this->registrarProductosLacteos($productos, $idVenta);

        if ($idCliente != 0) {
            $this->registrarVentaPorCobrar($idCliente, $idVenta, $totalNeto);
        } else {
            $this->registrarProductosLacteos($productos, $idVenta);
        }
    }

    function getFactura() {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $sqlQuery = $con->query("SELECT ultimafactura FROM tbfacturero");
        $factura = $sqlQuery->fetch_assoc()['ultimafactura'];
        return $factura;
    }

    function registrarVenta($idCliente, $totalNeto, $totalBruto, $facturaVenta) {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $tipoVenta = "Ventanilla";
        $fecha = date('Y-m-d');
        $hora = date("g:i A");
        $sqlQuery = $con->query("CALL registrarVenta('$idCliente','$facturaVenta','$fecha','$hora','$totalBruto','$totalNeto','$tipoVenta')");
        if ($sqlQuery == 1) {
            return true;
        } else {
            return false;
        }
    }

    function registrarVentaPorCobrar($idCliente, $idVenta, $totalVenta) {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $sqlQuery = $con->query("CALL registrarVentaPorCobrar('$idCliente','$idVenta','$totalVenta')");
        if ($sqlQuery == 1) {
            return true;
        } else {
            return false;
        }
    }

    /*function registrarProductosLacteos($productos, $idVenta) {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $productos = json_decode($productos);
        foreach ($productos as $producto) {
            $total = $producto->precio * $producto->cantidad;
            $descuento = $producto->precio;
            $con->query("CALL registrarDetalleVenta('$producto->precio','$producto->cantidad','$total','$producto->codigo','$descuento','$idVenta')");
        }
    }*/

}

?>
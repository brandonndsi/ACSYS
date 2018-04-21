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

        $idVenta = $this->registrarVentaVentanilla($idCliente, $totalNeto, $totalBruto, $facturaVenta);

        if ($idCliente != 0) {
            $this->registrarDetalleVenta($productos, $idVenta);
        } else {
            return false;
        }
    }

    function getFactura() {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $sqlQuery = $con->query("SELECT ultimafactura FROM tbfacturero");
        $factura = $sqlQuery->fetch_assoc()['ultimafactura'];
        return $factura;
    }

    function registrarVentaVentanilla($idCliente, $totalNeto, $totalBruto, $facturaVenta) {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $tipoVenta = "Ventanilla";
        $fecha = date('Y-m-d');
        $hora = date("g:i A");

        $sqlQuery = $con->query("CALL registrarVentaVentanilla('$facturaVenta','$fecha','$hora','$totalBruto','$totalNeto','$tipoVenta','$idCliente')");
        return $sqlQuery->fetch_assoc()['idventa'];
    }

    function registrarDetalleVenta($productos, $idVenta) {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $productos = json_decode($productos);
        
        foreach ($productos as $producto) {
            $total = $producto->precio * $producto->cantidad;
            $con->query("CALL registrarDetalleVenta('" . $producto->precio . "','" . $producto->cantidad . "','" . $total . "','" . $producto->codigo . "','0','" . $idVenta . "');");
        }
        
    }

    function idfactura() {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $sqlQuery = $con->query("SELECT `ultimafactura` FROM `tbfacturero`;");
        $array;
        while ($row = $sqlQuery->fetch_assoc()) {
            $array = $row['ultimafactura'];
        }

        return $array;
    }

}

?>
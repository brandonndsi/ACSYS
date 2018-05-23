<?php
  class dataVentaVeterinaria{

    private $conexion;

		function __construct(){
      date_default_timezone_set("America/Costa_Rica");
			require_once '../../data/conexion/conexion.php';
			$this->conexion = new conexion();
		}

    function searchProduct($code){
      $con = $this->conexion->crearConexion();
      $con->set_charset("utf8");
      $query = $con->query("CALL searchproductveterinario('$code')");
      return json_encode($query->fetch_assoc());
    }

    function getFactura(){
      $con = $this->conexion->crearConexion();
      $con->set_charset("UTF8");
      $sqlQuery = $con->query("SELECT ultimafactura FROM tbfacturero");
      $factura = $sqlQuery->fetch_assoc()['ultimafactura'];
      return $factura;
    }

    function registrarVenta($idCliente,$totalNeto,$totalBruto,$facturaVenta){
      $con = $this->conexion->crearConexion();
      $con->set_charset("UTF8");
      $tipoVenta = "Veterinaria";
      $fecha = date('Y-m-d');
      $hora = date("g:i A");
      $sqlQuery = $con->query("CALL registrarVenta('$idCliente','$facturaVenta','$fecha','$hora','$totalBruto','$totalNeto','$tipoVenta')");
      return $sqlQuery->fetch_assoc()['idventa'];
    }

    function registrarVentaPorCobrar($idCliente,$idVenta,$totalVenta){
      $con = $this->conexion->crearConexion();
      $con->set_charset("UTF8");
      $sqlQuery = $con->query("CALL registrarVentaPorCobrar('$idCliente','$idVenta','$totalVenta')");
      if($sqlQuery == 1){
        return true;
      }else{
        return false;
      }
    }

    function registrarProductosVentaVeterinaria($productos,$idVenta){
      $con = $this->conexion->crearConexion();
      $con->set_charset("UTF8");
      $productos = json_decode($productos);
      foreach ($productos as $producto) {
        echo($producto->precio);
        $total = $producto->precio * $producto->cantidad;
        $con->query("CALL registrarDetalleVentaVeterinaria('$producto->precio','$producto->cantidad','$total','$producto->codigo','$idVenta')");
      }
    }

    function procesarVenta($productos,$idCliente,$totalNeto,$totalBruto){
      $facturaVenta = $this->getFactura();
      $idVenta = $this->registrarVenta($idCliente,$totalNeto,$totalBruto,$facturaVenta);
      if($idCliente != 0){
        $this->registrarVentaPorCobrar($idCliente,$idVenta,$totalNeto);
      }
      $this->registrarProductosVentaVeterinaria($productos,$idVenta);
    }
    
  }
 ?>

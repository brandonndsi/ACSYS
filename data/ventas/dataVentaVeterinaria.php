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

    function procesarVenta($productos,$idCliente,$totalNeto,$totalBruto){
      $con = $this->conexion->crearConexion();
      $facturaVenta = $this->getFactura();
      $this->registrarVenta($idCliente,$totalNeto,$totalBruto,$facturaVenta);
    }

    function getFactura(){
      $con = $this->conexion->crearConexion();
      $sqlQuery = $con->query("SELECT ultimafactura FROM tbfacturero");
      $factura = $sqlQuery->fetch_assoc()['ultimafactura'];
      return $factura;
    }

    function registrarVenta($idCliente,$totalNeto,$totalBruto,$facturaVenta){
      $con = $this->conexion->crearConexion();
      $con->set_charset("UTF8");
      $tipoVenta = "";
      if($idCliente == 1){
        $tipoVenta = "Contado";
      }else{
        $tipoVenta = "Credito";
      }
      $fecha = date('Y-m-d');
      $hora = date("g:i A");
      $sqlQuery = $con->query("CALL registrarVenta('$idCliente','$facturaVenta','$fecha','$hora','$totalBruto','$totalNeto','$tipoVenta')");
      if($sqlQuery == 1){
        return true;
      }else{
        return false;
      }
    }
  }
 ?>

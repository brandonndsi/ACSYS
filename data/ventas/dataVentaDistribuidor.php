<?php
  class dataVentaDistribuidor{

    private $conexion;

		function dataVentaDistribuidor(){
      date_default_timezone_set("America/Costa_Rica");
			require_once '../../data/conexion/conexion.php';
			$this->conexion = new conexion();
		}

    function searchProduct($code){
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
      $tipoVenta = "Distribuidor";
      $fecha = date('Y-m-d');
      $hora = date("g:i A");
       $sqlQuery = $con->query("CALL registrarVenta('$idCliente','$facturaVenta','$fecha','$hora','$totalBruto','$totalNeto','$tipoVenta')");
        if ($sqlQuery == 1) {
            return true;
        } else {
            return false;
        }

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

    /*function registrarProductosVentaVeterinaria($productos,$idVenta){
      $con = $this->conexion->crearConexion();
      $con->set_charset("UTF8");
      $productos = json_decode($productos);
      foreach ($productos as $producto) {
        echo($producto->precio);
        $total = $producto->precio * $producto->cantidad;
        $con->query("CALL registrarDetalleVentaVeterinaria('$producto->precio','$producto->cantidad','$total','$producto->codigo','$idVenta')");
      }
    }*/

    /*function procesarVenta($productos,$idCliente,$totalNeto,$totalBruto){
      $facturaVenta = $this->getFactura();
      $idVenta = $this->registrarVenta($idCliente,$totalNeto,$totalBruto,$facturaVenta);
      if($idVenta != 0){
        $this->registrarVentaPorCobrar($idCliente,$idVenta,$totalNeto);
      }
      $this->registrarProductosVentaVeterinaria($productos,$idVenta);
    }*/


  }
  /*$d= new dataVentaDistribuidor();
  $r=$d->searchProduct('1234');
  print_r($d);*/
 ?>

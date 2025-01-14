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
/*
procedimiento almacenado modificado

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `searchproductlacteo`(IN `codigo` TEXT)
    NO SQL
    DETERMINISTIC
BEGIN
  SELECT nombreproductolacteo,preciounitarioproductolacteo
  FROM tbproductoslacteos
  WHERE codigoproductoslacteos=codigo AND   cantidadinventarioproductolacteo > 0 LIMIT 1;
END$$
DELIMITER ;
 */

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

      public function registrarProductosLacteos($productos,$totalNeto,$idVenta){
          $con = $this->conexion->crearConexion();
          $con->set_charset("UTF8");
          $productos = json_decode($productos);
            /*foreach ($productos as $producto) {
              //echo($producto->precio);
              $total = $producto->precio * $producto->cantidad;
              $con->query("CALL registrardetalleventadistribuidor('$producto->precio','$producto->cantidad','$total','$producto->codigo','0','$idVenta')");
           
          }*/
           //return $productos;
          foreach ($productos as $producto) {
            $con->query("CALL registrarDetalleVenta('" . $producto->precio . "','" . $producto->cantidad . "','" . $totalNeto . "','" . $producto->codigo . "','" . $producto->descuento . "','" . $idVenta . "');");
        }
      }


      function restarStockProductos($productos) {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $productos = json_decode($productos);

        foreach ($productos as $producto) {
            $con->query("CALL restarStockProductos('" . $producto->codigo . "','". $producto->cantidad . "');");
        }
    }

      function procesarVenta($productos, $idCliente, $totalNeto, $totalBruto) {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $facturaVenta = $this->getFactura();
        $idVenta = $this->registrarVenta($idCliente, $totalNeto, $totalBruto, $facturaVenta);
        if ($idCliente!= 0) {
            //return
         
            $this->registrarVentaPorCobrar($idCliente, $idVenta, $totalNeto);
        } 
        $this->restarStockProductos($productos);
        return   $this->registrarProductosLacteos($productos,$totalNeto, $idVenta);
        
    }


/*************************************************************/
   function nombreCompleto($idCliente){
      $con=$this->conexion->crearConexion()->set_charset("UTF8");
      $con=$this->conexion->crearConexion();
      //$con->set_charset("UTF8");
      $sqlQuery=$con->query("SELECT `documentoidentidadpersona`, `nombrepersona`, `apellido1persona`, `apellido2persona`, `telefonopersona`, `direccionpersona`, `correopersona` FROM `tbpersona` WHERE idpersona='".$idCliente."';");
        $array=array();
        while($row=$sqlQuery->fetch_assoc()){
            array_push($array,$row);
        }

        return $array;
    }
    
    function idfactura(){
      $con=$this->conexion->crearConexion();
      $con->set_charset("UTF8");
      $sqlQuery=$con->query("SELECT `ultimafactura` FROM `tbfacturero`;");
      $array;
        while($row=$sqlQuery->fetch_assoc()){
            $array=$row['ultimafactura'];
        }

        return $array;
    }


  }
  /*$d= new dataVentaDistribuidor();
  $p=[{"codigo":"445","nombre":"granos de leche","precio":"55","cantidad":1}];
  $r=$d->registrarProductosLacteos($p,10);
  
  print_r($r);*/
 ?>

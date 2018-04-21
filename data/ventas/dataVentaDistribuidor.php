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

      public function registrarProductosLacteos($productos,$idVenta){
          $con = $this->conexion->crearConexion();
          $con->set_charset("UTF8");
          $productos = json_decode($productos);
            foreach ($productos as $producto) {
              //echo($producto->precio);
              $total = $producto->precio * $producto->cantidad;
              $con->query("CALL registrardetalleventadistribuidor('$producto->precio','$producto->cantidad','$total','$producto->codigo','0','$idVenta')");
              return $productos;

/*cantidad: 1
​​
codigo: "4390"
​​
nombre: "Queso Mozarrella"
​​
precio: "4000"
              
              INSERT INTO tbdetalleventa(preciounitariodetalleventa,cantidaddetalleventa,subtotaldetalleventa, codigoproductoslacteos,descuento,idventa) VALUES (precio,cantidad,total,codigo,descuento,idventa);
               */
          }
      }

      function procesarVenta($productos, $idCliente, $totalNeto, $totalBruto) {
        $con = $this->conexion->crearConexion();
        $con->set_charset("UTF8");
        $facturaVenta = $this->getFactura();
        $idVenta = $this->registrarVenta($idCliente, $totalNeto, $totalBruto, $facturaVenta);
        if ($idVenta!= 0) {
            //return
             $this->registrarVentaPorCobrar($idCliente, $idVenta, $totalNeto);
        } 
          return   $this->registrarProductosLacteos($productos, $idVenta);
          //return $productos;
        
        /*
        double double double varchar double int int 
         93
        INSERT INTO tbdetalleventa(preciounitariodetalleventa,cantidaddetalleventa,subtotaldetalleventa, codigoproductoslacteos,descuento,idventa) VALUES (precio,cantidad,total,codigo,descuento,idventa);
         
        INSERT INTO tbdetalleventa(preciounitariodetalleventa,cantidaddetalleventa,subtotaldetalleventa, codigoproductoslacteos,descuento,idventa) VALUES ('10','10','2000','6790','22','94');*/
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

<?php
  class dataVentaVeterinaria{

    private $conexion;

		function __construct(){
			require_once '../../data/conexion/conexion.php';
			$this->conexion = new conexion();
		}

    function searchProduct($code){
      $con = $this->conexion->crearConexion();
      $con->set_charset("utf8");
      $query = $con->query("CALL searchproductveterinario('$code')");
      return json_encode($query->fetch_assoc());
    }

  }
 ?>

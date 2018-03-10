<?php

	$searchTerm =$_POST['term'];
	$autocomplete_data = new Autocomplete_data();
	$autocomplete_data->buscarProductoLacteos($searchTerm);
	class Autocomplete_data{
		private $conexion;

		function __construct(){
			require_once '../../data/conexion/conexion.php';
			$this->conexion = new conexion();
		}

		function buscarProductoLacteos($searchTerm){
			$conn = $this->conexion->crearConexion();
			$conn->set_charset("utf8");
			$data = array();
			if($searchTerm != ""){
				$query = $conn->query(
					"SELECT codigoproductoslacteos,
					nombreproductolacteo, 
					preciounitarioproductolacteo,
					cantidadinventarioproductolacteo
					FROM tbproductoslacteos WHERE estadoproductoslacteos='activo' AND
					cantidadinventarioproductolacteo>0 AND nombreproductolacteo LiKE '%".$searchTerm."%' limit 3");
				while ($row = $query->fetch_assoc()) {
				    $data[] = $row;
				}
			}
			echo json_encode($data);
		}
	}


?>

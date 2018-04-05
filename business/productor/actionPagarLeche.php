<?php
	include 'businessPagarLeche.php';
	$businessPagarLeche = new businessPagarLeche();  
	$action=$_POST['action'];
	
	if ($action=="consultarMontoLeche") {
	    echo $businessPagarLeche->pagarLecheMostrar();
	}else if($action=="pagarMontoLeche"){
		$id = $_POST['idProductor'];
		$tipo=$_POST['tipo'];
		$cantidadlitroscompramateriaprima=$_POST['litros'];
		
		echo $businessPagarLeche->pagarLitrosTotales($id,$tipo,$cantidadlitroscompramateriaprima);

	}
?>
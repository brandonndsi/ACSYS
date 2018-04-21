<?php 

	include 'businessAhorro.php';
	$businessAhorro = new businessAhorro();  
	$action=$_POST['action'];
	if ($action=="consultarMontoAhorro") {
	    echo $businessAhorro->ahorroMontoMostrar();
	}else if($action=="modificarMontoAhorro"){

		$id=$_POST['id'] ;
      	$ahorro=$_POST['ahorro'] ;
      	$tipo=$_POST['tipo'];
      	if(is_numeric($ahorro)&& $ahorro>-1){
      		echo $businessAhorro->ahorroMontoModificar($id,$ahorro,$tipo);

      	}else{
                  
      		echo "false";
      	}

	}else if($action=="consultarMontoAhorroTotal"){

		echo $businessAhorro->ahorroMontoTotalMostrar();

	}else if($action=="pagarAhorro"){
		$idProductor = $_POST['idProductor'];
		echo $businessAhorro->pagarAhorro($idProductor);

	}


?>
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
      	if(!empty($ahorro)&&is_numeric($ahorro)&& $ahorro>=0){
      		echo $businessAhorro->ahorroMontoModificar($id,$ahorro,$tipo);

      	}else{
                  
      		echo "false";
      	}

	}

?>
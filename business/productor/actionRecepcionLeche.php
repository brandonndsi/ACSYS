<?php 

	include 'businessRecepcionLeche.php';
	$businessRecepcionLeche = new businessRecepcionLeche();
  $action=$_POST['action'];
	if($action=="registrarLeche") {
		    $cliente=$_POST['cliente'] ;
      	$fecha=$_POST['fecha'] ;
      	$turno=$_POST['turno'];
      	$peso=$_POST['peso'];
              
      	if(empty($peso)){
            echo("false");
        }else{
        	echo $businessRecepcionLeche->registrarLeche($cliente,$fecha,$turno,$peso);
        }
        
    }if($action=='consultarRecepcion'){
      $fecha=$_POST['fecha'];
      echo $businessRecepcionLeche->consultarRecepcion($fecha);
    }



?>
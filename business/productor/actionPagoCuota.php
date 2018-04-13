<?php 

	include 'businessPagoCuota.php';
	$businessPagoCuota = new businessPagoCuota();
  $action=$_POST['action'];
	if($action=="registrarPagoCuota") {
		 $idPrestamoCobrar= $_POST['idprestamoporcobrar'];
         $cuota= $_POST['cuota'];
        
         
        echo $businessPagoCuota->registrarPagoCuota($idPrestamoCobrar,$cuota);
        
        
    }else if($action=='consultarCuota'){

        $idProductor= $_POST['id'];
        echo $businessPagoCuota->obtenerPrestamosActivosProductor($idProductor);
    }



?>

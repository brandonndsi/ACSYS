<?php 

	include 'businessPagoCuota.php';
	$businessPagoCuota = new businessPagoCuota();
  $action=$_POST['action'];
	if($action=="registrarPagoCuota") {
		 $idProductor= $_POST['idProductor'];
         $cuota= $_POST['cuota'];
         $saldoAnterior= $_POST['saldoAnterior'];
         
        echo $businessPagoCuota->registrarPagoCuota($idProductor,$cuota,$saldoAnterior);
        
        
    }else if($action=='consultarCuota'){

        $idProductor= $_POST['id'];
        echo $businessPagoCuota->obtenerPrestamosActivosProductor($idProductor);
    }



?>

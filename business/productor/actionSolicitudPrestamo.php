<?php 

	include 'businessSolicitudPrestamo.php';
	$businessSolicitudPrestamo = new businessSolicitudPrestamo();
  $action=$_POST['action'];
	if($action=='consultarSolicitud'){
        echo $businessSolicitudPrestamo->consultarSolicitud();
    }else if($action=='aprobarsolicitud'){
    	$idSolicitud=$_POST['idsolicitud'];
    	echo $businessSolicitudPrestamo->aprobarSolicitud($idSolicitud);

    }else if($action=='rechazarsolicitud'){
    	$idSolicitud=$_POST['idsolicitud'];
    	echo $businessSolicitudPrestamo->rechazarSolicitud($idSolicitud);

    }



?>
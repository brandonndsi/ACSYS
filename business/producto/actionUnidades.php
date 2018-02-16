<?php	
	include 'businessUnidades.php';
	$businessUnidades = new businessUnidades();  
	$action=$_POST['action'];
	if ($action=="consultarunidades") {
	    echo $businessUnidades->unidadesMostrar();
	}
	if ($action=="consultarvias") {
	    echo $businessUnidades->viasMostrar();
	}
	if ($action=="consultarfunciones") {
	    echo $businessUnidades->funcionesMostrar();
	}
?>
<?php	
	include 'businessUnidades.php';
	$businessUnidades = new businessUnidades();  
	$action=$_POST['action'];
	if ($action=="consultarunidades") {
	    echo $businessUnidades->unidadesMostrar();
	}
?>
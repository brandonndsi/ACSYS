<?php 
$accion=$_POST['action'];

if($accion=='ventabuscar'){
	include_once 'reportesBusiness.php';
	$business = new reportesBusiness();
	$fechainicial=$_POST['fechai'];
	$fechafinal=$_POST['fechaf'];

 	echo  $business->ventabuscar($fechainicial,$fechafinal);
}


 ?>
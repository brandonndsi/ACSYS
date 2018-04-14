<?php 
$accion=$_POST['action'];

if($accion=='ventabuscar'){

	include_once 'reportesBusiness.php';

	$business = new reportesBusiness();
	$fechainicial=$_POST['fechai'];
	$fechafinal=$_POST['fechaf'];

 	echo  $business->ventabuscar($fechainicial,$fechafinal);
}

if($accion=="buscarDetalleVeterinario"){

	include_once 'reportesBusiness.php';

	$business = new reportesBusiness();
	$idventa=$_POST['venta'];
	echo $business->buscarDetalleVeterinario($idventa);
}

if($accion=="ventaNombre"){

	include_once 'reportesBusiness.php';

	$business = new reportesBusiness();
	$id=$_POST['id'];
	echo $business->ventaNombre($id);
}

if($accion=="buscarDetalleDistribidor"){

	include_once 'reportesBusiness.php';

	$business = new reportesBusiness();
	$id=$_POST['id'];
	echo $business->buscarDetalleDistribidor($id);

}

if($accion=="ventaPrestamos"){

	include_once 'reportesBusiness.php';

	$business = new reportesBusiness();
	$fechainicial=$_POST['fechai'];
	$fechafinal=$_POST['fechaf'];

 	echo  $business->ventaPrestamos($fechainicial,$fechafinal);
}
/*buscarDetalleDistribidor*/


 ?>
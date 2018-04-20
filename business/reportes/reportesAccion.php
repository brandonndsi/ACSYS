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

if($accion=="buscarDetalleVentanilla"){

	include_once 'reportesBusiness.php';

	$business = new reportesBusiness();
	$idventa=$_POST['venta'];
	echo $business->buscarDetalleVentanilla($idventa);
}

if($accion=="ventaNombre"){

	include_once 'reportesBusiness.php';

	$business = new reportesBusiness();
	$id=$_POST['id'];
	echo $business->ventaNombre($id);
}

if($accion=="buscarDetalleDistribuidor"){

	include_once 'reportesBusiness.php';

	$business = new reportesBusiness();
	$idventa=$_POST['venta'];
	echo $business->buscarDetalleDistribuidor($idventa);

}

if($accion=="ventaPrestamos"){

	include_once 'reportesBusiness.php';

	$business = new reportesBusiness();
	$fechainicial=$_POST['fechai'];
	$fechafinal=$_POST['fechaf'];

 	echo  $business->ventaPrestamos($fechainicial,$fechafinal);
}

if($accion == "ventaPagos"){

	include_once 'reportesBusiness.php';

	$business = new reportesBusiness();
	$fechainicial=$_POST['fechai'];
	$fechafinal=$_POST['fechaf'];

 	echo  $business->ventaPagos($fechainicial,$fechafinal);
}

if($accion == "ventabuscarDistribuidor"){
	include_once 'reportesBusiness.php';

	$business = new reportesBusiness();
	$fechainicial=$_POST['fechai'];
	$fechafinal=$_POST['fechaf'];

 	echo  $business->ventabuscarDistribuidor($fechainicial,$fechafinal);

}

if($accion == "ventabuscarVentanilla"){
	include_once 'reportesBusiness.php';

	$business = new reportesBusiness();
	$fechainicial=$_POST['fechai'];
	$fechafinal=$_POST['fechaf'];

 	echo  $business->ventabuscarVentanilla($fechainicial,$fechafinal);

}
/*ventabuscarVentanilla*/


 ?>
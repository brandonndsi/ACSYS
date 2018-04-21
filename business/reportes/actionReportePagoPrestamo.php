<?php
	$accion=$_POST['action'];
	include_once 'businessReportePagoPrestamo.php';

	$businessReportePagoPrestamo = new businessReportePagoPrestamo();
	if($accion=='verPagosPrestamos'){

		$fechaInicio=$_POST['fechainicio'];
		$fechaFinal=$_POST['fechafinal'];
		$idPrestamo=$_POST['idPrestamo'];

	 	echo  $businessReportePagoPrestamo->verPagosPrestamos($fechaInicio,$fechaFinal,$idPrestamo);
	}else if($accion=='obtenerPrestamosSocio'){

		$id=$_POST['id'];
		echo $businessReportePagoPrestamo->obtenerPrestamosSocio($id);
	}

?>
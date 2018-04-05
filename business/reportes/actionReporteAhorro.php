<?php
	$accion=$_POST['action'];

	if($accion=='verReporteAhorro'){

		include_once 'businessReporteAhorro.php';

		$businessReporteAhorro = new businessReporteAhorro();
		$fechaInicio=$_POST['fechainicio'];
		$fechaFinal=$_POST['fechafinal'];

	 	echo  $businessReporteAhorro->verReporteAhorro($fechaInicio,$fechaFinal);
	}

?>
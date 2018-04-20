<?php
	$accion=$_POST['action'];

	if($accion=='verReportePagoLeche'){

		include_once 'businessReportePagoLeche.php';

		$businessReportePagoLeche = new businessReportePagoLeche();
		$fechaInicio=$_POST['fechainicio'];
		$fechaFinal=$_POST['fechafinal'];

	 	echo  $businessReportePagoLeche->verReportePagoLeche($fechaInicio,$fechaFinal);
	}

?>
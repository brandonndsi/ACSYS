<?php

class businessReporteProcesos{

	private $dataReportes;

	function businessReporteProcesos(){
		include_once '../../data/reportes/dataReporteProcesos.php';
		$this->dataReportes= new dataReporteProcesos();
	}

	public function ventaProcesos($fechainicial,$fechafinal){
		return $this->dataReportes->ventaProcesos($fechainicial,$fechafinal);
	}
	
}

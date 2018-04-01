<?php 
class reportesBusiness{

	private $dataReportes;

	public function reportesBusiness(){
		include_once '../../data/reportes/dataReportes.php';
		$this->dataReportes= new dataReportes();
	}

	public function ventabuscar($fechainicial,$fechafinal){
			return $this->dataReportes->ventabuscar($fechainicial,$fechafinal);
	}
}

 ?>
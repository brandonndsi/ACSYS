<?php 
class reportesBusiness{

	private $dataReportes;

	function reportesBusiness(){
		include_once '../../data/reportes/dataReportes.php';
		$this->dataReportes= new dataReportes();
	}

	public function ventabuscar($fechainicial,$fechafinal){
			return $this->dataReportes->ventabuscar($fechainicial,$fechafinal);
	}

	public function buscarDetalleVeterinario($idventa){
			return $this->dataReportes->buscarDetalleVeterinario($idventa);
	}

	public function ventaNombre($id){
			return $this->dataReportes->ventaNombre($id);
	}

	public function buscarDetalleDistribidor($id){
		return $this->dataReportes->buscarDetalleDistribidor($id);
	} 

	public function ventaPrestamos($fechainicial,$fechafinal){
		return $this->dataReportes->ventaPrestamos($fechainicial,$fechafinal);
	}
	
	public function ventaPagos($fechainicial,$fechafinal){
		return $this->dataReportes->ventaPagos($fechainicial,$fechafinal);
	}
}
/*$datoo= new reportesBusiness();
$d=$datoo->buscarDetalleDistribidor('35');
print_r($d);*/

 ?>
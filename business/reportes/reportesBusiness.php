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
}
/*$datoo= new reportesBusiness();
$d=$datoo->buscarDetalleVeterinario(5);
print_r($d);*/

 ?>
<?php
	class businessReportePagoLeche{

		private $dataReportePagoLeche;

		function businessReportePagoLeche(){
			include_once '../../data/reportes/dataReportePagoLeche.php';
			$this->dataReportePagoLeche= new dataReportePagoLeche();
		}

		public function verReportePagoLeche($fechaInicio,$fechaFinal){
				return $this->dataReportePagoLeche->verReportePagoLeche($fechaInicio,$fechaFinal);
		}

	}
?>

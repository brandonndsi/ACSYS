<?php
	class businessReporteAhorro{

		private $dataReporteAhorro;

		function businessReporteAhorro(){
			include_once '../../data/reportes/dataReporteAhorro.php';
			$this->dataReporteAhorro= new dataReporteAhorro();
		}

		public function verReporteAhorro($fechaInicio,$fechaFinal){
				return $this->dataReporteAhorro->verReporteAhorro($fechaInicio,$fechaFinal);
		}

	}
?>
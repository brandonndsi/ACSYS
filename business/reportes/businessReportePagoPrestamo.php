<?php
	class businessReportePagoPrestamo{

		private $dataReportePagoPrestamo;

		function businessReportePagoPrestamo(){
			include_once '../../data/reportes/dataReportePagoPrestamo.php';
			$this->dataReportePagoPrestamo= new dataReportePagoPrestamo();
		}

		public function verPagosPrestamos($fechaInicio,$fechaFinal,$idPrestamo){
				return $this->dataReportePagoPrestamo->verPagosPrestamos($fechaInicio,$fechaFinal,$idPrestamo);
		}

		public function  obtenerPrestamosSocio($id){

			return $this->dataReportePagoPrestamo->obtenerPrestamosSocio($id);
		}

	}
?>
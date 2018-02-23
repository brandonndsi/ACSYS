<?php 
	class businessRecepcionLeche {
		private $dataRecepcionLeche;

	    public function businessRecepcionLeche() {

	        include_once '../../data/productor/dataRecepcionLeche.php';
	        $this->dataRecepcionLeche= new dataRecepcionLeche();
	    }

	     public function registrarLeche($cliente,$fecha,$turno,$peso){

	    	return $this->dataRecepcionLeche->registrarLeche($cliente,$fecha,$turno,$peso);
	    }

	    public function consultarRecepcion($fecha){

	    	return $this->dataRecepcionLeche->consultarRecepcion($fecha);
	    }
	}
?>
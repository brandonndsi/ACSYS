<?php 

	private $dataRecepcionLeche;

    public function businessRecepcionLeche() {

        include_once '../../data/productor/dataRecepcionLeche.php';
        $this->dataRecepcionLeche= new dataRecepcionLeche();
    }


?>
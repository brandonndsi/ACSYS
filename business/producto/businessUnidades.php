<?php

class businessUnidades{

    private $dataUnidades;

    public function businessUnidades() {

        include_once '../../data/producto/dataUnidades.php';
        $this->dataUnidades = new dataUnidades();
    }

    public function unidadesMostrar() {
        return $this->dataUnidades->unidadesMostrar();
    }

   
}

?>
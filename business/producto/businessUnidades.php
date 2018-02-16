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

     public function funcionesMostrar() {
        return $this->dataUnidades->funcionesMostrar();
    }

     public function viasMostrar() {
        return $this->dataUnidades->viasMostrar();
    }
   
}

?>
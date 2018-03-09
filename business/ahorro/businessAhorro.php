<?php

class businessAhorro {

    private $dataAhorro;

    public function businessAhorro() {

        include_once '../../data/ahorro/dataAhorro.php';
        $this->dataAhorro = new dataAhorro();
    }

    function ahorroMontoMostrar(){

        return $this->dataAhorro->ahorroMontoMostrar();
    }

    function ahorroMontoModificar($id,$ahorro,$tipo){

        return $this->dataAhorro->ahorroMontoModificar($id,$ahorro,$tipo);
    }
     
}

?>
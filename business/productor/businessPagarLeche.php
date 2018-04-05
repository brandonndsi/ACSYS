<?php

class businessPagarLeche {

    private $dataPagarLeche;

    public function businessPagarLeche() {

        include_once '../../data/productor/dataPagarLeche.php';
        $this->dataPagarLeche = new dataPagarLeche();
    }

    function pagarLecheMostrar(){

        return $this->dataPagarLeche->pagarLecheMostrar();
    }

    function pagarLitrosTotales($id,$tipo,$cantidadlitroscompramateriaprima){
    	return $this->dataPagarLeche->pagarLitrosTotales($id,$tipo,$cantidadlitroscompramateriaprima);
    }

 }
 
 ?>   
<?php

  class businessPagoCuota{

    private $dataPagoCuota;
    function businessPagoCuota(){
      require_once '../../data/productor/dataPagoCuota.php';
      $this->dataPagoCuota = new dataPagoCuota();
    }

    function registrarPagoCuota($idProductor,$cuota,$saldoAnterior){
      return $this->dataPagoCuota->registrarPagoCuota($idProductor,$cuota,$saldoAnterior);
    }

    function obtenerPrestamosActivosProductor($id){

      return $this->dataPagoCuota->obtenerPrestamosActivosProductor($id);
    }

  }

 ?>

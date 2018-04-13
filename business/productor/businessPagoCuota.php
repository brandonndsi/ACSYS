<?php

  class businessPagoCuota{

    private $dataPagoCuota;
    function businessPagoCuota(){
      require_once '../../data/productor/dataPagoCuota.php';
      $this->dataPagoCuota = new dataPagoCuota();
    }

    function registrarPagoCuota($idPrestamoCobrar,$cuota){
      return $this->dataPagoCuota->registrarPagoCuota($idPrestamoCobrar,$cuota);
    }

    function obtenerPrestamosActivosProductor($id){

      return $this->dataPagoCuota->obtenerPrestamosActivosProductor($id);
    }

  }

 ?>

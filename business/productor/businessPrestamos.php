<?php

  class businessPrestamos{

    private $dataPrestamos;
    function businessPrestamos(){
      require_once '../../data/productor/dataPrestamos.php';
      $this->dataPrestamos = new dataPrestamos();
    }

    function registrarSolicitudPrestamo($idPersona,$interes,$montoPrestamo,$plazo,$modoPlazo){
      return $this->dataPrestamos->registrarSolicitudPrestamo($idPersona,$interes,$montoPrestamo,$plazo,$modoPlazo);
    }

  }

 ?>

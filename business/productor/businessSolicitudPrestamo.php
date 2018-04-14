<?php

  class businessSolicitudPrestamo{

    private $dataSolicitudPrestamo;
    function businessSolicitudPrestamo(){
      require_once '../../data/productor/dataSolicitudPrestamo.php';
      $this->dataSolicitudPrestamo = new dataSolicitudPrestamo();
    }

    

    function consultarSolicitud(){

      return $this->dataSolicitudPrestamo->consultarSolicitud();
    }

    function aprobarSolicitud($idSolicitud){

      return $this->dataSolicitudPrestamo->aprobarSolicitud($idSolicitud);
    }

    function rechazarSolicitud($idSolicitud){

      return $this->dataSolicitudPrestamo->rechazarSolicitud($idSolicitud);
    }

  }

 ?>
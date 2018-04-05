<?php

  $action = $_POST['action'];
  require 'businessPrestamos.php';
  $businessPrestamos =  new businessPrestamos();
  if($action == "registrarSolicitudPrestamo"){
    $idPersona = $_POST['idProductor'];
    $interes = $_POST['interes'];
    $montoPrestamo = $_POST['montoPrestamo'];
    $plazo = $_POST['plazo'];
    $modoPlazo = $_POST['modoPlazo'];
    echo $businessPrestamos->registrarSolicitudPrestamo($idPersona,$interes,$montoPrestamo,$plazo,$modoPlazo);
    //echo "true";
  }

 ?>

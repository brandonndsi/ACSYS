<?php
  require 'businessVentaVeterinaria.php';
  $action = $_POST['action'];
  $businessVentaVeterinaria = new businessVentaVeterinaria();
  if($action == "searchProduct"){
    $code = $_POST['code'];
    if(!empty($code)){
      echo $businessVentaVeterinaria->searchProduct($code);
    }else{
      echo "false";
    }
  }
  if($action == "procesarVenta"){
    $productos = $_POST['productos'];;
    $idCliente = $_POST['idCliente'];
    $totalNeto = $_POST['totalNeto'];
    $totalBruto = $_POST['totalBruto'];
    if(!empty($idCliente) && !empty($total)){
      echo $businessVentaVeterinaria->procesarVenta($productos,$idCliente,$totalNeto,$totalBruto);
    }else{
      echo "false";
    }
  }

 ?>

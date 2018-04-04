<?php

require 'businessVentaDistribuidor.php';

$action = $_POST['action'];
$businessVentaDist = new businessVentaDistribuidor();

if ($action == "searchDairyProduct") {
    $code = $_POST['code'];
    if (!empty($code)) {
        echo $businessVentaDist->searchProduct($code);
    } else {
        echo "false";
    }
}
if ($action == "procesarVenta") {
    $productos = $_POST['productos'];
    $idCliente = $_POST['idCliente'];
    $totalNeto = $_POST['totalNeto'];
    $totalBruto = $_POST['totalBruto'];
    if (!empty($totalNeto) && !empty($totalBruto)) {
        echo $businessVentaDist->procesarVenta($productos, $idCliente, $totalNeto, $totalBruto);
    } else {
        echo "false";
    }
}

if($action == "nombrecompleto"){
    $idCliente = $_POST['idClient'];

$r = $businessVentaDist->nombreCompleto($idCliente);
$d;
  foreach( $r as $row) {
   $d=$row['nombrepersona']." ".$row['apellido1persona']." ".$row['apellido2persona'];
  }
  echo $d;
}
if($action == "idfactura"){
$idfac = $businessVentaDist->idfactura();
echo $idfac;
}
?>
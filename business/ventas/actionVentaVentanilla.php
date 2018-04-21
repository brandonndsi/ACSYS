<?php

require 'businessVentaVentanilla.php';

$action = $_POST['action'];
$businessVentaVentanilla = new businessVentaVentanilla();

if ($action == "searchDairyProduct") {
    $code = $_POST['code'];
    if (!empty($code)) {
        echo $businessVentaVentanilla->searchProduct($code);
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
        echo $businessVentaVentanilla->procesarVenta($productos, $idCliente, $totalNeto, $totalBruto);
    } else {
        echo "false";
    }
}

if ($action == "idfactura") {
    $idfac = $businessVentaVentanilla->idfactura();
    echo $idfac;
}
?>
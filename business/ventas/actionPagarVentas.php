<?php

    $action = $_POST['action'];
    require("businessPagarVentas.php");
    $businessPagarVentas = new businessPagarVentas();
    if($action == "consultarVentasPorCobrar"){
        $idCliente = $_POST['idCliente'];
        echo $businessPagarVentas->consultarVentasPorCobrar($idCliente);
    }

    if($action == "pagarVenta"){
        $idVentaPorCobrar = $_POST['idVentaPorCobrar'];
        echo $businessPagarVentas->pagarVenta($idVentaPorCobrar);
    }

    
?>
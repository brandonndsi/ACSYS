<?php

include './businessProceso.php';

$businessProceso = new businessProceso();

$action = $_POST['action'];

if ($action == "consultarprocesos") {

    echo $businessProceso->procesosMostrar();
} else if ($action == "registrarproceso") {

    $nombre = htmlentities($_POST['nombre']);
    $cantidad = htmlentities($_POST['cantidad']);
    $porcentaje = htmlentities($_POST['porcentaje']);
    $entera = htmlentities($_POST['entera']);
    $descremada = htmlentities($_POST['descremada']);
    $cuajo = htmlentities($_POST['cuajo']);
    $cloruro = htmlentities($_POST['cloruro']);
    $sal = htmlentities($_POST['sal']);
    $cultivo = htmlentities($_POST['cultivo']);
    $estabilizador = htmlentities($_POST['estabilizador']);
    $colorante = htmlentities($_POST['colorante']);
    $crema1 = htmlentities($_POST['crema1']);
    $leche1 = htmlentities($_POST['leche1']);
    $crema2 = htmlentities($_POST['crema2']);
    $leche2 = htmlentities($_POST['leche2']);

    if (empty($nombre) || empty($cantidad)) {

        echo("false");
    } else {
        echo $businessProceso->procesoRegistrar($nombre, $cantidad, $porcentaje, $entera, $descremada, $cuajo, $cloruro, $sal, $cultivo, $estabilizador, $colorante, $crema1, $leche1, $crema2, $leche2);
    }
} else if ($action == "consultarProducto") {
    echo $businessProceso->consultarProducto();
} else if ($action == "eliminarproceso") {

    $cantidad = $_POST['cantidad'];
    $nombre = $_POST['nombre'];
    $id = $_POST['id'];
    echo $businessProceso->ProcesoEliminar($cantidad, $nombre, $id);
} else if ($action == "buscarfecha") {

    $busquedafecha = $_POST['fechab'];
    echo $businessProceso->buscarFecha($busquedafecha);
}
?>

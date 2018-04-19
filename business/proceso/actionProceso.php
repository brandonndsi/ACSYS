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

    if (empty($nombre) || empty($cantidad) || empty($porcentaje) || empty($entera) ||
            empty($descremada) || empty($cuajo) || empty($cloruro) || empty($sal) || empty($cultivo) ||
            empty($estabilizador) || empty($colorante)) {

        echo("false");
    } else {
        echo $businessProceso->procesoRegistrar($nombre, $cantidad, $porcentaje, $entera, $descremada, $cuajo, $cloruro, $sal, $cultivo, $estabilizador, $colorante, $crema1, $leche1, $crema2, $leche2);
    }
} else if ($action == "modificarproceso") {

    $nombre = htmlentities($_POST['nombre']);
    $nuevo = htmlentities($_POST['cantidadNueva']);
    $viejo = htmlentities($_POST['cantidadVieja']);
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
    $hora = htmlentities($_POST['hora']);
    $fecha = htmlentities($_POST['fecha']);
    $id = htmlentities($_POST['id']);

    if (empty($nombre) || empty($nuevo) || empty($porcentaje) || empty($entera) ||
            empty($descremada) || empty($cuajo) || empty($cloruro) || empty($sal) || empty($cultivo) ||
            empty($estabilizador) || empty($colorante) || empty($hora) || empty($fecha) || empty($id)) {

        echo("false");
    } else {
        echo $businessProceso->procesoModificar($nombre, $nuevo, $viejo, $porcentaje, $entera, $descremada, $cuajo, $cloruro, $sal, $cultivo, $estabilizador, $colorante, $crema1, $leche1, $crema2, $leche2, $hora, $fecha, $id);
    }
} else if ($action == "consultarProducto") {
    echo $businessProceso->consultarProducto();
} else if ($action == "eliminarproceso") {

    $cantidad = $_POST['cantidad'];
    $nombre = $_POST['nombre'];
    $id = $_POST['id'];
    echo $businessProceso->ProcesoEliminar($cantidad, $nombre, $id);
}
?>

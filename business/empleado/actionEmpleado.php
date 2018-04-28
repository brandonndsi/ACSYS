<?php

include './businessEmpleado.php';

$businessEmpleado = new businessEmpleado();

$action = $_POST['action'];

if ($action == "consultarempleados") {
    echo $businessEmpleado->empleadoMostrar();
} else if ($action == "registrarempleado") {

    $cedula = htmlentities(strip_tags($_POST['cedula']));
    $nombre = htmlentities(strip_tags($_POST['nombre']));
    $apellido1 = htmlentities(strip_tags($_POST['apellido1']));
    $apellido2 = htmlentities(strip_tags($_POST['apellido2']));
    $telefono = htmlentities(strip_tags($_POST['telefono']));
    $direccion = htmlentities(strip_tags($_POST['direccion']));
    $correo = htmlentities(strip_tags($_POST['correo']));
    $id = htmlentities(strip_tags($_POST['id']));
    $clave = htmlentities(strip_tags($_POST['clave']));
    $tipo = htmlentities(strip_tags($_POST['tipo']));
    $manipulacionalimentos = htmlentities($_POST['manipulacionalimentos']);
    $identidad = htmlentities($_POST['identidad']);

    if (empty($cedula) || empty($nombre) || empty($apellido1) || empty($direccion) || empty($clave) || empty($tipo)) {
        echo("false");
    } else {
        if (empty($correo)) {
            $correo = "N/A";
        }
        if (empty($apellido2)) {
            $apellido2 = "N/A";
        }
        if (empty($telefono)) {
            $telefono = "N/A";
        }if ( is_numeric($cedula) || !is_numeric($nombre) ) {
            echo $businessEmpleado->empleadoRegistrar($cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $correo, $clave, $tipo, $manipulacionalimentos, $identidad);
        }
    }
} else if ($action == "modificarempleado") {

    $cedula = htmlentities(strip_tags($_POST['cedula']));
    $nombre = htmlentities(strip_tags($_POST['nombre']));
    $apellido1 = htmlentities(strip_tags($_POST['apellido1']));
    $apellido2 = htmlentities(strip_tags($_POST['apellido2']));
    $telefono = htmlentities(strip_tags($_POST['telefono']));
    $direccion = htmlentities(strip_tags($_POST['direccion']));
    $correo = htmlentities(strip_tags($_POST['correo']));
    $id = htmlentities(strip_tags($_POST['id']));
    $clave = htmlentities(strip_tags($_POST['clave']));
    $tipo = htmlentities(strip_tags($_POST['tipo']));

    if (empty($cedula) || empty($nombre) || empty($apellido1) || empty($direccion) || empty($id)) {
        echo("false");
    } else {
        if (empty($correo)) {
            $correo = "N/A";
        }
        if (empty($apellido2)) {
            $apellido2 = "N/A";
        }
        if (empty($telefono)) {
            $telefono = "N/A";
        }
        if (!is_numeric($nombre) && is_numeric($cedula) && strlen($cedula)==9) {
            echo $businessEmpleado->empleadoModificar($cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $correo, $id, $clave, $tipo);
        }
        
    }
} else if ($action == "eliminarempleado") {

    $id = $_POST['id'];
    echo $businessEmpleado->empleadoEliminar($id);
}
?>
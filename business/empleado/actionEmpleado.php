<?php

include './businessEmpleado.php';

$businessEmpleado = new businessEmpleado();

$action = $_POST['action'];

if ($action == "consultarempleados") {
    echo $businessEmpleado->empleadoMostrar();
} else if ($action == "registrarempleado") {

    $cedula = htmlentities($_POST['cedula']);
    $nombre = htmlentities($_POST['nombre']);
    $apellido1 = htmlentities($_POST['apellido1']);
    $apellido2 = htmlentities($_POST['apellido2']);
    $telefono = htmlentities($_POST['telefono']);
    $direccion = htmlentities($_POST['direccion']);
    $correo = htmlentities($_POST['correo']);
    $clave = htmlentities($_POST['clave']);
    $tipo = htmlentities($_POST['tipo']);

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
        }if (!is_numeric($nombre)) {
            echo $businessEmpleado->empleadoRegistrar($cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $correo, $clave, $tipo);
        }
    }
} else if ($action == "modificarempleado") {

    $cedula = htmlentities($_POST['cedula']);
    $nombre = htmlentities($_POST['nombre']);
    $apellido1 = htmlentities($_POST['apellido1']);
    $apellido2 = htmlentities($_POST['apellido2']);
    $telefono = htmlentities($_POST['telefono']);
    $direccion = htmlentities($_POST['direccion']);
    $correo = htmlentities($_POST['correo']);
    $id = htmlentities($_POST['id']);
    $clave = htmlentities($_POST['clave']);
    $tipo = htmlentities($_POST['tipo']);

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
        if (!is_numeric($nombre)) {
            echo $businessEmpleado->empleadoModificar($cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $correo, $id, $clave, $tipo);
        }
    }
} else if ($action == "eliminarempleado") {

    $id = $_POST['id'];
    echo $businessEmpleado->empleadoEliminar($id);
}
?>
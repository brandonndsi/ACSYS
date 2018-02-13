<?php

class dataEmpleado {

    private $conexion;

    function dataEmpleado() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    // mostrar todo
    function empleadosMostrar() {

        $con = $this->conexion->crearConexion();
        $mostrarEmpleados = $con->query("CALL mostrarempleados()");
        $datos = array();
        while ($result = $mostrarEmpleados->fetch_assoc()) {
            array_push($datos, $result);
        }
        return json_encode($datos);
    }

    // registrar
    function empleadoRegistrar($cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $correo, $clave, $tipo) {

        $con = $this->conexion->crearConexion();
        /* registra la persona */
        $registrarEmpleado = $con->query("CALL insertarpersona('$cedula','$nombre','$apellido1','$apellido2','$telefono','$direccion','$correo')");

        $pass = password_hash($clave, PASSWORD_DEFAULT);
        if ($registrarEmpleado == 1) {
            $registrarEmpleado = $con->query("CALL insertarempleado('8','$pass',,'$tipo','activo')");
            return "true";
        } else {
            return "false";
        }
    }

    //modificar
    function empleadoModificar($id, $cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $correo) {

        $con = $this->conexion->crearConexion();
        $modificarEmpleado = $con->query("CALL modificarempleados('$cedula','$nombre','$apellido1','$apellido2','$telefono','$direccion','$correo','$id')");
        if ($modificarEmpleado == 1) {
            return "true";
        } else {
            return "false";
        }
    }

    //eliminar
    function empleadoEliminar($id) {

        $con = $this->conexion->crearConexion();
        $eliminarEmpleado = $con->query("CALL eliminarempleado('$id')");
        if ($eliminarEmpleado == 1) {
            return "true";
        } else {
            return "false";
        }
    }

}

?>

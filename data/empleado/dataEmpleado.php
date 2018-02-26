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
        $con->set_charset("utf8");
        /* registra la persona */
        $registrarEmpleado = $con->query("CALL registrarpersona('$cedula','$nombre','$apellido1','$apellido2','$telefono','$direccion','$correo')");
        if ($registrarEmpleado == 1) {
            $conen = $this->conexion->crearConexion();
            $conen->set_charset("utf8");
            $pass = password_hash($clave, PASSWORD_DEFAULT);
            $registrarEmpleado = $conen->query("CALL registrarempleado('$pass','$tipo')");
            return "true";
        } else {
            return "false";
        }
    }

    //modificar

    function empleadoModificar($cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $correo, $id, $clave, $tipo) {

        $con = $this->conexion->crearConexion();
        $con->set_charset("utf8");

        $modificarEmpleado = $con->query("CALL modificarempleadopersona('$cedula','$nombre','$apellido1','$apellido2','$telefono','$direccion','$correo','$id')");

        $conec = $this->conexion->crearConexion();
        $con->set_charset("utf8");

        $modificarContra = "call login2(?)";
        $consulta = $conec->prepare($modificarContra);
        $consulta->bind_param('s', $id);
        $consulta->execute();
        $consulta->bind_result($passwordQuery);
        $bandera = false;

        while ($consulta->fetch()) {
            if ($clave != $passwordQuery) {
                $bandera = true;
            } else {
                $bandera = false;
            }
        }
        if ($bandera) {

            $conn = $this->conexion->crearConexion();
            $conn->set_charset("utf8");

            $pass = password_hash($clave, PASSWORD_DEFAULT);
            $modificarEmpleado = $conn->query("CALL modificarempleados('$id','$pass','$tipo')");

            if ($modificarEmpleado == 1) {
                return "true";
            } else {
                return "false";
            }
        } else {
            $co = $this->conexion->crearConexion();
            $co->set_charset("utf8");
            $modificarEmpleado = $co->query("CALL modificarempleados('$id','$clave','$tipo')");

            if ($modificarEmpleado == 1) {
                return "true";
            } else {
                return "false";
            }
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

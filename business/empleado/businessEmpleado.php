<?php

class businessEmpleado {

    private $dataEmpleado;

    public function businessEmpleado() {

        include_once '../../data/empleado/dataEmpleado.php';
        $this->dataEmpleado = new dataEmpleado();
    }

    public function empleadoMostrar() {
        return $this->dataEmpleado->empleadosMostrar();
    }

    public function empleadoRegistrar($cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $correo, $clave, $tipo) {

        return $this->dataEmpleado->empleadoRegistrar($cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $correo, $clave, $tipo);
    }

    public function empleadoModificar($id, $cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $correo, $clave, $tipo) {

        return $this->dataEmpleado->empleadoModificar($id, $cedula, $nombre, $apellido1, $apellido2, $telefono, $direccion, $correo, $clave, $tipo);
    }

    public function empleadoEliminar($id) {

        return $this->dataEmpleado->empleadoEliminar($id);
    }

}

?>
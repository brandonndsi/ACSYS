<?php

class dataPerfil {

    private $conexion;

    function dataPerfil() {
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    function perfilModificar($id, $passwordfinal, $password) {

        $modificarContra = "call login2(?)";
        $con = $this->conexion->crearConexion();
        $consulta = $con->prepare($modificarContra);
        $consulta->bind_param('s', $id);
        $consulta->execute();
        $consulta->bind_result($passwordQuery);
        $bandera = false;

        while ($consulta->fetch()) {
            if (password_verify($password, $passwordQuery)) {

                $bandera = true;
            } else {

                $bandera = false;
            }
        }

        if ($bandera) {

            $conn = $this->conexion->crearConexion();

            $pass = password_hash($passwordfinal, PASSWORD_DEFAULT);
            $modificarContra = $conn->query("CALL modificarcontrasenia('$id','$pass')");

            if ($modificarContra == 1) {
                return "true";
            } else {
                return "false";
            }
        } else {
            return "false";
        }
    }

    //modificar
    /* function perfilModificar2($id, $passwordfinal) {

      $con = $this->conexion->crearConexion();

      //$pass = password_hash($passwordfinal, PASSWORD_DEFAULT);
      $modificarContra = $con->query("CALL modificarcontrasenia('$id','$passwordfinal')");

      if ($modificarContra == 1) {
      return "true";
      } else {
      return "false";
      }
      } */
}

?>

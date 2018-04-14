<?php

class loginData {

    //Variable
    private $conexion;

    function __construct() {
        //Import the file conexion.php
        require '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

    function login($user, $password) {
        $sql = "call login(?)";
        $conn = $this->conexion->crearConexion();
        $consulta = $conn->prepare($sql);
        $consulta->bind_param('s', $user);
        $consulta->execute();
        $consulta->bind_result($tipo,$passwordQuery, $id, $nombre, $apellido1, $apellido2,$telefono,$email);
        $bandera = false;
        while ($consulta->fetch()) {
            if (password_verify($password, $passwordQuery)) {
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['tipo'] =$tipo;
                $_SESSION['nombreUsuario'] = $nombre . " " . $apellido1;
                $_SESSION['id'] = $id;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['primerApellido'] = $apellido1;
                $_SESSION['segundoApellido'] = $apellido2;
                $_SESSION['telefono'] = $telefono;
                $_SESSION['email'] = $email;

                $bandera = true;
            } else {

                $bandera = false;
            }
        }
        if ($bandera) {
            session_start();
            $dato=$_SESSION['tipo'];
            if($dato!='Administrador'){
            header('Location: ../../view/principalEmpleado/principalEmpleadoView.php');  
            }else{
             header('Location: ../../view/productor/verProductorSocioView.php');   
            }
            
        } else {
            header('Location: ../../index.php');
        }
    }

}

?>

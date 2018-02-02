<?php

  class loginData{
    //Variable
    private $conexion;

    function __construct(){
      //Import the file conexion.php
      require '../../data/conexion/conexion.php';
      $this->conexion = new conexion();
    }

    function login($user, $password){
      	$sql = "call login(?)";
		$conn = $this->conexion->crearConexion();
		$consulta = $conn->prepare($sql);
		$consulta->bind_param('s',$user);
		$consulta->execute();
		$consulta->bind_result($passwordQuery);
		$bandera=false;
		while($consulta->fetch()){
			if(password_verify($password,$passwordQuery)) {
				session_start();
				$_SESSION['user'] = $user;
				
				$bandera=true;
			}else{
				
				$bandera=false;
			}
		}
		if($bandera){
			header('Location: ../../view/productor/verProductorSocioView.php');

		}else{
			header('Location: ../../index.php');

		}
    }
  }

 ?>

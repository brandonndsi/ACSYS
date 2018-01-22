<?php
	include 'businessProductor.php';
	$businessProductor = new businessProductor();  
	$action=$_POST['action'];
	if ($action=="consultarproductores") {
	    echo $businessProductor->productorMostrar();
	}else if($action=="modificarproductor"){
		$cedula=$_POST['cedula'] ;
      	$nombre=$_POST['nombre'] ;
      	$apellido1=$_POST['apellido1'];
      	$apellido2=$_POST['apellido2'] ;
      	$telefono=$_POST['telefono'] ;
      	$direccion=$_POST['direccion'] ;
      	$correo=$_POST['correo'] ;
      	$id=$_POST['id'];

      	if(empty($cedula)||empty($nombre)||empty($apellido1)||empty($apellido2)||empty($telefono)||empty($direccion)||empty($correo)){
      		echo("false");

      	}else{
      		
      		echo $businessProductor->productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
      	}



	}	

?>
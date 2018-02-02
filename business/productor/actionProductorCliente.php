<?php
	include 'businessProductorCliente.php';
	$businessProductorCliente = new businessProductorCliente();  
	$action=$_POST['action'];
	if ($action=="consultarproductores") {
	    echo $businessProductorCliente->productorMostrar();
	}else if($action=="modificarproductor"){
		$cedula=$_POST['cedula'] ;
      	$nombre=$_POST['nombre'] ;
      	$apellido1=$_POST['apellido1'];
      	$apellido2=$_POST['apellido2'] ;
      	$telefono=$_POST['telefono'] ;
      	$direccion=$_POST['direccion'] ;
      	$correo=$_POST['correo'] ;
      	$id=$_POST['id'];

      	if(empty($cedula)||empty($nombre)||empty($apellido1)||empty($apellido2)||empty($telefono)||empty($direccion)){
      		echo("false");

      	}else{
                  if(empty($correo)){

                        $correo="N/A";
                  }
      		echo $businessProductorCliente->productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
      	}

	}else if($action=="registrarproductores") {
		$cedula=$_POST['cedula'] ;
      	$nombre=$_POST['nombre'] ;
      	$apellido1=$_POST['apellido1'];
      	$apellido2=$_POST['apellido2'] ;
      	$telefono=$_POST['telefono'] ;
      	$direccion=$_POST['direccion'] ;
      	$correo=$_POST['correo'] ;

      	if(empty($cedula)||empty($nombre)||empty($apellido1)||empty($apellido2)||empty($telefono)||empty($direccion)){
      		echo("false");

      	}else{
                  if(empty($correo)){

                        $correo="N/A";
                  }
      		echo $businessProductorCliente->productorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
      	}


	}else if($action=="eliminarproductor"){

            $id=$_POST['id'];
            echo $businessProductorCliente->productorEliminar($id);

      }     	

?>
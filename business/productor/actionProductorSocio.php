<?php
	include 'businessProductorSocio.php';
	$businessProductorSocio = new businessProductorSocio();  
	$action=$_POST['action'];
	if ($action=="consultarproductores") {
	    echo $businessProductorSocio->productorMostrar();
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
      		
      		echo $businessProductorSocio->productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
      	}

	}else if($action=="registrarproductor") {
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
      		echo $businessProductorSocio->productorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
      	}


	}else if($action=="eliminarproductor"){

            $id=$_POST['id'];
            echo $businessProductorSocio->productorEliminar($id);

      }	

?>
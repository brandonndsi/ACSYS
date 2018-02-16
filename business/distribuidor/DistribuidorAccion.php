<?php 

	include_once 'DistribuidorBusiness.php';
	$DistribuidorBusiness = new DistribuidorBusiness();
	$action=$_POST['action'];
	if ($action=="consultarDistribuidor") {
	    echo json_encode($DistribuidorBusiness->DistribuidorMostrar());
	}else if($action=="modificarDistribuidor"){
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
      		
      		echo $DistribuidorBusiness->DistribuidorModificar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo,$id);
      	}

	}else if($action=="registrarDistribuidor") {
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
      		echo $DistribuidorBusiness->DistribuidorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
      	}


	}else if($action=="eliminarDistribuidor"){

            $id=$_POST['id'];
            echo $DistribuidorBusiness->DistribuidorEliminar($id);

      }	

 ?>
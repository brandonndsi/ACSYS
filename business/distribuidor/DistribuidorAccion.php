<?php 

	include_once 'DistribuidorBusiness.php';
	$DistribuidorBusiness = new DistribuidorBusiness();
	$action=$_POST['action'];
	if ($action=="consultarDistribuidor") {
	    echo json_encode($DistribuidorBusiness->DistribuidorMostrar());
	}else if($action=="modificarDistribuidor"){
		$cedula=htmlentities($_POST['cedula'] );
      	$nombre=htmlentities($_POST['nombre'] );
      	$apellido1=htmlentities($_POST['apellido1']);
      	$apellido2=htmlentities($_POST['apellido2'] );
      	$telefono=htmlentities($_POST['telefono'] );
      	$direccion=htmlentities($_POST['direccion'] );
      	$correo=htmlentities($_POST['correo'] );
      	$id=htmlentities($_POST['id']);

      	if(empty($cedula)||empty($nombre)||empty($apellido1)
            ||empty($apellido2)||empty($telefono)||empty($direccion)
            ||empty($correo) || empty($id)){
                  echo("false");

            }else{
                  if(empty($correo)){

                        $correo="N/A";
                  }
      		
      		echo $DistribuidorBusiness->DistribuidorModificar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo,$id);
      	}

	}else if($action=="registrarDistribuidor") {
		$cedula=htmlentities($_POST['cedula'] );
      	$nombre=htmlentities($_POST['nombre'] );
      	$apellido1=htmlentities($_POST['apellido1']);
      	$apellido2=htmlentities($_POST['apellido2'] );
      	$telefono=htmlentities($_POST['telefono'] );
      	$direccion=htmlentities($_POST['direccion'] );
      	$correo=htmlentities($_POST['correo'] );
      	if(empty($cedula)||empty($nombre)||empty($apellido1)||empty($apellido2)||empty($telefono)||empty($direccion)){
                  echo("false");

            }else{
                  if(empty($correo)){

                        $correo="N/A";
                  }
      		echo $DistribuidorBusiness->DistribuidorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
      	}


	}else if($action=="eliminarDistribuidor"){

            $id=htmlentities($_POST['id']);
            echo $DistribuidorBusiness->DistribuidorEliminar($id);

      }	

 ?>
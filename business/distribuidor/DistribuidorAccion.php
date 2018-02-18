<?php 

	include_once 'DistribuidorBusiness.php';
	$DistribuidorBusiness = new DistribuidorBusiness();
	$action=$_POST['action'];
	if ($action=="consultarDistribuidor") {
	    echo json_encode($DistribuidorBusiness->DistribuidorMostrar());
	}else if($action=="modificarDistribuidor"){
            /*String_tags quita todo codigo de html y php de un dato enviado por post*/
		$cedula=htmlentities(strip_tags($_POST['cedula']));
      	$nombre=htmlentities(strip_tags($_POST['nombre']));
      	$apellido1=htmlentities(strip_tags($_POST['apellido1']));
      	$apellido2=htmlentities(strip_tags($_POST['apellido2']));
      	$telefono=htmlentities(strip_tags($_POST['telefono']));
      	$direccion=htmlentities(strip_tags($_POST['direccion']));
      	$correo=htmlentities(strip_tags($_POST['correo']));
      	$id=htmlentities(strip_tags($_POST['id']));

      	if(empty($cedula)||empty($nombre)||empty($apellido1)
            ||empty($apellido2)||empty($telefono)||empty($direccion)
            ||empty($correo) || empty($id)){
                  echo("false");

            }else{
                  if(empty($correo) || !is_numeric($telefono)
                  || !filter_var($correo, FILTER_VALIDATE_EMAIL)
                  || !strlen($cedula)>0 || !strlen($nombre)>0
                  || !strlen($apellido1)>0 || !strlen($apellido2)>0
                  || !strlen($telefono)>0 || !strlen($direccion)>0
                  || !strlen($correo)>0
                  || !strlen($id)>0 || !is_numeric($id)){

                        $correo="N/A";
                  }else{
      		
      		echo $DistribuidorBusiness->DistribuidorModificar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo,$id);
                  }
      	}

	}else if($action=="registrarDistribuidor") {
		$cedula=htmlentities(strip_tags($_POST['cedula']));
      	$nombre=htmlentities(strip_tags($_POST['nombre']));
      	$apellido1=htmlentities(strip_tags($_POST['apellido1']));
      	$apellido2=htmlentities(strip_tags($_POST['apellido2']));
      	$telefono=htmlentities(strip_tags($_POST['telefono']));
      	$direccion=htmlentities(strip_tags($_POST['direccion']));
      	$correo=htmlentities(strip_tags($_POST['correo']));
      	if(empty($cedula)||empty($nombre)||empty($apellido1)||empty($apellido2)||empty($telefono)||empty($direccion)){
                  echo("false");

            }else{
                  if(empty($correo)|| !is_numeric($telefono)
                  || !filter_var($correo, FILTER_VALIDATE_EMAIL)
                  || !strlen($cedula)>0 || !strlen($nombre)>0
                  || !strlen($apellido1)>0 || !strlen($apellido2)>0
                  || !strlen($telefono)>0 || !strlen($direccion)>0
                  || !strlen($correo)>0){

                        $correo="N/A";
                  }else{
      		echo $DistribuidorBusiness->DistribuidorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
                         }
      	}


	}else if($action=="eliminarDistribuidor"){

            $id=htmlentities($_POST['id']);
            echo $DistribuidorBusiness->DistribuidorEliminar($id);

      }	

 ?>
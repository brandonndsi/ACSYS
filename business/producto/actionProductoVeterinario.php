<?php
	include 'businessProductoVeterinario.php';
	$businessProductoVeterinario = new businessProductoVeterinario();  
	$action=$_POST['action'];
	if ($action=="consultarproductos") {
	    echo $businessProductoVeterinario->productosMostrar();
	
      }else if($action=="modificarproducto"){
            $codigo=$_POST['codigo'];
            $nombre=$_POST['nombre'];
            $descripcion=$_POST['descripcion'];
            $precio=$_POST['precio'];
            $dosis=$_POST['dosis'];
            $dias=$_POST['dias'];
            $via=$_POST['via'];
            $funcion=$_POST['funcion'];
		
      	

      	if(empty($codigo)||empty($nombre)||empty($descripcion)||empty($precio)||empty($dosis)||empty($dias)||empty($via)||empty($funcion)){
      		echo("false");

      	}else{
                  
      		echo $businessProductoVeterinario->productoModificar($codigo,$nombre,$descripcion,$precio,$dosis,$dias,$via,$funcion);
      	}

	}else if($action=="registrarproducto") {
	      $codigo=$_POST['codigo'];
            $nombre=$_POST['nombre'];
            $descripcion=$_POST['descripcion'];
            $precio=$_POST['precio'];
            $dosis=$_POST['dosis'];
            $dias=$_POST['dias'];
            $via=$_POST['via'];
            $funcion=$_POST['funcion'] ;

      	if(empty($codigo)||empty($nombre)||empty($descripcion)||empty($precio)||empty($dosis)||empty($via)||empty($funcion)){
      		echo("false");

      	}else{
      		echo $businessProductoVeterinario->productoRegistrar($codigo,$nombre,$descripcion,$precio,$dosis,$dias,$via,$funcion);
      	}


	}else if($action=="eliminarproducto"){

            $codigo=$_POST['codigo'];
            echo $businessProductoVeterinario->productoEliminar($codigo);

      }     	

?>
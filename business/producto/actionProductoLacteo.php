<?php
	include 'businessProductoLacteo.php';
	$businessProductoLacteo = new businessProductoLacteo();  
	$action=$_POST['action'];
	if ($action=="consultarproductos") {
	    echo $businessProductoLacteo->productosMostrar();
	
      }else if($action=="modificarproducto"){
		$codigo=$_POST['codigo'] ;
      	$nombre=$_POST['nombre'] ;
      	$precio=$_POST['precio'];
      	$unidad=$_POST['unidad'] ;
      	

      	if(empty($codigo)||empty($nombre)||empty($precio)||empty($unidad)){
      		echo("false");

      	}else{
                  
      		echo $businessProductoLacteo->productoModificar($codigo,$nombre,$precio,$unidad);
      	}

	}else if($action=="registrarproducto") {
	      $codigo=$_POST['codigo'] ;
            $nombre=$_POST['nombre'] ;
            $precio=$_POST['precio'];
            $unidad=$_POST['unidad'] ;

      	if(empty($codigo)||empty($nombre)||empty($precio)||empty($unidad)){
      		echo("false");

      	}else{
      		echo $businessProductoLacteo->productoRegistrar($codigo,$nombre,$precio,$unidad);
      	}


	}else if($action=="eliminarproducto"){

            $codigo=$_POST['codigo'];
            echo $businessProductoLacteo->productoEliminar($codigo);

      }     	

?>
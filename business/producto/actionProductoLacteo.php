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
      	$cantidad=$_POST['cantidad'] ;
      	$unidad=$_POST['unidad'] ;
      	

      	if(empty($codigo)||empty($nombre)||empty($precio)||empty($cantidad)||empty($unidad)){
      		echo("false");

      	}else{
                  
      		echo $businessProductoLacteo->productoModificar($codigo,$nombre,$precio,$cantidad,$unidad);
      	}

	}else if($action=="registrarproducto") {
	      $codigo=$_POST['codigo'] ;
            $nombre=$_POST['nombre'] ;
            $precio=$_POST['precio'];
            $cantidad=$_POST['cantidad'] ;
            $unidad=$_POST['unidad'] ;

      	if(empty($codigo)||empty($nombre)||empty($precio)||empty($cantidad)||empty($unidad)){
      		echo("false");

      	}else{
      		echo $businessProductoLacteo->productoRegistrar($codigo,$nombre,$precio,$cantidad,$unidad);
      	}


	}else if($action=="eliminarproducto"){

            $id=$_POST['id'];
            echo $businessProductoLacteo->productorEliminar($id);

      }     	

?>
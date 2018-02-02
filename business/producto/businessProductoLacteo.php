<?php

class businessProductoLacteo {

    private $dataProductoLacteo;

    public function businessProductoLacteo() {

        include_once '../../data/producto/dataProductoLacteo.php';
        $this->dataProductoLacteo = new dataProductoLacteo();
    }

    public function productosMostrar() {
        return $this->dataProductoLacteo->productoMostrar();
    }

    public function productoModificar($codigo,$nombre,$precio,$cantidad,$unidad){

    	return $this->dataProductoLacteo->productoModificar($codigo,$nombre,$precio,$cantidad,$unidad);
    }

     public function productorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){

    	return $this->dataProductoLacteo->productoRegistrar($codigo,$nombre,$precio,$cantidad,$unidad);
    }

    public function productorEliminar($id){

        return $this->dataProductoLacteo->productorEliminar($id);
    }

}

?>
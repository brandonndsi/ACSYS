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

     public function productoRegistrar($codigo,$nombre,$precio,$unidad){

    	return $this->dataProductoLacteo->productoRegistrar($codigo,$nombre,$precio,$unidad);
    }

    public function productoEliminar($codigo){

        return $this->dataProductoLacteo->productoEliminar($codigo);
    }

}

?>
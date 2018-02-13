<?php

class businessProductoVeterinario {

    private $dataProductoVeterinario;

    public function businessProductoVeterinario() {

        include_once '../../data/producto/dataProductoVeterinario.php';
        $this->dataProductoVeterinario= new dataProductoVeterinario();
    }

    public function productosMostrar() {
     
        return $this->dataProductoVeterinario->productoMostrar();
    }

    public function productoModificar($codigo,$nombre,$descripcion,$precio,$dosis,$dias,$via,$funcion){
        

    	return $this->dataProductoVeterinario->productoModificar($codigo,$nombre,$descripcion,$precio,$dosis,$dias,$via,$funcion);
    }

     public function productoRegistrar($codigo,$nombre,$descripcion,$precio,$dosis,$dias,$via,$funcion){

    	return $this->dataProductoVeterinario->productoRegistrar($codigo,$nombre,$descripcion,$precio,$dosis,$dias,$via,$funcion);
    }

    public function productoEliminar($codigo){

        return $this->dataProductoVeterinario->productoEliminar($codigo);
    }

}

?>
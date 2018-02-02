<?php

class businessProductorSocio {

    private $dataProductorSocio;

    public function businessProductorSocio() {

        include_once '../../data/productor/dataProductorSocio.php';
        $this->dataProductorSocio = new dataProductorSocio();
    }

    public function productorMostrar() {
        return $this->dataProductorSocio->productoresMostrar();
    }

    public function productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){

    	return $this->dataProductorSocio->productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
    }

     public function productorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){

    	return $this->dataProductorSocio->productorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
    }

    public function productorEliminar($id){

        return $this->dataProductorSocio->productorEliminar($id);
    }

}

?>
<?php

class businessProductor {

    private $dataProductor;

    public function businessProductor() {

        include_once '../../data/productor/dataProductor.php';
        $this->dataProductor = new dataProductor();
    }

    public function productorMostrar() {
        return $this->dataProductor->productoresMostrar();
    }

    public function productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){

    	return $this->dataProductor->productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
    }

}

?>
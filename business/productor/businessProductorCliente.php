<?php

class businessProductorCliente {

    private $dataProductorCliente;

    public function businessProductorCliente() {

        include_once '../../data/productor/dataProductorCliente.php';
        $this->dataProductorCliente = new dataProductorCliente();
    }

    public function productorMostrar() {
        return $this->dataProductorCliente->productoresMostrar();
    }

    public function productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){

    	return $this->dataProductorCliente->productorModificar($id,$cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
    }

     public function productorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo){

    	return $this->dataProductorCliente->productorRegistrar($cedula,$nombre,$apellido1,$apellido2,$telefono,$direccion,$correo);
    }

    public function productorEliminar($id){

        return $this->dataProductorCliente->productorEliminar($id);
    }

}

?>
<?php

class businessProceso {

    private $dataProceso;

    public function businessProceso() {

        include_once '../../data/proceso/dataProceso.php';
        $this->dataProceso = new dataProceso();
    }

    public function procesosMostrar() {
        return $this->dataProceso->procesosMostrar();
    }

    public function procesoRegistrar($nombre, $cantidad, $porcentaje, $entera, $descremada, $cuajo, $cloruro, $sal, $cultivo, $estabilizador, $colorante, $crema1, $leche1, $crema2, $leche2) {

        return $this->dataProceso->procesoRegistrar($nombre, $cantidad, $porcentaje, $entera, $descremada, $cuajo, $cloruro, $sal, $cultivo, $estabilizador, $colorante, $crema1, $leche1, $crema2, $leche2);
    }
    
    public function consultarProducto() {
        return $this->dataProceso->consultarProducto();
    }
    
    public function procesoEliminar($cantidad,$nombre,$id) {

        return $this->dataProceso->procesoEliminar($cantidad,$nombre,$id);
    }
    
    public function buscarFecha($busquedafecha) {

        return $this->dataProceso->buscarFecha($busquedafecha);
    }
}

?>
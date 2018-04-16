<?php

class businesPrecioLeche {

    private $dataPrecioLeche;

    public function businesPrecioLeche() {

        include_once '../../data/precioLeche/dataPrecioLeche.php';
        $this->dataPrecioLeche = new dataPrecioLeche();
    }
    
    public function verPrecio() {

        return $this->dataPrecioLeche->verPrecio();
    }
    
    public function actualizarPrecio($id, $precio) {

        return $this->dataPrecioLeche->actualizarPrecio($id, $precio);
    }

}

?>
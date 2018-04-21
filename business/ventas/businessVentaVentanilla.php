<?php

class businessVentaVentanilla {

    private $dataVentaVentanilla;

    function businessVentaVentanilla() {
        require '../../data/ventas/dataVentaVentanilla.php';
        $this->dataVentaVentanilla = new dataVentaVentanilla();
    }

    function searchProduct($code) {
        return $this->dataVentaVentanilla->searchProduct($code);
    }

    function procesarVenta($productos, $idCliente, $totalNeto, $totalBruto) {
        return $this->dataVentaVentanilla->procesarVenta($productos, $idCliente, $totalNeto, $totalBruto);
    }

    function idfactura() {
        return $this->dataVentaVentanilla->idfactura();
    }

}

?>

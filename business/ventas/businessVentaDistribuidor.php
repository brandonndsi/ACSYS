<?php

class businessVentaDistribuidor {

    private $dataVentaDist;

    function businessVentaDistribuidor() {
        require '../../data/ventas/dataVentaDistribuidor.php';
        $this->dataVentaDist = new dataVentaDistribuidor();
    }

    function searchProduct($code) {
        return $this->dataVentaDist->searchProduct($code);
    }

    function procesarVenta($productos, $idCliente, $totalNeto, $totalBruto) {
        return $this->dataVentaDist->procesarVenta($productos, $idCliente, $totalNeto, $totalBruto);
    }

}

?>
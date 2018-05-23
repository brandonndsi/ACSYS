<?php

    class businessPagarVentas{
        private $dataPagarVentas;

        function businessPagarVentas() {
            require '../../data/ventas/dataPagarVentas.php';
            $this->dataPagarVentas = new dataPagarVentas();
        }

        function consultarVentasPorCobrar($idCliente) {
            return $this->dataPagarVentas->consultarVentasPorCobrar($idCliente);
        }

        function pagarVenta($idVentaPorCobrar) {
            return $this->dataPagarVentas->pagarVenta($idVentaPorCobrar);
        }

    }


?>
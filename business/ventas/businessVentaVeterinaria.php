<?php
  class businessVentaVeterinaria{

    private $dataVentaVeterinaria;

    function businessVentaVeterinaria(){
      require '../../data/ventas/dataVentaVeterinaria.php';
      $this->dataVentaVeterinaria = new dataVentaVeterinaria();
    }

    function searchProduct($code){
      return $this->dataVentaVeterinaria->searchProduct($code);
    }

    function procesarVenta($productos,$idCliente,$totalNeto,$totalBruto){
      return $this->dataVentaVeterinaria->procesarVenta($productos,$idCliente,$total);
    }
  }

 ?>

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
  }

 ?>

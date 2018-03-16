<?php
  require 'businessVentaVeterinaria.php';
  $action = $_POST['action'];
  $businessVentaVeterinaria = new businessVentaVeterinaria();
  if($action == "searchProduct"){
    $code = $_POST['code'];
    if(!empty($code)){
      echo $businessVentaVeterinaria->searchProduct($code);
    }else{
      echo "false";
    }
  }

 ?>

<?php
  require 'conexion/conexion.php';
  $Conexion_data = new conexion();
  $conn = $Conexion_data->crearConexion();
  $conn->set_charset("utf8");
  $password = password_hash("123", PASSWORD_DEFAULT);
  $sqlQuery = $conn->query("UPDATE `tbempleado` SET `passwordempleado`='$password' WHERE idpersonaempleado=1;");
  if($sqlQuery == 1){
      return "true";
  }else{
    return "false";
  }
?>

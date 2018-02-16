<?php
  require 'conexion/conexion.php';
  $Conexion_data = new conexion();
  $conn = $Conexion_data->crearConexion();
  $conn->set_charset("utf8");
  $password = password_hash("david1234", PASSWORD_DEFAULT);
  $sqlQuery = $conn->query("INSERT INTO tbempleado(idpersonaempleado,passwordempleado,estadoempleado) VALUES('2','$password','activo')");
  if($sqlQuery == 1){
      return "true";
  }else{
    return "false";
  }
?>

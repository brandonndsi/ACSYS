<?php

class dataFactura {

    private $conexion;

    function dataFactura() {
        include_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }

/*************************************************************/
    function imprimirCliente($idcliente){
         $this->conexion->crearConexion()->set_charset('utf8');
         /*$suk=$this->conexion->crearConexion()->query("SELECT `idpersonaventa` FROM `tbventa` WHERE numerofactura='".$numerofactura."';");
         $idcliente;
         while ($row = $suk->fetch_assoc()) {
             $idcliente=$row['idpersonaventa'];
         }*/
        $resultado=$this->conexion->crearConexion()->query("CALL buscarcliente('".$idcliente."')");
        $this->conexion->cerrarConexion();

         $array=array();
        while($row = $resultado->fetch_assoc()){
            array_push($array,$row);
        }
        return $array;

    }

    /**************************************************************/
    function imprimirVendedor($numerofactura){
       
         $this->conexion->crearConexion()->set_charset('utf8');
        $resultado=$this->conexion->crearConexion()->query("CALL    imprimirvendedor('".$numerofactura."');");
        $this->conexion->cerrarConexion();

         $array=array();
        while($row = $resultado->fetch_assoc()){
            array_push($array,$row);
        }
        return $array;
    }
    /************************************************************/
    function imprimirFactura($numerofactura){
         $this->conexion->crearConexion()->set_charset('utf8');
        $resultado=$this->conexion->crearConexion()->query("CALL imprimirfactura('".$numerofactura."');");
        $this->conexion->cerrarConexion();

         $array=array();
        while($row = $resultado->fetch_assoc()){
            array_push($array,$row);
        }
        return $array;
    }
    /*************************************************************/
    function imprimirDatoFactura($numerofactura){
         $this->conexion->crearConexion()->set_charset('utf8');
        $resultado=$this->conexion->crearConexion()->query("CALL imprimirdetallefactura('".$numerofactura."');");
        $this->conexion->cerrarConexion();

         $array=array();
        while($row = $resultado->fetch_assoc()){
            array_push($array,$row);
        }
        return $array;
    }

    function numeroFactura(){
    $con=$this->conexion->crearConexion();
      $con->set_charset("UTF8");
      $sqlQuery=$con->query("SELECT `ultimafactura` FROM `tbfacturero`;");
      $array;
        while($row=$sqlQuery->fetch_assoc()){
            $array=$row['ultimafactura'];
        }

        return $array;
    }

}
/*alt + 189 para sacar la moneda de colones de costa rica*/
/*

$dota= new dataFactura();
$d=$dota->imprimirCliente('4');
print_r($d);*/
?>

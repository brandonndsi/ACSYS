<?php

class dataPagarVentas{

    private $conexion;

    function dataPagarVentas() {
        date_default_timezone_set("America/Costa_Rica");
        require_once '../../data/conexion/conexion.php';
        $this->conexion = new conexion();
    }  

    function generateQuery($query){
        $conn = $this->conexion->crearConexion();
        $conn->set_charset("UTF8");
        $resultQuery = $conn->query($query);
        return $resultQuery;
    }

    function pagarVenta($idVentaPorCobrar){
        $hora=date("g:i A");
        $fecha=date("Y-m-d");
        $sql = "CALL pagarVenta('$idVentaPorCobrar','$fecha','$hora')";
        $result = $this->generateQuery($sql);
        if($result == 1){
            return "true";
        }else{
            return "false";
        }
    }

    function consultarVentasPorCobrar($idCliente){
        $resultQuery = $this->generateQuery("CALL consultarVentasPorCobrarCliente('$idCliente')");
        $list = array();
        while($result = $resultQuery->fetch_assoc()){
            array_push($list,$result);
        }
        echo json_encode($list);
    }

}


?>
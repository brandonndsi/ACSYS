<?php

$accion = $_POST['action'];

if ($accion == "ventaProcesos") {

    include_once 'businessReporteProcesos.php';

    $business = new businessReporteProcesos();
    $fechainicial = $_POST['fechai'];
    $fechafinal = $_POST['fechaf'];

    echo $business->ventaProcesos($fechainicial, $fechafinal);
}
?>
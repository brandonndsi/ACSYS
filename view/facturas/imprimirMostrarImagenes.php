<?php
require('../../pdf/fpdf/fpdf.php');

$ruta = $_GET['ruta'];
//$ruta='../../image/logo.png';
$pdf = new FPDF();
$pdf->AddPage();

$pdf->Image($ruta,5,10,200,250);

$pdf->Output();

 ?>
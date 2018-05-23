<?php

include_once 'Plantilla.php';
include_once '../../data/factura/dataFactura.php';

$lista = json_decode($_GET['listaTodo']);
$data = new dataFactura();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
/* El menu de la tabla de los productos */
$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln();
$pdf->Cell(150, 6, 'Reporte Todo ', 0, 0, 'C', 0);
$pdf->Ln(10);
$pdf->Cell(25, 6, 'Nombre', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Cantidad', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Fecha', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Hora', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Id', 1, 0, 'C', 1);

$pdf->SetFont('Arial', '', 12);
/* sacando los productos detalles de la factura */
foreach ($lista as $proceso) {
    $pdf->Ln();
    $pdf->Cell(25, 6, utf8_decode($proceso->nombre), 1, 0, 'C', 0);
    $pdf->Cell(30, 6, utf8_decode($proceso->cantidad), 1, 0, 'C', 0);
    $pdf->Cell(30, 6, utf8_decode($proceso->fecha), 1, 0, 'C', 0);
    $pdf->Cell(30, 6, utf8_decode($proceso->hora), 1, 0, 'C', 0);
    $pdf->Cell(40, 6, utf8_decode($proceso->id), 1, 0, 'C', 0);

}

$pdf->Ln(20);
$pdf->Cell(170, 6, 'Final de reporte !!', 0, 0, 'C', 0);
$pdf->Output();
?>
<?php
require('../../pdf/fpdf/fpdf.php');

$id = $_GET['numeroProceso'];
$nombre = $_GET['producto'];
$cantidad = $_GET['cantidad'];
$porcentaje = $_GET['porcentaje'];
$entera = $_GET['entera'];
$descremada = $_GET['descremada'];
$cuajo = $_GET['cuajo'];
$cloruro = $_GET['cloruro'];
$sal = $_GET['sal'];
$cultivo = $_GET['cultivo'];
$estabilizador = $_GET['estabilizador'];
$colorante = $_GET['colorante'];
$crema1 = $_GET['crema1'];
$leche1 = $_GET['leche1'];
$crema2 = $_GET['crema2'];
$leche2 = $_GET['leche2'];
$fecha = $_GET['fecha'];
$hora = $_GET['hora'];
$estado = $_GET['estado'];


/*cedula juridica: 3-002-397122
Telefono:25590179
El Sauce, Santa Teresita de Turialba*/

$pdf = new FPDF();
$pdf->AddPage();
// Logo
$pdf->Image('../../image/logo.png',10,6,30);
// Arial bold 15
$pdf->SetFont('Arial','B',15);
// Move to the right
$pdf->Cell(80);

// Title
$pdf->Cell(30,10,utf8_decode('Reporte Proceso'),0,0,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Nuemero de Proceso:',0,0,'L',0);
$pdf->Cell(60,6,$id,0,0,'R',0);
// Line break
$pdf->AliasNbPages();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Ln(20);
$pdf->Cell(40,6,'Producto:',0,0,'L',0);
$pdf->Cell(60,6,$nombre,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Cantidad:',0,0,'L',0);
$pdf->Cell(60,6,$cantidad,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'% de grasa leche entera:',0,0,'L',0);
$pdf->Cell(60,6,$porcentaje,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Leche entera:',0,0,'L',0);
$pdf->Cell(60,6,$entera,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Leche Descremada:',0,0,'L',0);
$pdf->Cell(60,6,$descremada,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Cuajo:',0,0,'L',0);
$pdf->Cell(60,6,$cuajo,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Cloruro de Calcio:',0,0,'L',0);
$pdf->Cell(60,6,$cloruro,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Sal:',0,0,'L',0);
$pdf->Cell(60,6,$sal,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Cultivo Codigo:',0,0,'L',0);
$pdf->Cell(60,6,$cultivo,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Estabilizador Codigo:',0,0,'L',0);
$pdf->Cell(60,6,$estabilizador,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Colorante:',0,0,'L',0);
$pdf->Cell(60,6,$colorante,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'#1 Crema:',0,0,'L',0);
$pdf->Cell(60,6,$crema1,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'#1 Leche:',0,0,'L',0);
$pdf->Cell(60,6,$leche1,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'#2 Crema:',0,0,'L',0);
$pdf->Cell(60,6,$crema2,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'#2 Leche:',0,0,'L',0);
$pdf->Cell(60,6,$leche2,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Hora:',0,0,'L',0);
$pdf->Cell(60,6,$hora,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Fecha de solicitud:',0,0,'L',0);
$pdf->Cell(60,6,$fecha,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Estado:',0,0,'L',0);
$pdf->Cell(60,6,$estado,0,0,'R',0);
$pdf->Ln(20);

$pdf->Output();

 ?>

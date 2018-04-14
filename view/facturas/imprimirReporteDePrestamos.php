<?php
require('../../pdf/fpdf/fpdf.php');

$nombreCliente = $_GET['nombreCliente'];
$fecha = $_GET['fecha'];
$interes = $_GET['interes'];
$plazo = $_GET['plazo'];
$modoPlazo = $_GET['modoPlazo'];
$montoSolicitado = $_GET['montoSolicitado'];
$cuota =$_GET['cuota'];
$total = $_GET['total'];

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
$pdf->Cell(30,10,utf8_decode('Reporte pago leche'),0,0,'C');
// Line break
$pdf->Ln(20);
$pdf->AliasNbPages();

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Ln(20);
$pdf->Cell(40,6,'Productor:',0,0,'L',0);
$pdf->Cell(60,6,$nombreCliente,0,0,'L',0);
$pdf->Cell(40,6,'Fecha de solicitud:',0,0,'L',0);
$pdf->Cell(60,6,$fecha,0,0,'L',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Monto solicitado:',0,0,'L',0);
$pdf->Cell(60,6,$montoSolicitado,0,0,'L',0);
$pdf->Cell(40,6,utf8_decode('Taza interés:'),0,0,'L',0);
$pdf->Cell(60,6,$interes."%",0,0,'L',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Plazo:',0,0,'L',0);
$pdf->Cell(60,6,$plazo." ".$modoPlazo."(s)",0,0,'L',0);
$pdf->Cell(40,6,'Cuota:',0,0,'L',0);
$pdf->Cell(60,6,$cuota,0,0,'L',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,utf8_decode('Total con interés:'),0,0,'L',0);
$pdf->Cell(40,6,$total,0,0,'L',0);
$pdf->Ln(20);
$pdf->Cell(40,6,utf8_decode('Bajo la reunión de la junta directiva de ASOPROLESA del día____del mes___________'),0,0,'L',0);
$pdf->Ln();
$pdf->Cell(40,6,utf8_decode('del año______ se ( ) aprueba o ( ) rechaza, el anticipo solicitado por el productor '),0,0,'L',0);
$pdf->Ln();
$pdf->Cell(40,6,utf8_decode($nombreCliente.', con la suma de '.$total.' neto.'),0,0,'L',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,"_____________________________________________",0,0,'L',0);
$pdf->Ln();
$pdf->Cell(40,6,"Firma del presidente",0,0,'L',0);
$pdf->Ln();
$pdf->Ln();

$pdf->Output();

 ?>

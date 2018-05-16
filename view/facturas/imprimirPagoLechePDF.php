<?php 
include_once 'PlantillaPagoLeche.php';
include_once '../../data/factura/dataFactura.php';

$precio=$_GET['precioleche'];
$total=$_GET['totallitros'];
$montoTotalColonesAhorro = $_GET['montototalcolonesahorro'];
$id=$_GET['id'];
$MontoTotalPagarLitros = $_GET['montototalpagarlitros'];
$montoAhorro = $_GET['montoahorro'];
$fecha = $_GET['fecha'];
$hora = date("g:i A");


$data= new dataFactura();
$op=$data->numeroFactura();
$d=$data->imprimirCliente($id);/*sacando de la base de datos los
datos del cliente*/
/*cedula juridica: 3-002-397122
Telefono:25590179
El Sauce, Santa Teresita de Turialba*/

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Ln();
foreach ($d as $row) {
    $pdf->Ln();
    $pdf->Cell(55,6,'Nombre',0,0,'C',0);
    $pdf->Cell(40,6,utf8_decode($row['nombrepersona'])." ".utf8_decode($row['apellido1persona'])." ".utf8_decode($row['apellido2persona']),0,0,'C',0);

}
$pdf->Ln();
$pdf->Ln(); 
$pdf->Cell(55,6,'Fecha',0,0,'C',0);
$pdf->Cell(30,6,$fecha,0,0,'C',0);
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(55,6,'Hora',0,0,'C',0);
$pdf->Cell(30,6,$hora,0,0,'C',0);
$pdf->Ln();
/*teniendo los datos del cliente*/

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(70,6,utf8_decode('Descripción'),1,0,'C',1);
$pdf->Cell(30,6,'Litros',1,0,'C',1);
$pdf->Cell(30,6,'Monto',1,0,'C',1);
$pdf->Cell(30,6,'Subtotal',1,0,'C',1);
$pdf->SetFont('Arial','',12);
/*sacando los productos detalles de la factura*/

$pdf->Ln();
$pdf->Cell(70,6,utf8_decode("Pagar Litros de Leche"),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode($total),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode('¢'.$precio),1,0,'C',0);
$pdf->Cell(30,6,(double)$total*(double)$precio,1,0,'C',0);
$pdf->Ln();
$pdf->Cell(70,6,utf8_decode("Total a Ahorrar"),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode($total),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode('¢'.$montoAhorro),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode($montoTotalColonesAhorro),1,0,'C',0);


$pdf->Ln();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(100,6,'Monto a Pagar.',1,0,'C',0);
$pdf->Cell(60,6,utf8_decode('¢'.$MontoTotalPagarLitros),1,0,'C',0);

$pdf->Ln(20);
$pdf->Cell(170,6,'',0,0,'C',0);
$pdf->Output();

 ?>
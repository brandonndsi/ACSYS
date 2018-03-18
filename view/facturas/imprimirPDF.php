<?php 
include_once 'Plantilla.php';
include_once '../../data/datafactura/DataFactura.php';
$op=$_GET['numerofactura'];
$data= new DataFactura();
$d=$data->imprimirCliente($op);/*sacando de la base de datos los datos del cliente*/
$des=$data->imprimirDatoFactura($op);/*sacando de la base de datos los datos de detalle de factura*/
$ven=$data->imprimirVendedor($op);/*sacando de la base de dato los datos del vendedor*/
$fac=$data->imprimirFactura($op);/*extrayendo los datos de la factura como tal*/

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Ln();
$pdf->Cell(70,6,'Cliente. ',1,0,'C',0);
/*
p.personanombre,p.personaapellido1,p.personaapellido2,p.personatelefono,p.personacorreo FROM tbfacturas f 
 */
/*teniendo los datos del cliente*/
foreach ($d as $row) {
$pdf->Ln();
$pdf->Cell(50,6,'Nombre: '.utf8_decode($row['personanombre']),0,0,'C',0);
$pdf->Cell(50,6,'Telefono: '.utf8_decode($row['personatelefono']),0,0,'C',0);
$pdf->Cell(70,6,'Email: '.utf8_decode($row['personacorreo']),0,0,'C',0);
}
/*teniendo los datos del vendedor*/
$pdf->Ln();
$pdf->Cell(70,6,'Vendedor. ',1,0,'C',0);
foreach ($ven as $row) {
$pdf->Ln();
$pdf->Cell(50,6,'Nombre: '.utf8_decode($row['personanombre']),0,0,'C',0);
$pdf->Cell(50,6,'Apellido 1: '.utf8_decode($row['personaapellido1']),0,0,'C',0);
$pdf->Cell(70,6,'Apellido 2: '.utf8_decode($row['personaapellido2']),0,0,'C',0);
}
$pdf->Ln();
$pdf->Cell(70,6,'Nombre Producto',1,0,'C',1);
$pdf->Cell(30,6,'Cantidad',1,0,'C',1);
$pdf->Cell(70,6,'Subtotal',1,0,'C',1);
/*
idproducto	cantidad	precioventa	productonombre
 */
$pdf->SetFont('Arial','',12);
/*sacando los productos detalles de la factura*/
foreach ($des as $row) {
$pdf->Ln();
$pdf->Cell(70,6,utf8_decode($row['productonombre']),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode($row['cantidad']),1,0,'C',0);
$pdf->Cell(70,6,utf8_decode('¢'.$row['precioventa']),1,0,'C',0);
}
foreach ($fac as $row) {
$pdf->Ln();
$pdf->Cell(100,6,'Monto a Pagar.',1,0,'C',0);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(70,6,utf8_decode('¢'.$row['totalventa']),1,0,'C',0);
}
$pdf->Ln(20);
$pdf->Cell(170,6,'Gracias por su compra !!',0,0,'C',0);
$pdf->Output();

 ?>
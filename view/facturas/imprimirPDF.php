<?php 
include_once 'Plantilla.php';
include_once '../../data/factura/dataFactura.php';
$op=$_GET['numerofactura'];
//$lista=$_GET['lista'];
$lista = json_decode($_GET['lista']);
$total;
$data= new dataFactura();
$op=$data->numeroFactura();
$d=$data->imprimirCliente(24);/*sacando de la base de datos los datos del cliente*/
//$des=$data->imprimirDatoFactura($op);/*sacando de la base de datos los datos de detalle de factura*/
//$ven=$data->imprimirVendedor($op);/*sacando de la base de dato los datos del vendedor*/
//$fac=$data->imprimirFactura($op);/*extrayendo los datos de la factura como tal*/

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Ln();
$pdf->Cell(70,6,'Numero Factura',1,0,'C',0);
$pdf->Ln();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(70,6,utf8_decode($op),0,0,'C',0);
$pdf->Ln();

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
$pdf->Cell(50,6,'Nombre: '.utf8_decode($row['nombrepersona']),0,0,'C',0);
}
/*$pdf->Cell(50,6,'Apellido1: '.utf8_decode($row['apellido1persona']),0,0,'C',0);
$pdf->Cell(70,6,'Apellido2: '.utf8_decode($row['apellido2persona']),0,0,'C',0);
}*/
/*teniendo los datos del vendedor*/
/*$pdf->Ln();
$pdf->Cell(70,6,'Vendedor. ',1,0,'C',0);
foreach ($ven as $row) {
$pdf->Ln();
$pdf->Cell(50,6,'Nombre: '.utf8_decode($row['personanombre']),0,0,'C',0);
$pdf->Cell(50,6,'Apellido 1: '.utf8_decode($row['personaapellido1']),0,0,'C',0);
$pdf->Cell(70,6,'Apellido 2: '.utf8_decode($row['personaapellido2']),0,0,'C',0);
}*/
$pdf->Ln();
$pdf->Cell(30,6,'Codigo',1,0,'C',1);
$pdf->Cell(55,6,'Nombre',1,0,'C',1);
$pdf->Cell(55,6,'Precio',1,0,'C',1);
$pdf->Cell(30,6,'Cantidad',1,0,'C',1);
/*
idproducto	cantidad	precioventa	productonombre
 */
$pdf->SetFont('Arial','',12);
/*sacando los productos detalles de la factura*/
foreach ($lista as $producto) {
$pdf->Ln();
$pdf->Cell(30,6,utf8_decode($producto->codigo),1,0,'C',0);
$pdf->Cell(55,6,utf8_decode($producto->nombre),1,0,'C',0);
$pdf->Cell(55,6,utf8_decode('¢'.$producto->precio),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode($producto->cantidad),1,0,'C',0);
$total = $producto->precio * $producto->cantidad;
}
$pdf->Ln();
$pdf->Cell(100,6,'Monto a Pagar.',1,0,'C',0);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(70,6,utf8_decode('¢'.$total),1,0,'C',0);
/*
foreach ($fac as $row) {
$pdf->Ln();
$pdf->Cell(100,6,'Monto a Pagar.',1,0,'C',0);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(70,6,utf8_decode('¢'.$total),1,0,'C',0);
}*/
$pdf->Ln(20);
$pdf->Cell(170,6,'Gracias por su compra !!',0,0,'C',0);
$pdf->Output();

 ?>
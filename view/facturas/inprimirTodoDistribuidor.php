<?php 
include_once 'Plantilla.php';
include_once '../../data/factura/dataFactura.php';

$lista = json_decode($_GET['lista']);
$tipo=$_GET['tipo'];
$data= new dataFactura();
//$d=$data->imprimirCliente($id);/*sacando de la base de datos los

/*cedula juridica: 3-002-397122
Telefono:25590179
El Sauce, Santa Teresita de Turialba*/

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
/*El menu de la tabla de los productos*/
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Ln();
$pdf->Cell(150,6,'Reporte Todo '.$tipo,0,0,'C',0);
$pdf->Ln(10);
$pdf->Cell(25,6,'N Factura',1,0,'C',1);
$pdf->Cell(30,6,'Fecha',1,0,'C',1);
$pdf->Cell(30,6,'Hora',1,0,'C',1);
$pdf->Cell(30,6,'Bruto',1,0,'C',1);
$pdf->Cell(30,6,'Total',1,0,'C',1);
$pdf->Cell(40,6,'Nombre',1,0,'C',1);

$pdf->SetFont('Arial','',12);
/*sacando los productos detalles de la factura*/
foreach ($lista as $producto) {
$pdf->Ln();
$pdf->Cell(25,6,utf8_decode($producto->numerofactura),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode($producto->fecha),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode($producto->hora),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode('¢'.$producto->bruto),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode('¢'.$producto->total),1,0,'C',0);
$nombre=$data->imprimirCliente($producto->idpersona);
foreach ($nombre as $row) {
$pdf->Cell(40,6,utf8_decode($row['nombrepersona']),1,0,'C',0);

}
//$pdf->Cell(40,6,utf8_decode($nombre),1,0,'C',0);
}


$pdf->Ln(20);
$pdf->Cell(170,6,'Final de reporte !!',0,0,'C',0);
$pdf->Output();

 ?>
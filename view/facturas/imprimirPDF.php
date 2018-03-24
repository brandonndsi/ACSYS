<?php 
include_once 'Plantilla.php';
include_once '../../data/factura/dataFactura.php';

$op=$_GET['numerofactura'];
$tot=$_GET['total'];
$tipoVenta = $_GET['tipo'];
$id=$_GET['id'];
$lista = json_decode($_GET['lista']);
$fecha = date('Y-m-d');
$hora = date("g:i A");

$data= new dataFactura();
$op=$data->numeroFactura();
$d=$data->imprimirCliente($id);/*sacando de la base de datos los
datos del cliente*/

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Ln();
$pdf->Cell(40,6,'Numero Factura',1,0,'C',0);
$pdf->Cell(43,6,utf8_decode($op),0,0,'C',0);
$pdf->Cell(55,6,'Fecha',1,0,'C',0);
$pdf->Cell(30,6,$fecha,0,0,'C',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'tipo',1,0,'C',0);
$pdf->Cell(43,6,utf8_decode($tipoVenta),0,0,'C',0);
$pdf->Cell(55,6,'Hora',1,0,'C',0);
$pdf->Cell(30,6,$hora,0,0,'C',0);
$pdf->Ln();
/*teniendo los datos del cliente*/
foreach ($d as $row) {
$pdf->Ln();
$pdf->Cell(50,6,'Nombre: '.utf8_decode($row['nombrepersona']),0,0,'C',0);
//}
$pdf->Cell(50,6,'Apellido1: '.utf8_decode($row['apellido1persona']),0,0,'C',0);
$pdf->Cell(70,6,'Apellido2: '.utf8_decode($row['apellido2persona']),0,0,'C',0);
}
/*El menu de la tabla de los productos*/
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(30,6,'Codigo',1,0,'C',1);
$pdf->Cell(55,6,'Nombre',1,0,'C',1);
$pdf->Cell(55,6,'Precio',1,0,'C',1);
$pdf->Cell(30,6,'Cantidad',1,0,'C',1);
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
$pdf->SetFont('Arial','B',14);
$pdf->Cell(100,6,'Monto a Pagar.',1,0,'C',0);
$pdf->Cell(70,6,utf8_decode('¢'.$tot),1,0,'C',0);

$pdf->Ln(20);
$pdf->Cell(170,6,'Gracias por su compra !!',0,0,'C',0);
$pdf->Output();

 ?>
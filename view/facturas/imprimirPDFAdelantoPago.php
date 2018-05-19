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
//listaTodo.push({"fecha":json[i].fechapagoprestamo,"saldoanterior":json[i].saldoanteriorpagopretsamo,"saldoactual":json[i].saldoactualpagoprestamo,"cuotas":json[i].montocuotapagoprestamo,"horapago":json[i].horapagoprestamo});
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Ln();
$pdf->Cell(150,6,'Reporte Todo '.$tipo,0,0,'C',0);
$pdf->Ln(10);
$pdf->Cell(25,6,'Fecha',1,0,'C',1);
//$pdf->Cell(30,6,'Pago Prestamo',1,0,'C',1);
$pdf->Cell(30,6,'Saldo Actual',1,0,'C',1);
$pdf->Cell(30,6,'Saldo Anterior',1,0,'C',1);
$pdf->Cell(30,6,'Cuota',1,0,'C',1);
$pdf->Cell(40,6,'Hora Pago',1,0,'C',1);

$pdf->SetFont('Arial','',12);
/*sacando los productos detalles de la factura*/
foreach ($lista as $producto) {
$pdf->Ln();
$pdf->Cell(25,6,utf8_decode($producto->fecha),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode($producto->saldoanterior),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode($producto->saldoactual),1,0,'C',0);
$pdf->Cell(30,6,utf8_decode('¢'.$producto->cuotas),1,0,'C',0);
$pdf->Cell(40,6,utf8_decode('¢'.$producto->horapago),1,0,'C',0);
//$nombre=$data->imprimirCliente($producto->idpersona);
/*foreach ($nombre as $row) {
$pdf->Cell(40,6,utf8_decode($row['nombrepersona']),1,0,'C',0);

}*/
//$pdf->Cell(40,6,utf8_decode($nombre),1,0,'C',0);
}


$pdf->Ln(20);
$pdf->Cell(170,6,'Final de reporte.',0,0,'C',0);
$pdf->Output();

 ?>
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
//listaTodo.push({"nombre":json[i].nombrepersona+" "+json[i].apellido1persona+" "+json[i].apellido2persona,"litros":json[i].cantidadlitroscompramateriaprima,"pagolitro":json[i].montopagolitro,"total":json[i].totalpagarlitros,"fecha":json[i].fechacompramateriaprima});
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->Ln();
$pdf->Cell(150,6,'Reporte '.$tipo,0,0,'C',0);
$pdf->Ln(10);
$pdf->Cell(35,6,'Nombre',1,0,'C',1);
$pdf->Cell(35,6,'Litros',1,0,'C',1);
$pdf->Cell(35,6,'Pago Litro',1,0,'C',1);
$pdf->Cell(35,6,'Total Ahorro',1,0,'C',1);
$pdf->Cell(40,6,'Fecha',1,0,'C',1);

$pdf->SetFont('Arial','',12);
/*sacando los productos detalles de la factura*/

foreach ($lista as $producto) {
$pdf->Ln();
$pdf->Cell(35,6,utf8_decode($producto->nombre),1,0,'C',0);
$pdf->Cell(35,6,utf8_decode($producto->litros),1,0,'C',0);
$pdf->Cell(35,6,utf8_decode('¢'.$producto->pagolitro),1,0,'C',0);
$pdf->Cell(35,6,utf8_decode('¢'.$producto->total),1,0,'C',0);
$pdf->Cell(40,6,utf8_decode($producto->fecha),1,0,'C',0);
}


$pdf->Ln(20);
$pdf->Cell(170,6,'Final de reporte.',0,0,'C',0);
$pdf->Output();

 ?>
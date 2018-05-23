<?php 
include_once 'PlantillaProce.php';
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


/*cedula juridica: 3-002-397122
Telefono:25590179
El Sauce, Santa Teresita de Turialba*/
// listaTodo.push({"numerofactura":numfactura,"id":id,"nombre":nombre,"cantidad":cantidad,"porcentaje":porcentaje,"entera":entera,"descremada": descremada,"cuajo":cuajo,"cloruro":cloruro,"sal":sal,"cultivo":cultivo,"estabilizador":estabilizador,"colorante":colorante,"crema1":crema1,"leche1":leche1,"crema2":crema2,"leche2":leche2,"fecha":fecha,"hora":hora,"estado": estado});
        
$pdf->SetFont('Arial','',12);
/*sacando los productos detalles de la factura*/
$pdf->Ln(20);
foreach ($lista as $producto) {
	/*$pdf->Ln();
$pdf->Cell(25,6,utf8_decode($producto->fecha),1,0,'C',0);
$pdf->Cell(35,6,utf8_decode('¢'.$producto->saldoanterior),1,0,'C',0);
$pdf->Cell(35,6,utf8_decode('¢'.$producto->saldoactual),1,0,'C',0);
$pdf->Cell(35,6,utf8_decode('¢'.$producto->cuotas),1,0,'C',0);
$pdf->Cell(40,6,utf8_decode($producto->horapago),1,0,'C',0);
*/
$pdf->Cell(40,6,'N Proceso:',0,0,'c',0);
$pdf->Cell(60,6,$producto->id,0,0,'c',0);
// Line break
$pdf->Cell(40,6,'Producto:',0,0,'L',0);
$pdf->Cell(60,6,$producto->nombre,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Cantidad:',0,0,'L',0);
$pdf->Cell(60,6,$producto->cantidad,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Grasa leche entera:',0,0,'L',0);
$pdf->Cell(60,6,'%'.$producto->porcentaje,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Leche entera:',0,0,'L',0);
$pdf->Cell(60,6,$producto->entera,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Leche Descremada:',0,0,'L',0);
$pdf->Cell(60,6,$producto->descremada,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Cuajo:',0,0,'L',0);
$pdf->Cell(60,6,$producto->cuajo,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Cloruro de Calcio:',0,0,'L',0);
$pdf->Cell(60,6,$producto->cloruro,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Sal:',0,0,'L',0);
$pdf->Cell(60,6,$producto->sal,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Cultivo Codigo:',0,0,'L',0);
$pdf->Cell(60,6,$producto->cultivo,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Estabilizador Codigo:',0,0,'L',0);
$pdf->Cell(60,6,$producto->estabilizador,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Colorante:',0,0,'L',0);
$pdf->Cell(60,6,$producto->colorante,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'#1 Crema:',0,0,'L',0);
$pdf->Cell(60,6,$producto->crema1,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'#1 Leche:',0,0,'L',0);
$pdf->Cell(60,6,$producto->leche1,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'#2 Crema:',0,0,'L',0);
$pdf->Cell(60,6,$producto->crema2,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'#2 Leche:',0,0,'L',0);
$pdf->Cell(60,6,$producto->leche2,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Hora:',0,0,'L',0);
$pdf->Cell(60,6,$producto->hora,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Fecha de solicitud:',0,0,'L',0);
$pdf->Cell(60,6,$producto->fecha,0,0,'R',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,6,'Estado:',0,0,'L',0);
$pdf->Cell(60,6,$producto->estado,0,0,'R',0);
}
$pdf->Ln(20);

$pdf->Output();

 ?>
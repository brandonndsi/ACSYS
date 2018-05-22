<?php
require('../../pdf/fpdf/fpdf.php');
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../../image/logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,utf8_decode('Reporte de Prestamos'),0,0,'C');
    // Line break
    $this->Ln(20); 
    //Arial bold 12
    $this->SetFont('Arial','B',12);
    $this->Cell(40,10,utf8_decode('Cedula juridica : '),0,0,'c',0);   
    $this->Cell(43,10,utf8_decode('3-002-397122'),0,0,'c',0); 
    //Parte del telefono 
    $this->Cell(40,10,utf8_decode('Telefono : '),0,0,'c',0);   
    $this->Cell(43,10,utf8_decode('2559-0179'),0,0,'c',0);
    $this->Ln();//salto de linea de la factura 
    $this->Cell(40,10,utf8_decode('Ubicación : '),0,0,'c',0);   
    $this->Cell(43,10,utf8_decode('El Sauce, Santa Teresita de Turialba.'),0,0,'c',0);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

 ?>

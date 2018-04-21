<!DOCTYPE html>
<html>
<head>
  <title>Reporte de Pago de Leche</title>

      <!--CSS-->
          <link rel="stylesheet" href="../../css/jquery.dataTables.css">
          <link rel="stylesheet" href="../../css/menu.css">
          <link rel="stylesheet" type="text/css" href="../../css/reportes/ventas.css">
          <link rel="stylesheet" href="../../css/bootstrap.min.css" >
          <link rel="stylesheet" type="text/css" href="../../css/distribuidor/modalImagen.css">
          <link rel="stylesheet" type="text/css" href="../../css/distribuidor/DistribuidorVenta.css">
         
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
          <!--Javascript-->
          <script src="../../js/jquery-3.2.1.js"></script>
          <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
          <script src="../../js/jquery.dataTables.js"></script>
          <script src="../../js/menuJs.js"></script>
          <script src="../../js/bootstrap.min.js"></script>
          <script type="text/javascript" src="../../js/reportes/reportePagoPrestamoJs.js"></script>
         
        </script>
</head>
<body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="consultarProductorSocio();">
<?php 
include_once '../menuView.php';
 ?>
 
 <div id="content">

  <div id="contTitulo">
            <h4>Reporte de Pago de Adelantos</h4>
  </div>


  <div id="fechas">
    <label>Cliente:</label>
    <select style="width:10%" onchange="obtenerPrestamosSocio()" id="selectCliente" name="selectCliente" style="background:white" ></select>
    <label>Adelantos:</label>
    <select style="width:10%" onchange="" id="selectPrestamos" name="selectPrestamos" style="background:white" ></select>
    <label>Fecha Inicial</label><input type="date" id="fechainicial" autocomplete="on" value="<?PHP  echo date('Y-m-d'); ?>" step="1" min="2017-12-30" max="<?PHP  echo date('Y-m-d'); ?>">
    <label id="lblfil">Fecha Final</label><input type="date" id="fechafinal" autocomplete="on" value="<?PHP  echo date('Y-m-d'); ?>" step="1" min="2017-12-30" max="<?PHP  echo date('Y-m-d'); ?>">
    <input style="margin-left:30px;" type="submit" id="procesar" value="Cargar Busqueda" onclick="mostrarPagosPrestamos();">
  </div>


  <div id="tablaPrincipal">
    <table id="listaAhorro" class="display" cellspacing="0">
        <thead>
          <tr>
            <th>N° de Adelanto</th>
            <th>Saldo Anterior</th>
            <th>Saldo Actual</th>
            <th>Monto Cuota</th>
            <th>Fecha de Pago</th>
            <th>Hora de Pago</th>
            <th>Imprimir</th>

          </tr>
          </thead>
          <tbody id="datos">

          </tbody>
            <tfoot>
                       
            </tfoot>
      </table>

  </div>


 </div>
  <div id="reporte_pago_leche_imprimir">
    
    <input type="submit" id="imprimir" value="Imprimir Todo" class="btn btn-primary" onclick="imprimirReporte();">
  </div>
  

</body>
</html>

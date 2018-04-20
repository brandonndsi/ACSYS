<!DOCTYPE html>
<html>
<head>
	<title>Reporte Venta Distribuidor</title>

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
          <script type="text/javascript" src="../../js/reportes/reportesVentaDistribuidor.js"></script>
         
        </script>
</head>
<body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%">
<?php 
include_once '../menuView.php';
 //include '../InterumtorDeMenus.php';
 ?>
 
 <div id="content">

 	<div id="contTitulo">
            <h4>Reporte de ventas Distribuidor</h4>
 	</div>

 	<div id="fechas">
 		<label>Fecha Inicial</label><input type="date" id="fechainicial" autocomplete="on" value="<?PHP  echo date('Y-m-d'); ?>"
    step="1" min="2017-12-30" max="<?PHP  echo date('Y-m-d'); ?>">
 		<label id="lblfil">Fecha Final</label><input type="date" id="fechafinal" autocomplete="on" value="<?PHP  echo date('Y-m-d'); ?>" step="1" min="2017-12-30" max="<?PHP  echo date('Y-m-d'); ?>">
 		<input type="submit" id="procesar" value="Cargar Busqueda" onclick="buscarDatos();">
 	</div>

 	<div id="tablaPrincipal">
 		<table id="listaVentas" class="display" cellspacing="0">
				<thead>
					<tr>
						<th>NO factura</th>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Total Bruto</th>
						<th>Total Neto</th>
            <th>Tipo venta</th>
            <th>Ver</th>
            <th>Imprimir</th>

					</tr>
					</thead>
					<tbody id="datos">

                	</tbody>
                    <tfoot>
                               
                    </tfoot>
			</table>

 	</div>
<?php 
include_once '../modalimagen/modalRespuestas.php';
include_once '../modalimagen/modalVerDetallesDeFacturas.php';
 ?>

 </div>
<div id="reporte_pago_leche_imprimir">
    
    <input type="submit" id="imprimir" value="Imprimir Todo" class="btn btn-primary" onclick="imprimirReporte();">
</div>
  

</body>
</html>
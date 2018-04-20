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
          <script type="text/javascript" src="../../js/reportes/reportePagoLecheJs.js"></script>
         
        </script>
</head>
<body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%">
<?php 
include_once '../menuView.php';
 ?>
 
 <div id="content">

 	<div id="contTitulo">
            <h4>Reporte de Pago de Leche</h4>
 	</div>

 	<div id="fechas">
 		<label>Fecha Inicial</label><input type="date" id="fechainicial" autocomplete="on">
 		<label id="lblfil">Fecha Final</label><input type="date" id="fechafinal" autocomplete="on">
 		<input type="submit" id="procesar" value="Cargar Busqueda" onclick="mostrarTotalPago();">
 	</div>


 	<div id="tablaPrincipal">
 		<table id="listaAhorro" class="display" cellspacing="0">
				<thead>
					<tr>
						<th>N° de Pago</th>
						<th>Nombre Completo</th>
						<th>Total Litros</th>
						<th>Monto por Litro</th>
						<th>Monto Total</th>
						<th>Fecha</th>
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
  <div >
    
    <input type="submit" id="imprimir" value="Imprimir Reporte" onclick="imprimirReporte();">
  </div>
  

</body>
</html>
<!DOCTYPE html>
    <html lang="es">
        <head>
          <meta charset="UTF-8">
          <!--CSS-->
          <link rel="stylesheet" href="../../css/jquery.dataTables.css">
          <link rel="stylesheet" href="../../css/menu.css">
          <link rel="stylesheet" href="../../css/recepcionLeche.css">
          <link rel="stylesheet" href="../../css/bootstrap.min.css" >
          <link rel="stylesheet" href="../../css/ventaVeterinaria.css">
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
          <!--Javascript-->
          <script src="../../js/jquery-3.2.1.js"></script>
          <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
          <script src="../../js/jquery.dataTables.js"></script>
          <script src="../../js/menuJs.js"></script>
          <script src="../../js/bootstrap.min.js"></script>
          <script src="../../js/ventas/ventaVeterinarioJs.js"></script>
          <script src="../../js/productor/prestamosJS.js"></script>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

          <script>
            $( function() {
              d=new Date();
              document.getElementById("fecha").value=d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear();
            } );

          </script>
        </head>

        <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="cargarTabla();consultarProductorSocio();">
        <?php
            include '../menuView.php';
        ?>
         <div class="ventaVeterinaria">
           <h4>Solicitud de préstamos</h4>
           <div class="principal">
             <label class="caja">Fecha de solicitud:</label>
             <label  class="caja labelCaja">Cliente:</label>
             <input type="text" id="fecha"  class="btn  caja" readonly="readonly">
             <select id="selectCliente" name="selectCliente" style="background:white" class="btn  caja labelCaja"></select>
           </div>
           <div class="principal">
             <label  class="caja">% Interes:</label>
             <label  class="caja labelCaja">Monto del préstamo:</label>
             <select type="text" id="interes" style="background:white"  class="btn caja" >
                <option value="10">10%</option>
                <option value="20">20%</option>
                <option value="5">5%</option>
             </select>
             <input type="text" class="btn caja labelCaja" id="montoPrestamo">
          </div>
          <label  class="caja labelCaja">Plazo:</label>
          <div class="caja">
             <input type="text" class="btn" id="plazoNumero">
             <select type="text" id="plazoModo" class="btn" style="background:white">
                <option value="semana">Semanal</option>
                <option value="quincena">Quincenal</option>
                <option value="mes">Mensual</option>
             </select>
             <button onclick="consultarCouta();" class="btn btn-primary">Consultar cuota</button>
          </div>
           <button class="btn btn-danger" onclick="location.reload();">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
           <button class="btn btn-primary" onclick="registrarSolicitudPrestamoConfirmacion()">Ingresar solicitud <span class="glyphicon glyphicon-cog"></span></button>
         </div>
    </body>
</html>

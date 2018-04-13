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
          <script src="../../js/productor/pagoCuotaPrestamoJs.js"></script>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

          
        </head>

        <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="cargarTabla();consultarProductorSocio();">
        <?php
            include '../menuView.php';
        ?>
         <div class="ventaVeterinaria">
           <h4>Pago de Cuota de Adelanto de Pago</h4>
           <center>
             
             <label  class="caja labelCaja">Cliente:</label>
             
             <select onchange="mostrarCuota()" id="selectCliente" name="selectCliente" style="background:white" class="btn  caja labelCaja"></select>
           </center>

           <div>
              <table id="listaProductores" class="display" cellspacing="0" >
             
                  <thead>
                      <tr>
                          <th>Código Adelanto de Pago</th>
                          <th>Monto Total</th>
                          <th>Fecha de Aprobación</th>
                          <th>Monto Cuota</th>
                          <th>Saldo Actual</th>
                          <th>Pagar Cuota</th>
                          
                      </tr>
                  </thead>
                  <tbody id="datos">

                  </tbody>
                  <tfoot>
                      
                  </tfoot>
              </table>  
          </div>
           <!--
           <div class="principal">
             <label  class="caja">Saldo Actual:</label>
             <label  class="caja labelCaja">Monto Cuota:</label>
             <input type="text" class="btn  caja" id="saldoActual" readonly="readonly">
             <input type="text" class="btn  caja labelCaja" id="montoCuota">
          </div>
          <label  class="caja ">Nuevo Saldo:</label>
          <div class="">
             <input type="text" class="btn  caja" id="saldoNuevo" readonly="readonly">
          </div>
           <button class="btn btn-danger" onclick="location.reload();">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
           <button class="btn btn-primary" onclick="registrarPagoCuotaConfirmacion()">Registrar Pago <span class="glyphicon glyphicon-cog"></span></button>
        
         -->
        </div>
    </body>
</html>
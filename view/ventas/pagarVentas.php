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
          <script src="../../js/ventas/pagarVenta.js"></script>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

          
        </head>

        <body background="../fondo.jpg" onload="consultaProductor();consultarVentasPorCobrar();">
        <?php
            //include '../menuView.php';
          include '../InterumtorDeMenus.php';
        ?>

         <div class="contenedor" id="contenedor">
         <div class="ventaVeterinaria">
           <h4>Pago de Ventas</h4>
           <!--<center>-->
             
             <label  class="caja labelCaja">Cliente:</label>
             
            <select  id="selectCliente" name="selectCliente" style="background:white" class="btn  caja labelCaja"></select>
            <button onclick="consultarVentasPorCobrar()"  class="btn btn-info  caja ">Buscar</button>
           </center>

           <div>
              <table id="listaVentas" class="display" cellspacing="0" >
             
                  <thead>
                      <tr>
                          <th>N° Factura</th>
                          <th>Fecha venta</th>
                          <th>Tipo de venta</th>
                          <th>Total</th>
                          <th>Pagar</th>
                      </tr>
                  </thead>
                  <tbody id="datos">

                  </tbody>
                  <tfoot>
                      
                  </tfoot>
              </table>  
          </div>

        </div>
      </div>
    </body>
</html>
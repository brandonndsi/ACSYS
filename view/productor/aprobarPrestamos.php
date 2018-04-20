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
          <script src="../../js/productor/aprobarSolicitudPrestaamoJs.js"></script>
          <script src="../../js/bootstrap.min.js"></script>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

          
        </head>

        <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="mostrarSolicitudes()">
        <?php
            //include '../menuView.php';
          include '../InterumtorDeMenus.php';
        ?>
         <div class="ventaVeterinaria">
           <h4>Aprobación de  Adelanto de Pago</h4>
           <center>
             
            

           <div>
              <table id="listaProductores" class="display" cellspacing="0" >
             
                  <thead>
                      <tr>
                      
                          <th>N° Solicitud</th>
                          <th>Cliente</th>
                          <th>Plazo</th>
                          <th>Modo de Pago</th>
                          <th>Monto Total</th>
                          <th>Tasa de Interes</th>
                          <th>Cuota </th>
                          <th>Fecha</th>
                          <th>Acción</th>
                         
                          
                      </tr>
                  </thead>
                  <tbody id="datos">

                  </tbody>
                  <tfoot>
                      
                  </tfoot>
              </table>  
          </div>
       
        </div>
    </body>
</html>
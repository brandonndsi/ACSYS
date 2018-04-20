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
          <script src="../../js/productor/recepcionLecheJs.js"></script>

          <script>
            $( function() {
              $( "#fecha" ).datepicker({
                dateFormat:'dd/mm/yy',
                maxDate:'+0d',
              });
              d=new Date();
              document.getElementById("fecha").value=d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear();
            } );
            
          </script>
        </head>

        <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="cargarTabla();consultarProductorSocio();">
        <?php
            //include '../menuView.php';
          include '../InterumtorDeMenus.php';
        ?>
         <div class="ventaVeterinaria">
           <h4>Recepción de Leche</h4>
           <div class="principal">
             <label class="caja">Fecha:</label>
             <label  class="caja labelCaja">Cliente:</label>
             
           
           <input type="text" id="fecha"  class="btn  caja" readonly="readonly">
           <select id="selectCliente"  style="background:white" class="btn  caja labelCaja"></select></div>
           <div>
             <label  class="caja" >Turno de entrega:</label>
             <label  class="caja labelCaja">Peso de entrega:</label> 
           </div>
           <select type="text" id="turno" style="background:white"  class="btn  caja ">
              <option>Mañana</option>
              <option>Tarde</option>
           </select>
           <input id="peso"   class="btn  caja labelCaja">

           <button class="btn btn-danger">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
           <button class="btn btn-primary" onclick="registrarLeche()">Procesar venta <span class="glyphicon glyphicon-cog"></span></button>
         </div>
             <!--Modal de respuesta socio-->
            <div id="modalRespuesta" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon-ok-circle" > Confirmación</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <div id="mensaje"></div>
                            </center>
                        </div>
                        <div class="modal-footer">

                            <p><button data-dismiss='modal' class="btn btn-danger">Cerrar</button> </p>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dalog -->
            </div><!-- /.modal -->
    </body>
</html>
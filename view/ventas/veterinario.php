<!DOCTYPE html>
    <html lang="es">
        <head>
          <meta charset="UTF-8">
          <!--CSS-->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
          <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

          <link rel="stylesheet" href="../../css/jquery.dataTables.css">
          <link rel="stylesheet" href="../../css/menu.css">
          <link rel="stylesheet" href="../../css/bootstrap.min.css" >
          <link rel="stylesheet" href="../../css/ventaVeterinaria.css">
          <!--Javascript-->
          <script src="../../js/jquery.dataTables.js"></script>
          <script src="../../js/menuJs.js"></script>
          <script src="../../js/bootstrap.min.js"></script>
          <script src="../../js/ventas/ventaVeterinarioJs.js"></script>
          <script src="../../js/autocomplete.js"></script>
            <script>
                localStorage.clear();
                $(document).ready(function () {
                $('[data-toggle="tooltip"]');
                });
            </script>
        </head>

        <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="cargarTabla();consultarProductorSocio();">
        <?php
            include '../menuView.php';
        ?>
         <div class="ventaVeterinaria">
           <h4>Ventas veterinarios</h4>
           <label>Cliente:</label>
           <select id="selectCliente"  class="btn btn-info selectCliente">
           </select>
           <button onclick="$('#modalProductosVeterinarioVenta').modal();cargarTabla1();" class="btn btn-primary">Buscar producto <span class="glyphicon glyphicon-search"></span></button>
           <div>
             <table id="listaProductosVeterinarios" class="display" cellspacing="0" >
                 <thead>
                     <tr>
                         <th>Codigo</th>
                         <th>Articulo</th>
                         <th>P. Venta</th>
                         <th>Cantidad</th>
                         <th>Descuento</th>
                         <th>Total</th>
                         <th>Eliminar</th>
                     </tr>
                 </thead>
                 <tbody id="datos">

                 </tbody>
             </table>
           </div>
           <button class="btn btn-danger">Cancelar <span class="glyphicon glyphicon-remove"></span></button>
           <button class="btn btn-primary">Procesar venta <span class="glyphicon glyphicon-cog"></span></button>
         </div>
         <!--Modal buscar productos veterinarios-->
        <div id="modalProductosVeterinarioVenta" class="modal fade in">
            <div  class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Productos</h4>
                    </div>
                    <div class="modal-body">
                      <label>Producto a buscar:</label>
                      <input type="text" id="productoBuscar" onkeyup="filtrar();" name="productoBuscar" style="background-color: lightgray" class="btn selectCliente">
                      <table id="buscarProductos" name="table" class="display" cellspacing="0" >
                          <thead>
                              <tr>
                                  <th>Seleccione</th>
                                  <th>Codigo</th>
                                  <th>Nombre</th>
                                  <th>Descripción</th>
                                  <th>P. Venta</th>
                              </tr>
                          </thead>
                          <tbody id="datos1">

                          </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                        <p>
                          <button data-dismiss='modal' class="btn btn-danger" id="btn-cancelar">Cancelar</button>
                          <button data-dismiss='modal' onclick="agregarProductoCarritoBuscar()" class="btn btn-primary" id="btn-enviar">Agregar</button>
                        </p>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dalog -->
        </div><!-- /.modal -->

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

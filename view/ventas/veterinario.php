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
          <link rel="stylesheet" href="../../css/bootstrap.min.css" >
          <link rel="stylesheet" href="../../css/menu.css">
          <link rel="stylesheet" href="../../css/ventaVeterinaria.css">
          <!--<link rel="stylesheet" href="../../css/distribuidor/DistribuidorVenta.css">-->
          <!--Javascript-->
          <script src="../../js/jquery.dataTables.js"></script>
          <script src="../../js/menuJs.js"></script>
          <script src="../../js/bootstrap.min.js"></script>
          <script src="../../js/ventas/ventaVeterinarioJs.js"></script>
          <script src="../../js/autocomplete.js"></script>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                localStorage.clear();
                $(document).ready(function () {
                $('[data-toggle="tooltip"]');
                });
            </script>
        </head>

        <body background="../fondo.jpg"  onload="cargarTabla();consultarProductorSocio();">
        <?php
           // include '../menuView.php';
           include '../InterumtorDeMenus.php';
        ?>
         <div class="ventaVeterinaria contenedor">
           <h4>Ventas veterinarios</h4>
           <label id="selectlabel">Cliente:</label>
           <select id="selectCliente"  class="btn btn-info selectCliente">
           </select>
           <div class="form-group">
           <div class="col-sm-2">
           <button onclick="$('#modalProductosVeterinarioVenta').modal();cargarTabla1();" class="btn btn-primary">Buscar producto <span class="glyphicon glyphicon-search"></span></button>
            </div>
            <div class="col-sm-1">
            <label>Total</label>
            </div>
            <div class="col-sm-2">
           <input type="text" readonly="readonly" id="totalPagar">
          </div>
        </div>
           <div>
             <table id="listaProductosVeterinarios" class="display" cellspacing="0" >
                 <thead>
                     <tr>
                         <th>Codigo</th>
                         <th>Articulo</th>
                         <th>P. Venta</th>
                         <th>Cantidad</th>
                         <th>Total</th>
                         <th>Eliminar</th>
                     </tr>
                 </thead>
                 <tbody id="datos">

                 </tbody>
             </table>
           </div>
           <!--onclick=" location.href = '../../view/ventas/veterinario.php'"-->
           <button class="btn btn-danger" >Cancelar <span class="glyphicon glyphicon-remove"></span></button>
           <button class="btn btn-primary" onclick="carry();">Procesar venta <span class="glyphicon glyphicon-cog"></span></button>
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
                    <div class="modal-footer" id="foo">
                        <p>
                          <button data-dismiss='modal' class="btn btn-danger" id="btn-cancelar" >Cancelar</button>
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

            <!--Metodo introducido por david salas -->
            <div id="modalRecibo" class="modal fade in">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="form-group">
                            <div class="col-sm-1">
                                <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
                            </div>
                            <div class="col-sm-10">
                                <h2 id="facTitulo">Resivo</h2>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="facLogoInfo">
                               <h2>EL SAUCE TICO</h2>  
                            </div>
                            <div id="faclogo">
                                <img src="../../image/logo.png" width="100px" height="100px">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  id="facNumero">Factura N°:</label>
                            <input id="Re_recibo" name="contrasenaNueva" 
                            type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label  id="facCliente">Cliente:</label>
                            <input id="Re_cliente"  name="contrasenaNueva" type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label  id="facTipo">Tipo venta:</label>
                            <input id="Re_tipoVenta" name="contrasenaNueva" type="text" placeholder="">
                        </div>
                        <!--<label>Productos:</label>-->
                        <table align="center" id="factabla">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <!--<th>Total</th> -->
                                </tr>
                            </thead>
                            <tbody id="Re_ventaProductos">

                            </tbody>
                            <tfoot id ="Re_totalPagar">

                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button class="btn btn-danger" onclick="location.href = '../../view/ventas/veterinario.php'" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
                            <button class="btn btn-primary" onclick ="location.href = '../../view/ventas/veterinario.php';ImprimirFactura();"><span class="glyphicon glyphicon-check"></span> Imprimir</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dalog -->
        </div><!-- /.modal -->

        <!-- Finalizacion del metodo introducido por David Salas-->
    </body>
</html>

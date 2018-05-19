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
        <link rel="stylesheet" href="../../css/ventaVentanilla.css">

        <!--Javascript-->
        <script src="../../js/jquery.dataTables.js"></script>
        <script src="../../js/menuJs.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/ventas/ventaVentanillaJS.js"></script>
        <script src="../../js/autocomplete.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            localStorage.clear();
            $(document).ready(function () {
                $('[data-toggle="tooltip"]');
            });
        </script>
    </head>

    <body background="../fondo.jpg" onload="cargarTablaLacteo();consultaProductor();">
        <?php
        include '../InterumtorDeMenus.php';
        ?>
        <div class="ventaVeterinaria contenedor">
            <h4>Ventas ventanilla</h4>
            <label id="selectlabel">Cliente:</label>
            <select id="selectCliente"  class="btn btn-info selectCliente">
            </select>
            <div class="form-group">
                <div class="col-sm-3">
                    <button onclick="$('#modalProductosVentanilla').modal();carga();" class="btn btn-primary">Buscar producto <span class="glyphicon glyphicon-search"></span></button>
                </div>
                <div class="col-sm-1">
                    <label>Total</label>
                </div>
                <div class="col-sm-2">
                    <p><input type="text" class="form-control"id="totalPagar" readonly></p>
                </div>
            </div>
            <div>
                <table id="listaProductosLacteos" class="display" cellspacing="0" >
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
            <button class="btn btn-danger" onclick="modalCancelarVenta()" >Cancelar <span class="glyphicon glyphicon-remove"></span></button>
            <button id="boton" class="btn btn-primary" onclick="accionPrincipal()">Procesar venta <span class="glyphicon glyphicon-cog"></span></button>
        </div>

        <div id="modalProductosVentanilla" class="modal fade in">
            <div  class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Productos Lacteos</h4>
                    </div>
                    <div class="modal-body">
                        <label>Producto a buscar:</label>
                        <input type="text" id="productoBuscar" onkeyup="Auto();" name="productoBuscar" style="background-color: lightgray" class="btn selectCliente">
                        <table id="buscarProductos" name="table" class="display" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>P. Venta</th>
                                    <th>Seleccione</th>
                                </tr>
                            </thead>
                            <tbody id="datos1">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <div id="foo">

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dalog -->
        </div><!-- /.modal -->

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
                            <button class="btn btn-danger" onclick="sinFactura();" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>No factura</button>
                            <button class="btn btn-primary" onclick ="location.href = '../../view/ventas/ventanilla.php';ImprimirFactura();"><span class="glyphicon glyphicon-check"></span>Factura</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dalog -->
        </div><!-- /.modal -->

        <!-- modal que verifica si de verdad desea eliminar todo del carrito de compras -->
        <div id="modalEliminar" class="modal" role="dialog">
            <div  class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon glyphicon-warning-sign" > Advertencia</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div>
                                <h4>¿Desea eliminar el carrito de compras totalmente?</h4>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div id="botonesEliminar">

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dalog -->
        </div><!-- /.modal -->
        <!-- terminacion del carrito  pero de la eliminacion del todo del mismo-->

    </body>
</html>


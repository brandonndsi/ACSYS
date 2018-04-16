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
                <!--<label>Productos:</label>-->
                <table align="center" id="factabla">
                    <thead>
                        <tr>
                            <th>Numero de Proceso</th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Hora</th>
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
                    <button class="btn btn-danger"  data-dismiss="modal" id="facCancelar"><span class="glyphicon glyphicon-remove" ></span> Cerrar</button>
                    <button class="btn btn-primary"  id="facImprimir"><span class="glyphicon glyphicon-check"></span> Imprimir</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dalog -->
</div><!-- /.modal -->
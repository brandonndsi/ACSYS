<!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">

            <!--CSS-->    
            <link rel="stylesheet" href="../../css/jquery.dataTables.css">
            <link rel="stylesheet" href="../../css/menu.css">
            <link rel="stylesheet" href="../../css/bootstrap.min.css" >
           
            <!--Javascript--> 
            <script src="../../js/jquery-1.10.2.js"></script>
            <script src="../../js/bootstrap.min.js"></script>
            <script src="../../js/unidadesJs.js"></script>   
            <script src="../../js/jquery.dataTables.min.js"></script>         
            <script src="../../js/producto/productoVeterinarioJs.js"></script>  
            <script src="../../js/menuJs.js"></script>   

            <script>
                $(document).ready(function () {
                $('[data-toggle="tooltip"]');
                });
            </script>   
        </head>

        <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="mostrarProductoVeterinario()">

            <!-- Import the file menu.php -->
          <?php
            include '../menuView.php';
           ?>
             

                    <div class="col-md-8 col-md-offset-2">
                        <h4>Lista de Productor Veterinarios </h4>  
                    </div>
                    <div>
                        <table id="listaProductos" class="display" cellspacing="0" >
                       
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción </th>
                                    <th>Precio</th>
                                    <th>Dosis</th>
                                    <th>Días de retención de leche</th>
                                    <th>Vía de aplicación</th>
                                    <th>Función</th>
                                    <th>Modificar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="datos">

                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                        </table>  
                       
                    </div>
                      
                
        <!--Comienzan los modales-->
            <div class="modal-footer" id="Registrar">
                 <p><button onclick="modalRegistrarProducto()" class="btn btn-primary">Registrar Producto</button></p>
            </div>
           <!--Modal de modificar socio-->
            <div id="modalModificar" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Modificar Producto</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <form method="post" action='' name="">
                                   <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Código:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="codigo" id="codigo" placeholder="Código"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Nombre:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" name="nombre" id="nombre" placeholder="Nombre"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Descripción:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="descripcion" id="descripcion" placeholder="Descripción"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Precio:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="precio" id="precio" placeholder="Descripción"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Dosis:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="dosis" id="dosis" placeholder="Dosis"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>DRL:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="dias" id="dias" placeholder="Días"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Vía aplicación:</label>
                                        </div>
                                        <div class="col-sm-8">
                                         <p><select class="btn btn-info" style="padding-right:18%;margin-left:2%" id="via" ></select></p></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Función:</label>
                                        </div>
                                        <div class="col-sm-8">
                                          <p><select class="btn btn-info" style="padding-left:1%;margin-left:13%" id="funcion" ></select></p></p>
                                        </div>
                                    </div>
                                        
                                </form>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <div id="botones">
                                
                            </div>
                             <h5>DRL: Días de retención de leche</h5>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dalog -->
            </div><!-- /.modal -->

            <!--Modal de eliminar producto-->
            <div id="modalEliminar" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon glyphicon-warning-sign" > Advertencia</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <h4 >¿Está seguro de eliminar este producto?</h4>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <div id="botonesEliminar">
                                
                            </div>
                            
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dalog -->
            </div><!-- /.modal -->
             <!--Modal de respuesta producto-->
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


            <!--Modal Registrar-->
            <div id="modalRegistrar" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Registrar Producto</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <form method="post" action='' name="">
                                   <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Código:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="codigor" id="codigor" placeholder="Código"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Nombre:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" name="nombrer" id="nombrer" placeholder="Nombre"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Descripción:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="descripcionr" id="descripcionr" placeholder="Descripción"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Precio:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="precior" id="precior" placeholder="Descripción"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Dosis:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="dosisr" id="dosisr" placeholder="Dosis"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>DRL:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="diasr" id="diasr" placeholder="Días"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Vía aplicación:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><select  class="span12" id="viar" ></select></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Función:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><select  class="span12" id="funcionr" ></select></p>
                                        </div>
                                    </div>
                                        
                                </form>
                            </center>
                        </div>
                         <div class="modal-footer">
                            
                            <div id="botonesRegistrar">
                                
                            </div>
                            <h5>DRL: Días de retención de leche</h5>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dalog -->
            </div><!-- /.modal -->
    </body>
</html>


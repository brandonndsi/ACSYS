<!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
             <script src="../../js/jquery-1.10.2.js"></script>
            <!--CSS-->    

           
            <link rel="stylesheet" href="../../css/menu.css">

           
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

            <!--Javascript--> 
   
            <script src="../../js/unidadesJs.js"></script>          
            <script src="../../js/producto/productoLacteoJs.js"></script>  
            <script src="../../js/menuJs.js"></script> 
            <script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.min.js"></script>
            <link rel="stylesheet" type="text/css" href="../../css/jquery.dataTables.min.css">  

            <script>
                $(document).ready(function () {
                $('[data-toggle="tooltip"]');
                });
            </script>   
        </head>

        <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="mostrarProductoLacteo()">

            <!-- Import the file menu.php -->
          <?php
            include '../menuView.php';
           ?>
             

                    <div class="col-md-8 col-md-offset-2">
                        <h4>Lista de Productos Lácteos</h4>  
                    </div>
                    <div>
                        <table id="listaProductos" class="display" cellspacing="0" >
                       
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Precio Unitario </th>
                                    <th>Cantidad</th>
                                    <th>Unidad</th>
                                    <th>Modificar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="datos">

                            </tbody>
                          
                        </table>  
                       
                    </div>
                      
                
        
            <div class="modal-footer" id="Registrar">
                 <p><button onclick="modalRegistrarProducto()" class="btn btn-primary">Registrar Producto</button></p>
            </div>
            <!--Comienzan los modales-->
           <!--Modal de modificar producto-->
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
                                            <label>Precio Unitario:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="precio" id="precio" placeholder="Precio"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Cantidad:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="cantidad" id="cantidad" placeholder="Cantidad"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Unidad:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><select class="btn btn-info" style="padding-right:21%;margin-left:-1,5%" name="unidad" id="unidad" placeholder="Unidad"></select></p>
                                        </div>
                                    </div>
                                </form>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <div id="botones">
                                
                            </div>
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
                                            <label>Precio Unitario:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="precior" id="precior" placeholder="Precio"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Cantidad:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="cantidadr" id="cantidadr" placeholder="Cantidad"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Unidad:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><select class="btn btn-info" style="padding-right:21%;margin-left:-1,5%" name="registrarunidad" id="registrarunidad" placeholder="Unidad"></select></p>
                                        </div>
                                    </div>
                                </form>
                            </center>
                        </div>
                         <div class="modal-footer">
                            <div id="botonesRegistrar">
                                
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dalog -->
            </div><!-- /.modal -->
    </body>
</html>


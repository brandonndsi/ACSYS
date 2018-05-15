<!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
          <!--CSS-->
            <link rel="stylesheet" href="../../css/jquery.dataTables.css">
            <!--<link rel="stylesheet" href="../../css/menu.css">-->
            <link rel="stylesheet" href="../../css/bootstrap.min.css" >
             <!--Javascript-->
             <script src="http://crypto-js.googlecode.com/svn/tags/3.1.2/build/rollups/md5.js"></script>
            <script src="../../js/jquery-3.2.1.js"></script>
            <script src="../../js/jquery.dataTables.js"></script>
            <script src="../../js/menuJs.js"></script>
            <script src="../../js/validacionesJs.js"></script> 
            <script src="../../js/bootstrap.min.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>                
            <script src="../../js/productor/productorClienteJs.js"></script>    

            <script>
                $(document).ready(function () {
                $('[data-toggle="tooltip"]');
                });
            </script>   
        </head>

        <body background="../fondo.jpg" onload="mostrarProductores()">
        <?php
            //include '../menuView.php';
            include '../InterumtorDeMenus.php';
        ?>

            <div class="contenedor" id="contenedor">

            <div class=" row">
                <h4>Lista de Productores Clientes</h4>  
            
                 <p><button onclick="modalRegistrarCliente()" class="btn btn-primary">Registrar Productor</button></p>
            </div>
            <div>
                <table id="listaProductores" class="display" cellspacing="0" >
               
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre Completo</th>
                            <!--<th>Primer Apellido </th>
                            <th>Segundo Apellido</th>-->
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Correo</th>
                            <th>Modificar</th>
                            <th>Ver Imágenes</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="datos">

                    </tbody>
                    <tfoot>
                        
                    </tfoot>
                </table>  
               
            </div>
            
           <!--Modal de modificar socio-->
            <div id="modalModificar" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Modificar Cliente</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <form method="post" action='' name="">
                                   <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Cédula:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12"  name="documentoidentidad" id="documentoidentidad" placeholder="Documento de identidad"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Nombre:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" onkeypress="return soloLetras(event)" name="nombre" id="nombre" placeholder="Nombre"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>1° Apellido:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" onkeypress="return soloLetras(event)" name="primerapellido" id="primerapellido" placeholder="Primer Apellido"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>2° Apellido:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text"  class="span12" onkeypress="return soloLetras(event)" name="segundoapellido" id="segundoapellido" placeholder="Segundo Apellido"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Teléfono:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" onkeypress="return soloNumeros(event)" name="telefono" id="telefono" placeholder="Teléfono"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Dirección:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" name="direccion" id="direccion" placeholder="Dirección"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Email:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" onBlur="correoValidar(this)" name="correo" id="correo" placeholder="Email"></p>
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

            <!--Modal de eliminar socio-->
            <div id="modalEliminar" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon glyphicon-warning-sign" > Advertencia</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <h4 >¿Está seguro de eliminar este socio?</h4>
                            </center>
                        </div>
                        <div class="modal-footer">
                            
                            <div id="botonesEliminar">
                                
                            </div>
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


            <!--Modal Registrar-->
            <div id="modalRegistrar" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Registrar Cliente</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <form method="post" action='' name="">
                                   <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Cédula:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="documentoidentidad" id="documentoidentidadr" placeholder="Documento de identidad"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Nombre:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" onkeypress="return soloLetras(event)" name="nombre" id="nombrer" placeholder="Nombre"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>1° Apellido:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" onkeypress="return soloLetras(event)" name="primerapellido" id="primerapellidor" placeholder="Primer Apellido"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>2° Apellido:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" onkeypress="return soloLetras(event)" name="segundoapellido" id="segundoapellidor" placeholder="Segundo Apellido"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Teléfono:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" onkeypress="return soloNumeros(event)" name="telefono" id="telefonor" placeholder="Teléfono"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Dirección:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" name="direccion" id="direccionr" placeholder="Dirección"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Email:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" onBlur="correoValidar(this)" name="correo" id="correor" placeholder="Email"></p>
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

        </div>
    </body>
</html>

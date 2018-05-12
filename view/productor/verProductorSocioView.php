<!DOCTYPE HTML>
    <html lang="es">
        <head>
           <meta charset="UTF-8">
          <!--CSS-->
            <link rel="stylesheet" href="../../css/jquery.dataTables.css">
            <link rel="stylesheet" href="../../css/menu.css">
            <link rel="stylesheet" href="../../css/bootstrap.min.css" >

             <!--Javascript-->
            <script src="../../js/jquery-3.2.1.js"></script>
            <script src="../../js/jquery.dataTables.js"></script>
            <script src="../../js/menuJs.js"></script>
            <script src="../../js/bootstrap.min.js"></script>
            <script src="../../js/validacionesJs.js"></script>       
            <script src="../../js/productor/productorSocioJs.js"></script>

            <script>
                $(document).ready(function () {
                $('[data-toggle="tooltip"]');
                });
            </script>   
        </head>

        <body background="../fondo.jpg" onload="mostrarProductores()">
              <!-- Import the file menu.php -->
          <?php
            //include '../menuView.php';
            include '../InterumtorDeMenus.php';
           ?>
        <div class="contenedor" id="contenedor">

                    <div class="col-md-8 col-md-offset-2">
                        <h4>Lista de Productores Socios</h4>  
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
                      
                
        <!--Comienzan los modales-->
            <div class="modal-footer" id="Registrar">
                 <p><button onclick="modalRegistrarSocio()" class="btn btn-primary">Registrar Productor</button></p>
            </div>
           <!--Modal de modificar socio-->
            <div id="modalModificar" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Modificar Socio</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <form method="post" action='' name="">
                                   <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Cédula:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" onkeypress="return soloNumeros(event)" name="documentoidentidad" id="documentoidentidad" placeholder="Documento de identidad"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Nombre:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" onkeypress="return soloLetras(event)" name="nombre" onkeypress="return soloLetras(event)" id="nombre" placeholder="Nombre"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>1° Apellido:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" onkeypress="return soloLetras(event)" name="primerapellido" onkeypress="return soloLetras(event)" id="primerapellido" placeholder="Primer Apellido"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>2° Apellido:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" onkeypress="return soloLetras(event)" name="segundoapellido" onkeypress="return soloLetras(event)" id="segundoapellido" placeholder="Segundo Apellido"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Teléfono:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" onkeypress="return soloNumeros(event)" name="telefono" pattern="[0-9]{9}" id="telefono" placeholder="Teléfono" ></p>
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
                                            <p><input type="text" class="span12" name="correo" onBlur="correoValidar(this)"  id="correo" placeholder="Email"></p>
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
                            <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Registrar Socio</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <form method="post" action='' name="">
                                   <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Cédula:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="documentoidentidad" onkeypress="return soloNumeros(event)" id="documentoidentidadr" placeholder="Documento de identidad"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Nombre:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" name="nombre" id="nombrer" placeholder="Nombre"></p>
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
                                            <p><input type="text" class="span12" name="telefono" onkeypress="return soloNumeros(event)" id="telefonor" placeholder="Teléfono"></p>
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
                                            <p><input type="text" class="span12" name="correo" onBlur="correoValidar(this)" id="correor" placeholder="Email"></p>
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


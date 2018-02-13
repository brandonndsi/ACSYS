<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">

        <!--CSS-->    
        <link rel="stylesheet" href="../../css/jquery.dataTables.css">
        <link rel="stylesheet" href="../../css/menu.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!--Javascript--> 
        <script src="../../js/jquery-3.2.1.js"></script>       
        <script src="../../js/jquery.dataTables.js"></script>         
        <script src="../../js/empleado/empleadoJs.js"></script>  
        <script src="../../js/menuJs.js"></script> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]');
            });
        </script>  

    </head>

    <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="mostrarEmpleados()">
        <!-- Import the file menu.php -->
        <?php
        include '../menuView.php';
        ?>
        <div class="col-md-8 col-md-offset-2">
            <h4>Lista de Empleados</h4>  
        </div>

        <div>
            <table id="listaEmpleados" class="display" cellspacing="0" >
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Primer Apellido </th>
                        <th>Segundo Apellido</th>
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
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Primer Apellido </th>
                        <th>Segundo Apellido</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Modificar</th>
                        <th>Ver Imágenes</th>
                        <th>Eliminar</th>
                    </tr>
                </tfoot>
            </table>  
        </div>

        <!--Comienzan los modales-->
        <div id="Registrar" class="modal-footer">
            <p><button onclick="modalRegistrarEmpleado()" class="btn btn-primary">Registrar Empleado</button></p>
        </div>

        <!--Modal Registrar-->
        <div id="modalRegistrar" class="modal" role="dialog">
            <div  class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Registrar Empleado</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div style="width:50%; float:left;">
                                <input type="hidden" name="idpersonaempleador" ><!--este es el campo que está como llave primaria en la base de datos-->    
                                <p class="col-sm-8">Nombre: <input type="text" name="nombrer"  id="nombrer" class="form-control" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})" /></p>                
                                <p class="col-sm-8">1° Apellido: <input type="text" name="primerapellidor" id="primerapellidor" class="form-control" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})"/></p> 
                                <p class="col-sm-8">2° Apellido:<input type="text" name="segundoapellidor" id="segundoapellidor" class="form-control" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})"/></p> 
                                <p class="col-sm-8">Cédula:<input type="text" name="documentoidentidadr" id="documentoidentidadr" class="form-control" required pattern="[0-9]{9}"/></p> 
                                <p class="col-sm-8">Contraseña: <input type="password" name="passwordempleador" id="passwordempleador" class="form-control" required /></p>
                            </div>
                            <div style="width:50%; float:left;">
                                <p class="col-sm-8">Teléfono:<input type="text" name="telefonor" id="telefonor" class="form-control" required pattern="[0-9]{8}" /></p> 
                                <p class="col-sm-8">Dirección: <input type="text" name="direccionr" id="direccionr" class="form-control"required /></p>
                                <p class="col-sm-8">Email:<input type="email" name="correor" id="correor" class="form-control" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required /></p> 
                                <p class="col-sm-8">Tipo de Empleado: 
                                    <select name = "tipoempleador" id ="tipoempleador" class="form-control">
                                        <option></option>
                                        <option value = "Administrador">Administrador/a</option>
                                        <option value = "Bodega">Bodega/a</option>
                                        <option value = "Cajero">Cajero/a</option>
                                    </select> </p>
                            </div> 
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div id="botonesRegistrar">

                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dalog -->
        </div><!-- /.modal -->

        <!--Modal de modificar empleado-->
        <div id="modalModificar" class="modal" role="dialog">
            <div  class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Modificar Empleado</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div style="width:50%; float:left;">
                                <input type="hidden" name="idpersonaempleadom" ><!--este es el campo que está como llave primaria en la base de datos-->    
                                <p class="col-sm-8">Nombre: <input type="text" name="nombrem"  id="nombrem" class="form-control" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})" /></p>                
                                <p class="col-sm-8">1° Apellido: <input type="text" name="primerapellidom" id="primerapellidom" class="form-control" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})"/></p> 
                                <p class="col-sm-8">2° Apellido:<input type="text" name="segundoapellidom" id="segundoapellidom" class="form-control" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})"/></p> 
                                <p class="col-sm-8">Cédula:<input type="text" name="documentoidentidadm" id="documentoidentidadm" class="form-control" required pattern="[0-9]{9}"/></p> 
                            </div>
                            <div style="width:50%; float:left;">
                                <p class="col-sm-8">Teléfono:<input type="text" name="telefonom" id="telefonom" class="form-control" required pattern="[0-9]{8}" /></p> 
                                <p class="col-sm-8">Dirección: <input type="text" name="direccionm" id="direccionm" class="form-control"required /></p>
                                <p class="col-sm-8">Email:<input type="email" name="correom" id="correom" class="form-control" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required /></p> 
                                <p class="col-sm-8">Tipo de Empleado: <input type="text" name="tipoempleadom" id="tipoempleadom" class="form-control"required /></p>
                            </div> 
                        </form>
                    </div>
                    <div class="modal-footer">
                        <div id="botones">

                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dalog -->
        </div><!-- /.modal -->

        <!--Modal de eliminar empleado-->
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
                                <h4>¿Desea eliminar este empleado?</h4>       
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

        <!--Modal de respuesta empleado-->
        <div id="modalRespuesta" class="modal fade in">
            <div  class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon-ok-circle" > Confirmación</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <div id="mensaje"></div>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <p>
                            <button data-dismiss='modal' class="btn btn-danger">Cerrar</button> 
                        </p>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dalog -->
        </div><!-- /.modal -->

    </body>
</html>


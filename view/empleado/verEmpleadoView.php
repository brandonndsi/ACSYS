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
            <div  class="modal-dialog" role="document">
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
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Cédula:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="documentoidentidadr" id="documentoidentidadr" placeholder="Cédula" required pattern="[0-9]{9}"/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Nombre:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text"  class="form-control" class="span12" name="nombrer"  id="nombrer" placeholder="Nombre" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})" /></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>1° Apellido:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="primerapellidor" id="primerapellidor" placeholder="1° Apellido" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})"/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>2° Apellido:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="segundoapellidor" id="segundoapellidor" placeholder="2° Apellido" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})"/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Email:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="email" class="form-control" class="span12" name="correor" id="correor" placeholder="Email" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required /></p>
                                    </div>
                                </div>
                            </div>
                            <div style="width:50%; float:left;">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Teléfono:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="telefonor" id="telefonor" placeholder="Teléfono" required pattern="[0-9]{8}" /></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Dirección:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="direccionr" id="direccionr" placeholder="Dirección" required /></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Contraseña:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><select class="btn btn-info" class="form-control" class="span12" style="padding-right:21%;margin-left:-1,5%" name = "passwordempleador" id ="passwordempleador" placeholder="Contraseña" required>
                                          <option value = "asoprolesa">.......default.......</option>
                                      </select> </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Tipo de Empleado:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><select class="btn btn-info" class="form-control" class="span12" style="padding-right:21%;margin-left:-1,5%" name = "tipoempleador" id ="tipoempleador">
                                                <option></option>
                                                <option value = "Administrador">Administrador/a</option>
                                                <option value = "Bodega">Bodega/a</option>
                                                <option value = "Cajero">Cajero/a</option>
                                            </select> </p>
                                    </div>
                                </div>
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
            <div  class="modal-dialog" role="document">
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
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Cédula:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="documentoidentidadm" id="documentoidentidadm" placeholder="Cédula" required pattern="[0-9]{9}"/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Nombre:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text"  class="form-control" class="span12" name="nombrem"  id="nombrem" placeholder="Nombre" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})" /></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>1° Apellido:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="primerapellidom" id="primerapellidom" placeholder="1° Apellido" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})"/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>2° Apellido:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="segundoapellidom" id="segundoapellidom" placeholder="2° Apellido" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})"/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Email:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="email" class="form-control" class="span12" name="correom" id="correom" placeholder="Email" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required /></p>
                                    </div>
                                </div>
                            </div>
                            <div style="width:50%; float:left;">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Teléfono:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="telefonom" id="telefonom" placeholder="Teléfono" required pattern="[0-9]{8}" /></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Dirección:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="direccionm" id="direccionm" placeholder="Dirección" required /></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Contraseña:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><select class="btn btn-info" class="form-control" class="span12" style="padding-right:21%;margin-left:-1,5%" name = "passwordempleadom" id ="passwordempleadom" placeholder="Contraseña" required><p>
                                                <option value="pass">La misma</option>
                                                <option value = "asoprolesa">.......default.......</option>
                                            </select></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Tipo de Empleado:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><select class="btn btn-info" class="form-control" class="span12" style="padding-right:21%;margin-left:-1,5%" name = "tipoempleadom" id ="tipoempleadom">
                                                <option value = "Administrador">Administrador/a</option>
                                                <option value = "Bodega">Bodega/a</option>
                                                <option value = "Cajero">Cajero/a</option>
                                            </select> </p>
                                    </div>
                                </div>
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

<!DOCTYPE html>
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
        <script src="../../js/empleado/empleadoJs.js"></script>
        <script src="../../js/menuJs.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]');
            });
        </script>

    </head>

    <body background="../fondo.jpg" onload="mostrarEmpleados()">
        <!-- Import the file menu.php -->
        <?php
        // include '../menuView.php';
        include '../InterumtorDeMenus.php';
        ?>
        

        <div class="contenedor">
            <div class="col-md-12 col-md-offset-2">
            <h4>Lista de Empleados</h4>
            </div>

            <table id="listaEmpleados" class="display" cellspacing="0" >
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre completo</th>
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
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Cédula:
                                            <a id="icon">
                                                <span class='glyphicon-asterisk' style= 'color:red'></span>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="documentoidentidadr" id="documentoidentidadr" placeholder="Cédula" onkeyup="validarCamposCedula()" required pattern="[0-9]{9}"
                                        onchange="verificarQueSeanQuinceDijitos(this.id);"
                                        required maxlength="15"/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Nombre:
                                            <a id="icon2">
                                                <span class='glyphicon-asterisk' style= 'color:red'></span>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text"  class="form-control" class="span12" name="nombrer"  id="nombrer" placeholder="Nombre" onkeyup="validarCamposNombre()" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})" /></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>1°Apellido:
                                            <a id="icon3">
                                                <span class='glyphicon-asterisk' style= 'color:red'></span>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="primerapellidor" id="primerapellidor" placeholder="1° Apellido" onkeyup="validarCamposApellido()" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})"/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>2°Apellido:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="segundoapellidor" id="segundoapellidor" placeholder="2° Apellido" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})"/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Email:</label>
                                    </div>
                                    <div class="col-sm-8">
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
                                        <label>Dirección:
                                            <a id="icon4">
                                                <span class='glyphicon-asterisk' style= 'color:red'></span>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="direccionr" id="direccionr" placeholder="Dirección" onkeyup="validarCamposDireccion()" required /></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Contraseña:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" name="passwordempleador" id="passwordempleador" placeholder="Default" value = "asoprolesa" readonly/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Tipo de Empleado:
                                            <a id="icon5">
                                                <span class='glyphicon-asterisk' style= 'color:red'></span>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><select class="form-control" class="span12" style="padding-right:0%;margin-left:-1,5%" name = "tipoempleador" id ="tipoempleador" onchange="validarCamposTipo(this.value)">
                                                <option></option>
                                                <option value = "Administrador">Administrador</option>
                                                <option value = "Bodega">Bodega</option>
                                                <option value = "Cajero">Cajera</option>
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
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Cédula:
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="documentoidentidadm" id="documentoidentidadm" placeholder="Cédula" onkeyup="validarCamposCedulam()" required pattern="[0-9]{9}"/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Nombre:
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text"  class="form-control" class="span12" name="nombrem"  id="nombrem" placeholder="Nombre"  onkeyup="validarCamposNombrem()" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})" /></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>1° Apellido:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="primerapellidom" id="primerapellidom" placeholder="1° Apellido" onkeyup="validarCamposApellidom()" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})"/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>2° Apellido:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="segundoapellidom" id="segundoapellidom" placeholder="2° Apellido" required pattern="([a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,25})"/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Email:
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="email" class="form-control" class="span12" name="correom" id="correom" placeholder="Email" onkeyup="validarCamposEmailm()" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required /></p>
                                    </div>
                                </div>
                            </div>
                            <div style="width:50%; float:left;">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Teléfono:
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="telefonom" id="telefonom" placeholder="Teléfono" onkeyup="validarCamposTelefonom()" required pattern="[0-9]{8}" /></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Dirección:
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="direccionm" id="direccionm" onkeyup="validarCamposDireccionm()" placeholder="Dirección" required /></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Contraseña:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><select class="form-control" class="span12" style="padding-right:21%;margin-left:-1,5%" name = "passwordempleadom" id ="passwordempleadom" placeholder="Contraseña" required><p>
                                                <option value="pass">La misma</option>
                                                <option value = "asoprolesa">.......Default.......</option>
                                            </select></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Tipo de Empleado:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><select class="form-control" class="span12" style="padding-right:21%;margin-left:-1,5%" name = "tipoempleadom" id ="tipoempleadom">
                                                <option value = "Administrador">Administrador</option>
                                                <option value = "Bodega">Bodega</option>
                                                <option value = "Cajero">Caja</option>
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

    </body>
</html>

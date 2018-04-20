<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">

        <!--CSS-->
        <link rel="stylesheet" href="../../css/menu.css">
        <link rel="stylesheet" href="../../css/bootstrap.min.css" >
        <!--Javascript-->
        <script src="../../js/jquery-3.2.1.js"></script>
        <script src="../../js/perfil/perfilJS.js"></script>
        <script src="../../js/menuJs.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </head>

    <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%">
        <!-- Import the file menu.php -->
        <?php
        //include '../menuView.php';
        include '../InterumtorDeMenus.php';
        ?>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2 toppad" >
                    <form method="post">        
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-8" >
                                    <div class="col-sm-12">
                                        <h3>Datos Personales:</h3>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label>Nombre:</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><input type="text" class="form-control" name="nombrepersonae" id="nombrepersonae" value="<?php echo $_SESSION['nombre'] ?>" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label>Primer Apellido:</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><input type="text" class="form-control" name="apellido1personae" id="apellido1personae" value="<?php echo $_SESSION['primerApellido'] ?>" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label>Segundo Apellido:</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><input type="text" class="form-control" name="apellido2personae" id="apellido2personae" value="<?php echo $_SESSION['segundoApellido'] ?>"readonly></p>
                                        </div> 
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-sm-12">
                                        <h3>Datos del Sistema:</h3>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label>Telefono:</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><input type="text" class="form-control" name="telefonopersonae" id="telefonopersonae" value="<?php echo $_SESSION['telefono'] ?>" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label>Email:</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><input type="email" class="form-control" name="correopersonae" id="correopersonae" value="<?php echo $_SESSION['email'] ?>" readonly></p>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label>Contraseña:</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="button" class="btn btn-primary btn-sm" onclick="modalModificarContrasenia()" name="editar" id="editar" value="Editar"/>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>    
            </div>
        </div>

        <!--Modal cambio de contrasenia-->
        <div id="modalPassword" class="modal fade in">
            <div  class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon-ok-circle" > Cambiar Contraseña:</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="idpersonaempleado" id="idpersonaempleado" value="<?php echo $_SESSION['id'] ?>"><!--este es el campo que está como llave primaria en la base de datos-->
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Contraseña Actual:</label>
                            </div>
                            <div class="col-sm-5">
                                <p><input type="password" class="form-control" name="passwordempleadoa" id="passwordempleadoa" onkeyup="validarContraNueva()"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Nueva Contraseña:</label>
                            </div>
                            <div class="col-sm-5">
                                <p><input type="password" class="form-control" name="passwordempleadon" id="passwordempleadon" onkeyup="validarContraseniaNueva()"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Confirmar Contraseña:</label>
                            </div>
                            <div class="col-sm-5">
                                <p><input type="password" class="form-control" name="passwordempleadoc" id="passwordempleadoc" onkeyup="validarContraseniaNueva()"></p>  
                            </div> <br><br><br><br>
                            <div id="icon"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div id="botonesEditar">

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dalog -->
        </div><!-- /.modal -->

    </body>
</html>

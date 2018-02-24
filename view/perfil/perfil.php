<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">

        <!--CSS-->
        <link rel="stylesheet" href="../../css/menu.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!--Javascript-->
        <script src="../../js/jquery-3.2.1.js"></script>
        <script src="../../js/perfil/perfilJs.js"></script>
        <script src="../../js/menuJs.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    </head>

    <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%">
        <!-- Import the file menu.php -->
        <?php
        include '../menuView.php';
        ?>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
                    <div class="panel panel-info">
                        <form method="post">
                            <div class="tab-content">
                                <div class="row">
                                    <div style="width:50%; float:left;">
                                        <div class="col-md-8" >
                                            <div class="col-sm-12">
                                                <h4>Información</h4>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="col-sm-3">
                                                    <label>Nombre:</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <p><input type="text" class="form-control" name="nombre" id="nombre" readonly></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-3">
                                                    <label>Telefono:</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <p><input type="text" class="form-control" name="telefono" id="telefono" readonly></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-3">
                                                    <label>Email:</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <p><input type="email" class="form-control" name="email" id="email" readonly></p>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="width:50%; float:left;">
                                        <div class="col-md-12">
                                            <div class="col-sm-12">
                                                <h4>Cambio de Contraseña</h4>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="col-sm-3">
                                                    <label>Contraseña:</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <p><input type="password" class="form-control" name="pass" id="pass"></p>
                                                </div> 
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8">
                                                    <label>Nueva Contraseña:</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <p><input type="password" class="form-control" name="nuevapass" id="nuevapass"></p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-11">
                                                    <label>Confirmar Contraseña:</label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <p><input type="password" class="form-control" name="confipass" id="confipass"></p>
                                                </div> 
                                            </div>
                                            <div class="pull-right">
                                                <input type="button" class="btn btn-warning btn-sm" name="actualizar" id="actualizar" value="Actualizar"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>    
            </div>
        </div>

    </body>
</html>

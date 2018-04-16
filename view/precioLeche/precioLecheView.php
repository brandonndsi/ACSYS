<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">

        <!--CSS-->
        <link rel="stylesheet" href="../../css/menu.css">
        <link rel="stylesheet" href="../../css/bootstrap.min.css" >
        <!--Javascript-->
        <script src="../../js/jquery-3.2.1.js"></script>
        <script src="../../js/precioLeche/precioLecheJS.js"></script>
        <script src="../../js/menuJs.js"></script>
        <script src="../../js/bootstrap.min.js"></script>

    </head>

    <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="verPrecio()">
        <!-- Import the file menu.php -->
        <?php
        include '../menuView.php';
        ?>

        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2 toppad" >
                    <form method="post">        
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-8" >
                                    <div class="col-sm-12">
                                        <h3>Precio de Leche Vigente:</h3>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <input type="hidden" name="idpreciolitroleche" id="idpreciolitroleche" >
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label>Precio Vigente:</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><input type="text" class="form-control" name="vigente" id="vigente" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label>Fecha ultima Actualizaci&oacute;n:</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><input type="text" class="form-control" name="fecha" id="fecha" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label>Nuevo Precio:</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><input type = "number" step = "any" min="0" class="form-control" name="precioactualizado" id="precioactualizado"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-5">
                                            <label>Actualizar:</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="button" class="btn btn-primary btn-sm" onclick="ActualizarPrecio()" name="editar" id="editar" value="Actualizar"/>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>    
            </div>
        </div>

        <!--Modal de respuesta-->
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

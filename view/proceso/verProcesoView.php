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
        <script src="../../js/proceso/procesoJS.js"></script>
        <script src="../../js/menuJs.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]');
            });
        </script>

    </head>

    <body background="../fondo.jpg" onload="mostrarProcesos();">
        <!-- Import the file menu.php -->
        <?php
        include '../InterumtorDeMenus.php';
        ?>
        <div class="contenedor">
            <div class="row">
                <h4>Lista de Procesos</h4> 
                <label>Buscar por Fecha </label> <input type="date" id="fecha" class="form-control-static" autocomplete="on" value="<?PHP echo date('Y-m-d'); ?>"step="1" min="2017-12-30" max="<?PHP echo date('Y-m-d'); ?>">
                <input type="submit" id="procesar" class="btn btn-primary" value="Cargar Busqueda" onclick="buscarPorFecha();">
                <input type="submit" id="todo" class="btn btn-primary" value="Mostrar Todo" onclick="mostrarProcesos();">
            </div>
            <div>
                <table id="listaProcesos" class="display" cellspacing="0" >
                    <thead>
                        <tr>
                            <th>Numero de Proceso </th>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Hora </th>                     
                            <th>Estado</th>
                            <th>Ver Proceso</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="datos">

                    </tbody>
                </table>
            </div>
        </div>

        <!--Modal de ver procesos-->
        <div id="modalVer" class="modal fade in">
            <div  class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Detalle del Proceso</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <form method="post">
                                <div style="width:50%; float:left;">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Producto:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="productov" id="productov" placeholder="Producto" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Cantidad:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="cantidadv" id="cantidadv" placeholder="Cantidad" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>% Grasa:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="porcentajev" id="porcentajev" placeholder="%" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Entera:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="lecheEnterav" id="lecheEnterav" placeholder="Leche Entera" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Descremada:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="lecheDescremadav" id="lecheDescremadav" placeholder="Leche Descremada" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Cuajo:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="cuajov" id="cuajov" placeholder="Cuajo" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Cloruro:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="clorurov" id="clorurov" placeholder="Cloruro de Calcio" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Sal:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="salv" id="salv" placeholder="Sal" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Cultivo Codigo:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="cultivoCodigov" id="cultivoCodigov" placeholder="Cultivo Codigo" readonly></p>
                                        </div>
                                    </div>
                                </div>
                                <div style="width:50%; float:left;">   
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Estabilizador:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="estabilizadorCodigov" id="estabilizadorCodigov" placeholder="Estabilizador Codigo" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Colorante:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="colorateprocesov" id="colorateprocesov" placeholder="Colorante" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Crema #1:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="cremaproceso1v" id="cremaproceso1v" placeholder="Crema #1" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Leche #1:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="lecheproceso1v" id="lecheproceso1v" placeholder="Leche #1" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Crema #2:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="cremaproceso2v" id="cremaproceso2v" placeholder="Crema #2" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Leche #2:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="lecheproceso2v" id="lecheproceso2v" placeholder="Leche #2" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Hora:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="horaprocesov" id="horaprocesov" placeholder="Hora" readonly></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Fecha:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="form-control" class="span12" name="fechaprocesov" id="fechaprocesov" placeholder="Fecha" readonly></p>
                                        </div>
                                    </div>
                                </div>                     
                            </form>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <div id="botonesVer">

                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dalog -->
        </div><!-- /.modal -->


    </body>
</html>

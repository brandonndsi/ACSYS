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

        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]');
            });
        </script>

    </head>

    <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="mostrarProcesos(); consultarProduct();">
        <!-- Import the file menu.php -->
        <?php
        include '../menuView.php';
        ?>
        <div class="col-md-8 col-md-offset-2">
            <h4>Lista de Procesos</h4>
        </div>

        <div>
            <table id="listaProcesos" class="display" cellspacing="0" >
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora </th>
                        <th>Producto</th>
                        <th>Cantidad </th>
                        <th>% Grasa</th>
                        <th>Codigo Cultivo </th>
                        <th>Modificar</th>
                        <th>Ver Proceso</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="datos">

                </tbody>
            </table>
        </div>

        <!--Comienzan los modales-->
        <div id="Registrar" class="modal-footer">
            <p><button onclick="modalRegistrarProceso()" class="btn btn-primary">Nuevo Proceso </button></p>
        </div>

        <!--Modal Registrar-->
        <div id="modalRegistrar" class="modal" role="dialog">
            <div  class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Registro De Procesos</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div style="width:50%; float:left;">
                                <input type="hidden" name="idprocesor" >
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Producto:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><select id="selectproductor" class="form-control" class="btn btn-info selectproductor" placeholder="Producto">
                                            </select></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Cantidad:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="cantidadr" id="cantidadr" placeholder="Cantidad kg" required></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>% Grasa:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="porcentajer" id="porcentajer" placeholder="% de grasa leche entera" required ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Entera:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="lecheEnterar" id="lecheEnterar" placeholder="Leche Entera kg" required ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Descremada:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="lecheDescremadar" id="lecheDescremadar" placeholder="Leche Descremada kg" required></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Cuajo:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="cuajor" id="cuajor" placeholder="Cuajo ml" required></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Cloruro:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="cloruror" id="cloruror" placeholder="Cloruro de Calcio ml" required></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Sal:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="salr" id="salr" placeholder="Sal" required></p>
                                    </div>
                                </div>
                            </div>
                            <div style="width:50%; float:left;">   
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Estabilizador:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="estabilizadorCodigor" id="estabilizadorCodigor" placeholder="Estabilizador Codigo kg" required></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Colorante:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="colorateprocesor" id="colorateprocesor" placeholder="Colorante n" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Crema #1:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="cremaproceso1r" id="cremaproceso1r" placeholder="Crema #1" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Leche #1:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="lecheproceso1r" id="lecheproceso1r" placeholder="Leche #1" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Crema #2:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="cremaproceso2r" id="cremaproceso2r" placeholder="Crema #2" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Leche #2:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="lecheproceso2r" id="lecheproceso2r" placeholder="Leche #2" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Cultivo Codigo:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="cultivoCodigor" id="cultivoCodigor" placeholder="Cultivo Codigo" ></p>
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

        <!--Modal de modificar-->
        <div id="modalModificar" class="modal" role="dialog">
            <div  class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Modificar Proceso</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div style="width:50%; float:left;">
                                <input type="hidden" name="idprocesor" >
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Producto:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="productom" id="productom" placeholder="Producto" readonly ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Cantidad:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="cantidadm" id="cantidadm" placeholder="Cantidad kg" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>% Grasa:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="porcentajem" id="porcentajem" placeholder="% de grasa leche entera"  ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Entera:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="lecheEnteram" id="lecheEnteram" placeholder="Leche Entera kg"  ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Descremada:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="lecheDescremadam" id="lecheDescremadam" placeholder="Leche Descremada kg" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Cuajo:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="cuajom" id="cuajom" placeholder="Cuajo ml" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Cloruro:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="clorurom" id="clorurom" placeholder="Cloruro de Calcio ml" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Sal:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="salm" id="salm" placeholder="Sal" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Cultivo Codigo:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="cultivoCodigom" id="cultivoCodigom" placeholder="Cultivo Codigo" ></p>
                                    </div>
                                </div>
                            </div>
                            <div style="width:50%; float:left;">   
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Estabilizador:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="estabilizadorCodigom" id="estabilizadorCodigom" placeholder="Estabilizador Codigo kg" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Colorante:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="colorateprocesom" id="colorateprocesom" placeholder="Colorante n" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Crema #1:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="cremaproceso1m" id="cremaproceso1m" placeholder="Crema #1" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Leche #1:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="lecheproceso1m" id="lecheproceso1m" placeholder="Leche #1" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Crema #2:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="cremaproceso2m" id="cremaproceso2m" placeholder="Crema #2" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Leche #2:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type = "number" step = "any" min="0" class="form-control" class="span12" name="lecheproceso2m" id="lecheproceso2m" placeholder="Leche #2" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Hora:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="time" class="form-control" class="span12" name="horaprocesom" id="horaprocesom" placeholder="Hora" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Fecha:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="date" class="form-control" class="span12" name="fechaprocesom" id="fechaprocesom" placeholder="Fecha" ></p>
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

        <!--Modal de eliminar-->
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
                                <h4>¿Desea eliminar este proceso?</h4>
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

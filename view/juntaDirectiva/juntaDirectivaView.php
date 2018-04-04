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
        <script src="../../js/juntaDirectiva/juntaDirectivaJS.js"></script>
        <script src="../../js/menuJs.js"></script>
        <script src="../../js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]');
            });
        </script>

    </head>

    <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="mostrarJuntaDirectiva(); verProductor();">
        <!-- Import the file menu.php -->
        <?php
        include '../menuView.php';
        ?>
        <div class="col-md-8 col-md-offset-2">
            <h4>Lista de Juntas Directivas</h4>
        </div>

        <div>
            <table id="listaJuntas" class="display" cellspacing="0" >
                <thead>
                    <tr>
                        <th>Inicio de Periodo</th>
                        <th>Final de periodo </th>
                        <th>Modificar</th>
                        <th>Ver Miembros</th>
                    </tr>
                </thead>
                <tbody id="datos">

                </tbody>
            </table>
        </div>

        <!--Comienzan los modales-->
        <div id="Registrar" class="modal-footer">
            <p><button onclick="modalRegistrarJunta()" class="btn btn-primary">Nueva Junta </button></p>
        </div>

        <!--Modal Registrar-->
        <div id="modalRegistrar" class="modal" role="dialog">
            <div  class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Registrar Junta Directiva</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >
                        <div style="width:50%; float:left;">
                            <input type="hidden" name="idjuntadirectivar" ><!--este es el campo que está como llave primaria en la base de datos-->
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <label>Presidente:
                                        <a id="icon">
                                            <span class='glyphicon-asterisk' style= 'color:red'></span>
                                        </a>
                                    </label>
                                </div>
                                <div class="col-sm-6">
                                    <p><select class="btn btn-info" class="form-control"  name = "presidenter" id ="presidenter" onchange="validarCamposPresidente(this.value);" >
                                        </select></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <label>Vicepresidente:
                                        <a id="icon2">
                                            <span class='glyphicon-asterisk' style= 'color:red'></span>
                                        </a></label>
                                </div>
                                <div class="col-sm-6">
                                    <p><select class="btn btn-info" class="form-control" name = "vicepresidenter" id ="vicepresidenter" onchange="validarVicepresidente(this.value)">
                                        </select></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <label>Secretario:
                                        <a id="icon3">
                                            <span class='glyphicon-asterisk' style= 'color:red'></span>
                                        </a></label>
                                </div>
                                <div class="col-sm-6">
                                    <p><select class="btn btn-info" class="form-control" name = "secretarior" id ="secretarior" onchange="validarCamposSecretario(this.value)">
                                        </select></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <label>Tesorero:
                                        <a id="icon4">
                                            <span class='glyphicon-asterisk' style= 'color:red'></span>
                                        </a></label>
                                </div>
                                <div class="col-sm-6">
                                    <p><select class="btn btn-info" class="form-control" name = "tesoreror" id ="tesoreror" onchange="validarCamposTesorero(this.value)">
                                        </select></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <label>Fiscal:
                                        <a id="icon5">
                                            <span class='glyphicon-asterisk' style= 'color:red'></span>
                                        </a></label>
                                </div>
                                <div class="col-sm-6">
                                    <p><select class="btn btn-info" class="form-control" name = "fiscalr" id ="fiscalr" onchange="validarCamposFiscal(this.value)">
                                        </select></p>
                                </div>
                            </div>
                        </div>
                        <div style="width:50%; float:left;">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <label>Vocal 1:
                                        <a id="icon6">
                                            <span class='glyphicon-asterisk' style= 'color:red'></span>
                                        </a></label>
                                </div>
                                <div class="col-sm-8">
                                    <p><select class="btn btn-info" class="form-control" name = "vocal1r" id ="vocal1r" onchange="validarCamposVocal1(this.value)">
                                        </select></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <label>Vocal 2:
                                        <a id="icon7">
                                            <span class='glyphicon-asterisk' style= 'color:red'></span>
                                        </a></label>
                                </div>
                                <div class="col-sm-8">
                                    <p><select class="btn btn-info" class="form-control" name = "vocal2r" id ="vocal2r" onchange="validarCamposVocal2(this.value)">
                                        </select></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <label>Inicio:
                                        <a id="icon8">
                                            <span class='glyphicon-asterisk' style= 'color:red'></span>
                                        </a></label>
                                </div>
                                <div class="col-sm-7">
                                    <p><input type="date" class="form-control" name="fechainicioperiodor" id="fechainicioperiodor" onchange="validarCamposInicio()"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <label>Final:
                                        <a id="icon9">
                                            <span class='glyphicon-asterisk' style= 'color:red'></span>
                                        </a></label>
                                </div>
                                <div class="col-sm-7">
                                    <p><input type="date" class="form-control" name="fechafinalperiodor" id="fechafinalperiodor" onchange="validarCamposFinal()"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div id="botonesRegistrar">

                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dalog -->
        </div><!-- /.modal -->

        <!--Modal de modificar Junta-->
        <div id="modalModificar" class="modal" role="dialog">
            <div  class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Modificar Junta Directiva</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div style="width:50%; float:left;">
                                <input type="hidden" name="idjuntadirectivam" ><!--este es el campo que está como llave primaria en la base de datos-->
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Presidente:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="presidentem" id="presidentem" placeholder="Presidente"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Vicepresidente:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="vicepresidentem" id="vicepresidentem" placeholder="Vicepresidente" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Secretario:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="secretariom" id="secretariom" placeholder="Secretario" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Tesorero:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="tesorerom" id="tesorerom" placeholder="Tesorero" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Fiscal:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="fiscalm" id="fiscalm" placeholder="Fiscal" ></p>
                                    </div>
                                </div>
                            </div>
                            <div style="width:50%; float:left;">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Vocal 1:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="vocal1m" id="vocal1m" placeholder="Vocal 1" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Vocal 2:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="vocal2m" id="vocal2m" placeholder="Vocal 2" ></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Inicio:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="date" class="form-control" class="span12" name="fechainicioperiodom" id="fechainicioperiodom"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Final:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="date" class="form-control" class="span12" name="fechafinalperiodom" id="fechafinalperiodom"></p>
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

        <!--Modal de ver miembros de Junta-->
        <div id="modalVer" class="modal fade in">
            <div  class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Junta Directiva</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <form method="post">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Presidente:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="presidentev" id="presidentev" placeholder="Presidente" readonly></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Vicepresidente:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="vicepresidentev" id="vicepresidentev" placeholder="Vicepresidente" readonly></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Secretario:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="secretariov" id="secretariov" placeholder="Secretario" readonly></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Tesorero:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="tesorerov" id="tesorerov" placeholder="Tesorero" readonly></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Fiscal:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="fiscalv" id="fiscalv" placeholder="Fiscal" readonly></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Vocal 1:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="vocal1v" id="vocal1v" placeholder="Vocal 1" readonly></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label>Vocal 2:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="vocal2v" id="vocal2v" placeholder="Vocal 2" readonly></p>
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

        <!--Modal de respuesta junta-->
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

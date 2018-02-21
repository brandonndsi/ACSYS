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
        <script src="../../js/juntaDirectiva/juntaDirectivaJS.js"></script>
        <script src="../../js/menuJs.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]');
            });
        </script>

    </head>

    <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="mostrarJuntaDirectiva()">
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
                        <th>ID </th>
                        <th>Inicio de Periodo</th>
                        <th>Final de periodo </th>
                        <th>Modificar</th>
                        <th>Ver Miembros</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody id="datos">

                </tbody>
                <tfoot>
                    <tr>
                      <th>ID </th>
                      <th>Inicio de Periodo</th>
                      <th>Final de periodo </th>
                      <th>Modificar</th>
                      <th>Ver Miembros</th>
                      <th>Eliminar</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!--Comienzan los modales-->
        <div id="Registrar" class="modal-footer">
            <p><button onclick="modalRegistrarJunta()" class="btn btn-primary">Registrar Junta Directiva</button></p>
        </div>



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

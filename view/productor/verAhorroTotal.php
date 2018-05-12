<!DOCTYPE html>
    <html lang="es">
        <head>
           <meta charset="UTF-8">
          <!--CSS-->
            <link rel="stylesheet" href="../../css/jquery.dataTables.css">
            <!--<link rel="stylesheet" href="../../css/menu.css">-->
            <link rel="stylesheet" href="../../css/bootstrap.min.css" >

             <!--Javascript-->
            <script src="../../js/jquery-3.2.1.js"></script>
            <script src="../../js/jquery.dataTables.js"></script>
            <script src="../../js/menuJs.js"></script>
            <script src="../../js/bootstrap.min.js"></script>
                  
            <script src="../../js/productor/ahorroJs.js"></script>

            <script>
                $(document).ready(function () {
                $('[data-toggle="tooltip"]');
                });
            </script>   
        </head>

        <body background="../fondo.jpg" onload="mostrarAhorroTotal()">

            <!-- Import the file menu.php -->
          <?php
            //include '../menuView.php';
            include '../InterumtorDeMenus.php';
           ?>
             
             <div class="contenedor" id="contenedor">
                    <div class="col-md-8 col-md-offset-2">
                        <h4>Ahorro Total de Productores</h4>  
                    </div>
                    <div>
                        <table id="listaProductores" class="display" cellspacing="0" >
                       
                            <thead>
                                <tr>
                                    <th>Cédula</th>
                                    <th>Nombre Completo</th>
                                    <th>Monto de Ahorro Total</th>
                                    <th>Pagar</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="datos">

                            </tbody>
                            <tfoot>
                                
                            </tfoot>
                        </table>  
                       
                    </div>
                      
                
        <!--Comienzan los modales-->
             <!--Modal de respuesta socio-->
            <div id="modalConfirmacion" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon-ok-circle" > Confirmación</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <h1>¿Esta seguro de pagar el ahorro?</h1>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <div id="botones"></div>
                            
                           
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dalog -->
            </div><!-- /.modal -->

            <!--Modal de respuesta socio-->
            <div id="modalRespuesta" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon-ok-circle" > Confirmación</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <div id="mensaje"></div>
                            </center>
                        </div>
                        <div class="modal-footer">
                            
                            <p><button data-dismiss='modal' class="btn btn-danger">Cerrar</button> </p>
                           
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dalog -->
            </div><!-- /.modal -->
         
         </div>

    </body>
</html>


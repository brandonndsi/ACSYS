<!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UTF-8">
          <!--CSS-->
               <link rel="stylesheet" href="../../css/jquery.dataTables.css">
          <!--<link rel="stylesheet" href="../../css/menu.css">-->
          <link rel="stylesheet" href="../../css/recepcionLeche.css">
            <link rel="stylesheet" href="../../css/bootstrap.min.css" >
          <link rel="stylesheet" href="../../css/ventaVeterinaria.css">
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

             <!--Javascript-->
             <script src="../../js/jquery-3.2.1.js"></script>
              <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
              <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
              <script src="../../js/jquery.dataTables.js"></script>
              <script src="../../js/menuJs.js"></script>
               <script src="../../js/bootstrap.min.js"></script>
            <script src="../../js/productor/recepcionLecheJs.js"></script>    

            <script>
            $( function() {
              $( "#fecha" ).datepicker({
                dateFormat:'dd/mm/yy',
                maxDate:'+0d',
              });
              d=new Date();
              document.getElementById("fecha").value=d.getDate()+"/"+(d.getMonth()+1)+"/"+d.getFullYear();
            } );
            
          </script>  
        </head>

        <body background="../fondo.jpg"  onload="mostrarRecepcion();">
        <?php
            //include '../menuView.php';
            include '../InterumtorDeMenus.php';
           ?>
            <div class="contenedor" id="contenedor">
           <center><input type="text" id="fecha"  class="btn" readonly="readonly"><button style="margin-left: 10px"  class="btn" onclick="mostrarRecepcion();">Cargar datos</button></center>
            <div>
                <table id="listaProductores" class="display" cellspacing="0" >
               
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Peso Turno Mañana </th>
                            <th>Peso Turno Tarde </th>
                            <th>Peso Total</th>
                            
                        </tr>
                    </thead>
                    <tbody id="datos">

                    </tbody>
                    <tfoot>
                        
                    </tfoot>
                </table>  
               
            </div>
           
           <!--Modal de modificar socio-->
            <div id="modalModificar" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Modificar Socio</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <form method="post" action='' name="">
                                   <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Turno Mañana:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="mañana" id="mañana" placeholder=" "></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Turno Tarde:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" name="tarde" id="tarde" placeholder=""></p>
                                        </div>
                                    </div>
                                    
                                        
                                </form>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <div id="botones">
                                
                            </div>
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

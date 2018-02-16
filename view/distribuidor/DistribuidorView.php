<!DOCTYPE html>
<html>
<head>
	<title>Distribuidor</title>
	<!-- CSS -->
	<script type="text/javascript" src="../../js/jquery-3.3.1.js"></script>

	<link rel="stylesheet" href="../../css/menu.css">
	<link rel="stylesheet" type="text/css" href="../../css/distribuidor/bootstrap.min.css">
    <script src="../../js/distribuidor/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/distribuidor/Distribuidor.css">

	<!-- JS --> 
    <script src="../../js/distribuidor/Distribuidor.js"></script> 
    <script type="text/javascript" language="javascript" src="../../js/jquery.dataTables.min.js"></script>
   
    <link rel="stylesheet" type="text/css" href="../../css/jquery.dataTables.min.css">
	 
              
</head>
<body>
	 <!-- Import the file menu.php -->
          <?php
            include '../menuView.php';
           ?>
    <div id="distribuidores">
    	<div id="distribuidor_titulo">
    		<label>Distribuidores</label>
    	</div>
		<div id="tabla_principal_distribuidor">
			<table id="tabla_distribuidor" class="display" cellspacing="0">
				<thead>
					<tr>
						<th>C&eacute;dula</th>
						<th>Nombre</th>
						<th>Apellido 1</th>
						<th>Apellido 2</th>
						<th>Tel&eacute;fono</th>
                        <th>Direcci&oacute;n</th>
                        <th>Correo</th>
                        <th>Modificar</th>
                        <th>Ver Imágenes</th>
                        <th>Eliminar</th>

					</tr>
					</thead>
					<tbody id="datos">

                	</tbody>
                    <tfoot>
                                
                    </tfoot>
			</table>
		</div>
		
        <!--Comienzan los modales-->
            <div class="modal-footer" id="Registrar">
                 <p><button onclick="modalRegistrarDistribuidor()" class="btn btn-primary">Registrar Distribuidor</button></p>
            </div>
           <!--Modal de modificar socio-->
            <div id="modalModificar" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Modificar Distribuidor</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <form method="post" action='' name="">
                                   <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Cédula:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="documentoidentidad" id="documentoidentidad" placeholder="Documento de identidad"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Nombre:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" name="nombre" id="nombre" placeholder="Nombre"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>1° Apellido:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="primerapellido" id="primerapellido" placeholder="Primer Apellido"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>2° Apellido:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="segundoapellido" id="segundoapellido" placeholder="Segundo Apellido"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Teléfono:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="telefono" id="telefono" placeholder="Teléfono"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Dirección:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" name="direccion" id="direccion" placeholder="Dirección"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Email:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="correo" id="correo" placeholder="Email"></p>
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

            <!--Modal de eliminar socio-->
            <div id="modalEliminar" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon glyphicon-warning-sign" > Advertencia</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <h4 >¿Está seguro de eliminar este Distribuidor?</h4>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <div id="botonesEliminar">
                                
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


            <!--Modal Registrar-->
            <div id="modalRegistrar" class="modal fade in">
                <div  class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Registrar Distribuidor</h4>
                        </div>
                        <div class="modal-body">
                            <center>
                                <form method="post" action='' name="">
                                   <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Cédula:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="documentoidentidad" id="documentoidentidadr" placeholder="Documento de identidad"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Nombre:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" name="nombre" id="nombrer" placeholder="Nombre"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>1° Apellido:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="primerapellido" id="primerapellidor" placeholder="Primer Apellido"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>2° Apellido:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="segundoapellido" id="segundoapellidor" placeholder="Segundo Apellido"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Teléfono:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="telefono" id="telefonor" placeholder="Teléfono"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Dirección:</label>
                                        </div>
                                        <div class="col-sm-8">
                                           <p><input type="text" class="span12" name="direccion" id="direccionr" placeholder="Dirección"></p>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <div class="col-sm-3">
                                            <label>Email:</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><input type="text" class="span12" name="correo" id="correor" placeholder="Email"></p>
                                        </div>
                                    </div>
                                        
                                </form>
                            </center>
                        </div>
                         <div class="modal-footer">
                            <div id="botonesRegistrar">
                                
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dalog -->
            </div><!-- /.modal -->
	</div>
</body>
</html>
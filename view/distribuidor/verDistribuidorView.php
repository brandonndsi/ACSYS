<!DOCTYPE html>
<html>
<head>
	<title>Distribuidor</title>
    <meta charset="utf-8">
    
    <!--CSS-->
        <link rel="stylesheet" href="../../css/jquery.dataTables.css">
        <link rel="stylesheet" href="../../css/menu.css">
        <link rel="stylesheet" href="../../css/bootstrap.min.css" >

        <!--Javascript-->
        <script src="../../js/jquery-3.2.1.js"></script>
        <script src="../../js/jquery.dataTables.js"></script>
         <script src="../../js/menuJs.js"></script>
        
         <script src="../../js/distribuidor/Distribuidor.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
         <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    
    
    <!-- CSS -->
	
    <link rel="stylesheet" type="text/css" href="../../css/distribuidor/modalImagen.css">
	
    
    <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]');
            });
    </script>
          
</head>
<body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%">
	 <!-- Import the file menu.php -->
          <?php
           // include '../menuView.php';
            include '../InterumtorDeMenus.php';
           ?>

        <div class="col-md-8 col-md-offset-2">
            <h4>Lista de Distribuidor</h4>
        </div>
		<div>
			<table id="listaDistribuidor" class="display" cellspacing="0">
				<thead>
					<tr>
						<th>Cédula</th>
						<th>Nombre</th>
						<th>Apellido 1</th>
						<th>Apellido 2</th>
						<th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Correo</th>
                        <th>Modificar</th>
                        <!--<th>Ver Imágenes</th>-->
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
                <!--Modal Registrar-->
        <div id="modalRegistrar" class="modal" role="dialog">
            <div  class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Registrar Distribuidor</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Cédula:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="documentoidentidadr" id="documentoidentidadr" onchange="validarEspaciosEnBlancoInput(event,this.id);" title="C&eacute;dula, debe incluir 9 d&iacute;gitos" placeholder="C&eacute;dula" required></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Nombre:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text"  class="form-control" class="span12" name="nombrer"  id="nombrer" onkeypress="return textonly(event);"  onchange="verifyOnChange(this.id);validarEspaciosEnBlancoInput(event,this.id);" data-toggle="tooltip" data-placement="top" title="Nombre" placeholder="Nombre" required/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>1° Apellido:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="primerapellidor" id="primerapellidor" onkeypress="return textonly(event);"  onchange="verifyOnChange(this.id);validarEspaciosEnBlancoInput(event,this.id);" data-toggle="tooltip" data-placement="top" title="Primer Apellido" placeholder="Primer Apellido" required/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>2° Apellido:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="segundoapellidor" id="segundoapellidor" onkeypress="return textonly(event);"  onchange="verifyOnChange(this.id);validarEspaciosEnBlancoInput(event,this.id);" data-toggle="tooltip" data-placement="top" title="Segundo Apellido" placeholder="Segundo Apellido" required/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Email:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="email" class="form-control" class="span12" name="correor" id="correor" placeholder="Email" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required /></p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Teléfono:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="telefonor" id="telefonor" onkeypress="return soloNumeros(event);"  onchange="verifyOnChange(this.id);validarEspaciosEnBlancoInput(event,this.id);verificarQueSeanNueveDijitos(this.id);" data-toggle="tooltip" data-placement="top" title="Tel&eacute;fono, debe incluir 9 d&iacute;gitos" placeholder="Tel&eacute;fono" required/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Dirección:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="direccionr" id="direccionr" onchange="verifyOnChange(this.id);validarEspaciosEnBlancoInput(event,this.id);" data-toggle="tooltip" data-placement="top" title="Direcci&oacute;n, Direcci&oacute;n exacta" placeholder="Direcci&oacute;n" required/></p>
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

        <!--Modal de modificar Distribuidor-->
        <div id="modalModificar" class="modal" role="dialog">
            <div  class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title glyphicon glyphicon glyphicon-edit" > Modificar Distribuidor</h4>
                        <button type="button" class="close" data-dismiss='modal'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Cédula:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="documentoidentidadm" id="documentoidentidadm" onchange="validarEspaciosEnBlancoInput(event,this.id);" title="C&eacute;dula, debe incluir 9 d&iacute;gitos" placeholder="C&eacute;dula" required/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Nombre:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text"  class="form-control" class="span12" name="nombrem"  id="nombrem" onkeypress="return textonly(event);"  onchange="verifyOnChange(this.id);validarEspaciosEnBlancoInput(event,this.id);" data-toggle="tooltip" data-placement="top" title="Nombre" placeholder="Nombre" required /></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>1° Apellido:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="primerapellidom" id="primerapellidom" onkeypress="return textonly(event);"  onchange="verifyOnChange(this.id);validarEspaciosEnBlancoInput(event,this.id);" data-toggle="tooltip" data-placement="top" title="Primer Apellido" placeholder="Primer Apellido" required/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>2° Apellido:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="text" class="form-control" class="span12" name="segundoapellidom" id="segundoapellidom" onkeypress="return textonly(event);"  onchange="verifyOnChange(this.id);validarEspaciosEnBlancoInput(event,this.id);" data-toggle="tooltip" data-placement="top" title="Segundo Apellido" placeholder="Segundo Apellido" required/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label>Email:</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <p><input type="email" class="form-control" class="span12" name="correom" id="correom" placeholder="Email" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" required /></p>
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Teléfono:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="telefonom" id="telefonom" onkeypress="return soloNumeros(event);"  onchange="verifyOnChange(this.id);validarEspaciosEnBlancoInput(event,this.id);" data-toggle="tooltip" data-placement="top" title="Tel&eacute;fono, debe incluir 9 d&iacute;gitos" placeholder="Tel&eacute;fono" required/></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label>Dirección:</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><input type="text" class="form-control" class="span12" name="direccionm" id="direccionm" onchange="verifyOnChange(this.id);validarEspaciosEnBlancoInput(event,this.id);" data-toggle="tooltip" data-placement="top" title="Direcci&oacute;n, Direcci&oacute;n exacta" placeholder="Direcci&oacute;n" required/></p>
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

        <!--Modal de eliminar empleado-->
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
                                <h4>¿Desea eliminar este Distribuidor?</h4>
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
<!-- Modal de la imagen del distribuidor. -->
<div id="contenedorImagen">
    <div id=contImagen>
        <div id="imagen">
           <img src="" id="recibir-imagene"> 
        </div>
        <div id="formImagen">
            <?php 
                include_once '../modalimagen/modalImagen.php';
             ?>
        </div>
    </div>
</div>
<!-- terminando el modal de la imagen del distribuidor.--> 
        <!--Modal de respuesta empleado-->
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
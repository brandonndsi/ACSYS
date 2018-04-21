function mostrarProductoLacteo(){
  $('#listaProductos').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../business/producto/actionProductoLacteo.php', {
              action : 'consultarproductos'
      }, function(responseText) {
        
        json = JSON.parse(responseText);
        html = "";

        for(i = 0 ;i<json.length; i++){
          html+="<tr>";
          html+="<td>"+json[i].codigoproductoslacteos+"</td>";
          html+="<td>"+json[i].nombreproductolacteo+"</td>";
          html+="<td>"+json[i].preciounitarioproductolacteo+"</td>";
          html+="<td>"+json[i].cantidadinventarioproductolacteo+"</td>";
          html+="<td>"+json[i].unidad+"</td>";
        
          codigo=json[i].codigoproductoslacteos;
          nombre=json[i].nombreproductolacteo;
          precio=json[i].preciounitarioproductolacteo;
          cantidad=json[i].cantidadinventarioproductolacteo;
          unidad=json[i].unidad;
          

          lacteo="'"+codigo+"-"+nombre +"-"+precio+"-"+cantidad+"-"+unidad+"'";

          html+='<td><a href="javascript:modalModificarProducto('+lacteo+')"><span class="glyphicon glyphicon-edit"></span></a></td>';
          html+='<td><a href="javascript:modalEliminarProducto('+lacteo+')"><span class="glyphicon glyphicon-trash"></span></a></td>';
        }
        $("#datos").html(html);
        $(document).ready(function() {
            $('#listaProductos').DataTable({
                "bDeferRender": true,
                "sordering": true,
                "responsive": true,
                "sPaginationType": "full_numbers",

                "oLanguage": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": 'Mostrar _MENU_ Registros por pagina',
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Por favor espere - cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
      });
  });
}

function soloNumeros(e) 
  { 
  var key = window.Event ? e.which : e.keyCode 
  return ((key >= 48 && key <= 57) || (key==8)) 
  }

function modalModificarProducto(lacteo){
  string=lacteo.split('-');
  document.getElementById("codigo").value=string[0];
  document.getElementById("nombre").value=string[1];
  document.getElementById("precio").value=string[2];
  document.getElementById("cantidad").value=string[3];
  document.getElementById("unidad").value=string[4];
  mostrarUnidades("unidad");
  codigo='"'+string[0]+'"';
  botones="<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
  botones+="<button onclick='modificarProducto("+codigo+")' data-dismiss='modal' class='btn btn-primary'>Modificar</button></p>";
  $("#botones").html(botones);
  $("#modalModificar").modal();

}

function modificarProducto(codigo){

  $(document).ready(function() {
      $.post('../../business/producto/actionProductoLacteo.php', {
              action : 'modificarproducto' ,
              codigo: document.getElementById("codigo").value,
              nombre: document.getElementById("nombre").value,
              precio: document.getElementById("precio").value,
              cantidad: document.getElementById("cantidad").value,
              unidad: document.getElementById("unidad").selectedIndex+1,
              

      }, function(responseText){
          respuesta="";
          alert(responseText);
          if(responseText=="true"){
              respuesta="<h4>Se ha modificado el producto satisfactoriamente</h4>";
              mostrarProductoLacteo();

          }else{
              respuesta="<h4>Ocurrió un error al modificar el producto</h4>";
              mostrarProductores();
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
      });
  });

}


function modalEliminarProducto(lacteo){
    string=lacteo.split('-');
    codigo='"'+string[0]+'"';

    botones="<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones+="<button onclick='eliminarProducto("+codigo+")' data-dismiss='modal' class='btn btn-primary'>Aceptar</button></p>";
    $("#botonesEliminar").html(botones);
    $("#modalEliminar").modal();
 }

 function eliminarProducto(codigo){
    $(document).ready(function() {
      $.post('../../business/producto/actionProductoLacteo.php', {
              action : 'eliminarproducto' ,
              codigo:codigo,
              

      }, function(responseText) {
         ;
          respuesta="";
          if(responseText=="true"){
              respuesta="<h4>Se ha eliminado el producto satisfactoriamente</h4>";
              mostrarProductoLacteo();

          }else{
              respuesta="<h4>Ocurrió un error al eliminar el producto</h4>";
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
         
      });
   });
  }

  function modalRegistrarProducto(){
  
    botones="<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones+="<button onclick='registrarProducto()' data-dismiss='modal' class='btn btn-primary'>Registrar</button></p>";
    mostrarUnidades("registrarunidad");
    $("#botonesRegistrar").html(botones);
    $("#modalRegistrar").modal();

}

function registrarProducto(){
   
    $(document).ready(function() {
       $.post('../../business/producto/actionProductoLacteo.php', {
          action : 'registrarproducto' ,
          codigo: document.getElementById("codigor").value,
          nombre: document.getElementById("nombrer").value,
          precio: document.getElementById("precior").value,
          cantidad: document.getElementById("cantidadr").value,
          unidad: document.getElementById("registrarunidad").selectedIndex+1,
          
              

      }, function(responseText) {
          
          respuesta="";
          if(responseText=="true"){
              respuesta="<h4>Se ha registrado el producto satisfactoriamente</h4>";
              mostrarProductoLacteo();

          }else{
              respuesta="<h4>Ocurrió un error al registrar el producto</h4>";
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
          document.getElementById("codigor").value="";
          document.getElementById("nombrer").value="";
          document.getElementById("precior").value="";
          document.getElementById("cantidadr").value="";
          document.getElementById("registrarunidad").selectedIndex=0;
      });
  });

}


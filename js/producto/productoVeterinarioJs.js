function mostrarProductoVeterinario(){
  $('#listaProductos').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../business/producto/actionProductoVeterinario.php', {
              action : 'consultarproductos'
      }, function(responseText) {
        
        json = JSON.parse(responseText);
        html = "";

        for(i = 0 ;i<json.length; i++){
          html+="<tr>";
          html+="<td>"+json[i].codigoproductoveterinario+"</td>";
          html+="<td>"+json[i].nombreproductoveterinario+"</td>";
          html+="<td>"+json[i].descripcionproductoveterinario+"</td>";
          html+="<td>"+json[i].precioproductoveterinario+"</td>";
          html+="<td>"+json[i].dosisproductoveterinario+"</td>";
          html+="<td>"+json[i].diasretencionlecheproductoveterinario+"</td>";
          html+="<td>"+json[i].nombreviaaplicacion+"</td>";
          html+="<td>"+json[i].nombrefuncion+"</td>";
          
          codigo=json[i].codigoproductoveterinario;
          nombre=json[i].nombreproductoveterinario;
          descripcion=json[i].descripcionproductoveterinario;
          precio=json[i].precioproductoveterinario;
          dosis=json[i].dosisproductoveterinario;
          dias=json[i].diasretencionlecheproductoveterinario;
          via=json[i].nombreviaaplicacion;
          funcion=json[i].nombrefuncion;
         
          
          veterinario="'"+codigo+"-"+nombre +"-"+descripcion+"-"+precio+"-"+dosis+"-"+dias+"-"+via+"-"+funcion+"'";
       

          html+='<td><a href="javascript:modalModificarProducto('+veterinario+')"><span class="glyphicon glyphicon-edit"></span></a></td>';
          html+='<td><a href="javascript:modalEliminarProducto('+veterinario+')"><span class="glyphicon glyphicon-trash"></span></a></td>';
          html+="</tr>";
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

function modalModificarProducto(veterinario){
  string=veterinario.split('-');
  document.getElementById("codigo").value=string[0];
  document.getElementById("nombre").value=string[1];
  document.getElementById("descripcion").value=string[2];
  document.getElementById("precio").value=string[3];
  document.getElementById("dosis").value=string[4];
  document.getElementById("dias").value=string[5];
  document.getElementById("via").value=string[6];
  document.getElementById("funcion").value=string[7];
  mostrarFuncion("funcion");
  mostrarVias("via");
  codigo='"'+string[0]+'"';
  botones="<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
  botones+="<button onclick='modificarProducto("+codigo+")' data-dismiss='modal' class='btn btn-primary'>Modificar</button></p>";
  $("#botones").html(botones);
  $("#modalModificar").modal();

}

function modificarProducto(codigo){

  $(document).ready(function() {
      $.post('../../business/producto/actionProductoVeterinario.php', {
              action : 'modificarproducto' ,
              codigo:document.getElementById("codigo").value,
              nombre:document.getElementById("nombre").value,
              descripcion:document.getElementById("descripcion").value,
              precio:document.getElementById("precio").value,
              dosis:document.getElementById("dosis").value,
              dias:document.getElementById("dias").value,
              via:document.getElementById("via").selectedIndex+1,
              funcion:document.getElementById("funcion").selectedIndex+1,
              
              

      }, function(responseText){
          respuesta="";
          
          if(responseText=="true"){
              respuesta="<h4>Se ha modificado el producto satisfactoriamente</h4>";
              mostrarProductoVeterinario();
          }else{
              respuesta="<h4>Ocurrió un error al modificar el producto</h4>";
              mostrarProductoVeterinario();
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
      $.post('../../business/producto/actionProductoVeterinario.php', {
              action : 'eliminarproducto' ,
              codigo:codigo,
              

      }, function(responseText) {
         ;
          respuesta="";
          if(responseText=="true"){
              respuesta="<h4>Se ha eliminado el producto satisfactoriamente</h4>";
              mostrarProductoVeterinario();

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
    //mostrarUnidades("registrarunidad");
    mostrarFuncion("funcionr");
    mostrarVias("viar");
    $("#botonesRegistrar").html(botones);
    $("#modalRegistrar").modal();

}

function registrarProducto(){
   
    $(document).ready(function() {
       $.post('../../business/producto/actionProductoVeterinario.php', {
          action : 'registrarproducto' ,
          codigo:document.getElementById("codigor").value,
          nombre:document.getElementById("nombrer").value,
          descripcion:document.getElementById("descripcionr").value,
          precio:document.getElementById("precior").value,
          dosis:document.getElementById("dosisr").value,
          dias:document.getElementById("diasr").value,
          via:document.getElementById("viar").selectedIndex+1,
          funcion:document.getElementById("funcionr").selectedIndex+1,

      }, function(responseText) {
          
          respuesta="";
          if(responseText=="true"){
            respuesta="<h4>Se ha registrado el producto satisfactoriamente</h4>";
            mostrarProductoVeterinario();

          }else{
              respuesta="<h4>Ocurrió un error al registrar el producto</h4>";
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
          document.getElementById("codigor").value;
          document.getElementById("nombrer").value;
          document.getElementById("descripcionr").value;
          document.getElementById("precior").value;
          document.getElementById("dosisr").value;
          document.getElementById("diasr").value;
          document.getElementById("viar").value;
          document.getElementById("funcionr").selectedIndex=0;
      });
  });

}


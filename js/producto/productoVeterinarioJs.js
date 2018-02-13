function mostrarProductoVeterinario(){
  $('#listaProductos').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../business/producto/actionProductoVeterinario.php', {
              action : 'consultarproductos'
      }, function(responseText) {
        alert(responseText);
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
          html+="<td>"+json[i].viaaplicacionveterinarios+"</td>";
          html+="<td>"+json[i].funcionveterinarios+"</td>";
          
          codigo=json[i].codigoproductoveterinario;
          nombre=json[i].nombreproductoveterinario;
          descripcion=json[i].descripcionproductoveterinario;
          precio=json[i].precioproductoveterinario;
          dosis=json[i].dosisproductoveterinario;
          dias=json[i].diasretencionlecheproductoveterinario;
          via=json[i].viaaplicacionveterinarios;
          funcion=json[i].funcionveterinarios;
         
          
          veterinario="'"+codigo+"-"+nombre +"-"+descripcion+"-"+precio+"-"+dosis+"-"+dias+"-"+via+"-"+funcion+"'";
       

          html+='<td><a href="javascript:modalModificarProducto('+veterinario+')"><span class="glyphicon glyphicon-edit"></span></a></td>';
          html+='<td><a href="javascript:modalEliminarProducto('+veterinario+')"><span class="glyphicon glyphicon-trash"></span></a></td>';
        }
        $("#datos").html(html);
        $(document).ready(function() {
            $('#listaProductos').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ Registros por pagina",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay datos",
                    "infoFiltered": "(filtrada de _MAX_ registros)",
                    "search": "Buscar:",
                    "paginate": {
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    },
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
  document.getElementById("precio").value=string[2];
  document.getElementById("cantidad").value=string[3];
  document.getElementById("unidad").value=string[4];
 
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


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

function modalModificarProducto(lacteo){
  string=lacteo.split('-');
  document.getElementById("codigo").value=string[0];
  document.getElementById("nombre").value=string[1];
  document.getElementById("precio").value=string[2];
  document.getElementById("cantidad").value=string[3];
  document.getElementById("unidad").value=string[4];
  mostrarUnidades();
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
              mostrarProductores();

          }else{
              respuesta="<h4>Ocurrió un error al modificar el producto</h4>";
              mostrarProductores();
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
      });
  });

}


function modalEliminarCliente(cliente){
    string=cliente.split('-');
    id='"'+string[7]+'"';

    botones="<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones+="<button onclick='eliminarCliente("+id+")' data-dismiss='modal' class='btn btn-primary'>Aceptar</button></p>";
    $("#botonesEliminar").html(botones);
    $("#modalEliminar").modal();
 }

 function eliminarCliente(id){
    $(document).ready(function() {
      $.post('../../business/producto/actionProductoLacteo.php', {
              action : 'eliminarproductor' ,
              id:id,
              

      }, function(responseText) {
      
          respuesta="";
          if(responseText=="true"){
              respuesta="<h4>Se ha eliminado el producto satisfactoriamente</h4>";
              mostrarProductores();

          }else{
              respuesta="<h4>Ocurrió un error al eliminar el producto</h4>";
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
         
      });
   });
  }
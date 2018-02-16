$(document).ready(function() {
 
cargarTablaDistribuidor();
});

function cargarTablaDistribuidor(){
  $('#tabla_distribuidor').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../business/distribuidor/DistribuidorAccion.php', {
              action : 'consultarDistribuidor'
      }, function(responseText) {
        json = JSON.parse(responseText);
        html = "";

        for(i = 0 ;i<json.length; i++){
          html+="<tr>";
          html+="<td>"+json[i].documentoidentidadpersona+"</td>";
          html+="<td>"+json[i].nombrepersona+"</td>";
          html+="<td>"+json[i].apellido1persona+"</td>";
          html+="<td>"+json[i].apellido2persona+"</td>";
          html+="<td>"+json[i].telefonopersona+"</td>";
          html+="<td>"+json[i].direccionpersona+"</td>";
          html+="<td>"+json[i].correopersona+"</td>";
          cedula=json[i].documentoidentidadpersona;
          nombre=json[i].nombrepersona;
          primerapellido=json[i].apellido1persona;
          segundoapellido=json[i].apellido2persona;
          telefono=json[i].telefonopersona;
          direccion=json[i].direccionpersona;
          correo=json[i].correopersona;
          id=json[i].idpersona;

          distribuidor="'"+cedula+"-"+nombre +"-"+primerapellido+"-"+segundoapellido+"-"+telefono+"-"+direccion+"-"+correo+"-"+id+"'";

          


          html+='<td><a href="javascript:modalModificarDistribuidor('+distribuidor+')"><span class="glyphicon glyphicon-edit"></span></a></td>';
          html+='<td><a href="javascript:deleteAgentModal()"><span class="glyphicon glyphicon-paperclip"></span></a></td>';
          html+='<td><a href="javascript:modalEliminarDistribuidor('+distribuidor+')"><span class="glyphicon glyphicon-trash"></span></a></td>';
        }
        $("#datos").html(html);
        $(document).ready(function() {
            $('#listaProductores').DataTable({
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

function modalModificarDistribuidor(socio){
  string=socio.split('-');
  document.getElementById("documentoidentidad").value=string[0];
  document.getElementById("nombre").value=string[1];
  document.getElementById("primerapellido").value=string[2];
  document.getElementById("segundoapellido").value=string[3];
  document.getElementById("telefono").value=string[4];
  document.getElementById("direccion").value=string[5];
  document.getElementById("correo").value=string[6];
  id='"'+string[7]+'"';
  botones="<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
  botones+="<button onclick='modificarDistribuidor("+id+")' data-dismiss='modal' class='btn btn-primary'>Modificar</button></p>";
  $("#botones").html(botones);
  $("#modalModificar").modal();

}

function modificarDistribuidor(id){

  $(document).ready(function() {
      $.post('../../business/distribuidor/DistribuidorAccion.php', {
              action : 'modificarDistribuidor' ,
              cedula: document.getElementById("documentoidentidad").value,
              nombre: document.getElementById("nombre").value,
              apellido1: document.getElementById("primerapellido").value,
              apellido2: document.getElementById("segundoapellido").value,
              telefono: document.getElementById("telefono").value,
              direccion: document.getElementById("direccion").value,
              correo: document.getElementById("correo").value,
              id:id,

      }, function(responseText) {
          respuesta="";
          if(responseText=="true"){
              respuesta="<h4>Se ha modificado el Distribuidor satisfactoriamente</h4>";
              mostrarProductores();

          }else{
              respuesta="<h4>Ocurrió un error al modificar el Distribuidor</h4>";
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
      });
  });

}

function modalRegistrarDistribuidor(){
  botones="<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
  botones+="<button onclick='registrarDistribuidor()' data-dismiss='modal' class='btn btn-primary'>Registrar</button></p>";
  $("#botonesRegistrar").html(botones);
  $("#modalRegistrar").modal();


}

function registrarDistribuidor(){
  cedula=document.getElementById("documentoidentidadr").value;
  nombre=document.getElementById("nombrer").value;
  apellido1=document.getElementById("primerapellidor").value;
  apellido2=document.getElementById("segundoapellidor").value;
  telefono=document.getElementById("telefonor").value;
  direccion=document.getElementById("direccionr").value;
  correo=document.getElementById("correor").value;
  $(document).ready(function() {
      $.post('../../business/distribuidor/DistribuidorAccion.php', {
              action : 'registrarDistribuidor' ,
              cedula: cedula,
              nombre: nombre,
              apellido1: apellido1,
              apellido2: apellido2,
              telefono: telefono,
              direccion: direccion,
              correo: correo,
              

      }, function(responseText) {
          respuesta="";
          if(responseText=="true"){
              respuesta="<h4>Se ha registrado el Distribuidor satisfactoriamente</h4>";
              mostrarProductores();

          }else{
              respuesta="<h4>Ocurrió un error al registrar el Distribuidor</h4>";
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
          document.getElementById("documentoidentidadr").value="";
          document.getElementById("nombrer").value="";
          document.getElementById("primerapellidor").value="";
          document.getElementById("segundoapellidor").value="";
          document.getElementById("telefonor").value="";
          document.getElementById("direccionr").value="";
          document.getElementById("correor").value="";
      });
  });

}

function modalEliminarDistribuidor(socio){
    string=socio.split('-');
    id='"'+string[7]+'"';

    botones="<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones+="<button onclick='eliminarDistribuidor("+id+")' data-dismiss='modal' class='btn btn-primary'>Aceptar</button></p>";
    $("#botonesEliminar").html(botones);
    $("#modalEliminar").modal();
 }

 function eliminarDistribuidor(id){
    $(document).ready(function() {
      $.post('../../business/distribuidor/DistribuidorAccion.php', {
              action : 'eliminarDistribuidor' ,
              id:id,
              

      }, function(responseText) {
      
          respuesta="";
          if(responseText=="true"){
              respuesta="<h4>Se ha eliminado el Distribuidor satisfactoriamente</h4>";
              mostrarProductores();

          }else{
              respuesta="<h4>Ocurrió un error al eliminar el Distribuidor</h4>";
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
         
      });
  });
}
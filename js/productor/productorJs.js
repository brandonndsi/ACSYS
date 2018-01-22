
function modalModificarSocio(socio){
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
  botones+="<button onclick='modificarSocio("+id+")' data-dismiss='modal' class='btn btn-primary'>Modificar</button></p>";
  $("#botones").html(botones);
  $("#modalModificar").modal();

}

function modificarSocio(id){

  $(document).ready(function() {
      $.post('../../business/productor/actionProductor.php', {
              action : 'modificarproductor' ,
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
              respuesta="<h4>Se ha modificado el productor satisfactoriamente</h4>";
              mostrarProductores();

          }else{
              respuesta="<h4>Ocurrió un error al modificar el productor</h4>";
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
      });
  });

}

function mostrarProductores(){
  $('#listaProductores').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../business/productor/actionProductor.php', {
              action : 'consultarproductores'
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
          documentoidentidad=json[i].documentoidentidadpersona;
          nombre=json[i].nombrepersona;
          primerapellido=json[i].apellido1persona;
          segundoapellido=json[i].apellido2persona;
          telefono=json[i].telefonopersona;
          direccion=json[i].direccionpersona;
          correo=json[i].correopersona;
          id=json[i].idpersona;

          socio="'"+documentoidentidad+"-"+nombre +"-"+primerapellido+"-"+segundoapellido+"-"+telefono+"-"+direccion+"-"+correo+"-"+id+"'";

          


          html+='<td><a href="javascript:modalModificarSocio('+socio+')"><span class="glyphicon glyphicon-edit"></span></a></td>';
          html+='<td><a href="javascript:deleteAgentModal()"><span class="glyphicon glyphicon-paperclip"></span></a></td>';
          html+='<td><a href="javascript:deleteAgentModal()"><span class="glyphicon glyphicon-trash"></span></a></td>';
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

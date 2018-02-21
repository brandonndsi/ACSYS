
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
      $.post('../../business/productor/actionProductorSocio.php', {
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

function modalRegistrarSocio(){
  botones="<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
  botones+="<button onclick='registrarSocio()' data-dismiss='modal' class='btn btn-primary'>Registrar</button></p>";
  $("#botonesRegistrar").html(botones);
  $("#modalRegistrar").modal();


}

function registrarSocio(){
  cedula=document.getElementById("documentoidentidadr").value;
  nombre=document.getElementById("nombrer").value;
  apellido1=document.getElementById("primerapellidor").value;
  apellido2=document.getElementById("segundoapellidor").value;
  telefono=document.getElementById("telefonor").value;
  direccion=document.getElementById("direccionr").value;
  correo=document.getElementById("correor").value;
  $(document).ready(function() {
      $.post('../../business/productor/actionProductorSocio.php', {
              action : 'registrarproductor' ,
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
              respuesta="<h4>Se ha registrado el productor satisfactoriamente</h4>";
              mostrarProductores();

          }else{
              respuesta="<h4>Ocurrió un error al registrar el productor</h4>";
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

function mostrarProductores(){
  $('#listaProductores').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../business/productor/actionProductorSocio.php', {
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
          html+='<td><a href="javascript:modalEliminarSocio('+socio+')"><span class="glyphicon glyphicon-trash"></span></a></td>';
        }
        $("#datos").html(html);
        $(document).ready(function() {
            $('#listaProductores').DataTable({
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

function modalEliminarSocio(socio){
    string=socio.split('-');
    id='"'+string[7]+'"';

    botones="<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones+="<button onclick='eliminarSocio("+id+")' data-dismiss='modal' class='btn btn-primary'>Aceptar</button></p>";
    $("#botonesEliminar").html(botones);
    $("#modalEliminar").modal();
 }

 function eliminarSocio(id){
    $(document).ready(function() {
      $.post('../../business/productor/actionProductorSocio.php', {
              action : 'eliminarproductor' ,
              id:id,
              

      }, function(responseText) {
      
          respuesta="";
          if(responseText=="true"){
              respuesta="<h4>Se ha eliminado el productor satisfactoriamente</h4>";
              mostrarProductores();

          }else{
              respuesta="<h4>Ocurrió un error al eliminar el productor</h4>";
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
         
      });
  });
}


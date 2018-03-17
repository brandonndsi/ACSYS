function mostrarMontoAhorro(){
  $('#listaProductores').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../business/ahorro/actionAhorro.php', {
              action : 'consultarMontoAhorro',
      }, function(responseText) {
        
        json = JSON.parse(responseText);
        html = "";

        for(i = 0 ;i<json.length; i++){
          html+="<tr>";
          html+="<td>"+json[i].documentoidentidad+"</td>";
          html+="<td>"+json[i].nombre+" "+json[i].apellido1+" "+json[i].apellido2+"</td>";
          html+="<td>"+json[i].ahorro+"</td>";

          documentoidentidad=json[i].documentoidentidad;
          nombre=json[i].nombre+" "+json[i].apellido1+" "+json[i].apellido2;
          ahorro=json[i].ahorro;
          id=json[i].id;
          tipo=json[i].tipo;
          productor="'"+id+"-"+documentoidentidad+"-"+nombre+"-"+ahorro+"-"+tipo+"'" ;
          html+='<td><a href="javascript:modalModificarSocio('+productor+')"><span class="glyphicon glyphicon-edit"></span></a></td>';
          
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

function modalModificarSocio(productor){

  string=productor.split('-');
  document.getElementById("documentoidentidad").value=string[1];
  document.getElementById("nombre").value=string[2];
  document.getElementById("ahorro").value=string[3];
  id='"'+string[0]+'"';
  tipo='"'+string[4]+'"';
  botones="<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
  botones+="<button onclick='modificarMontoAhorro("+id+","+tipo+")' data-dismiss='modal' class='btn btn-primary'>Modificar</button></p>";
  $("#botones").html(botones);
  $("#modalModificar").modal();
}

function modificarMontoAhorro(id,tipo){
  

  $(document).ready(function() {
      $.post('../../business/ahorro/actionAhorro.php', {
              action : 'modificarMontoAhorro' ,
              ahorro: document.getElementById("ahorro").value,  
              id:id,
              tipo:tipo,

      }, function(responseText) {
          respuesta="";
          if(responseText=="true"){
              respuesta="<h4>Se ha modificado el ahorro del productor satisfactoriamente</h4>";
              mostrarMontoAhorro();

          }else{
              respuesta="<h4>Ocurrió un error al modificar el ahorro del productor</h4>";
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
      });
  });



}

function mostrarAhorroTotal(){

   $('#listaProductores').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../business/ahorro/actionAhorro.php', {
              action : 'consultarMontoAhorroTotal',
      }, function(responseText) {
        json = JSON.parse(responseText);
        html = "";

        for(i = 0 ;i<json.length; i++){
          html+="<tr>";
          html+="<td>"+json[i].documentoidentidad+"</td>";
          html+="<td>"+json[i].nombre+" "+json[i].apellido1+" "+json[i].apellido2+"</td>";
          html+="<td>"+json[i].ahorro+"</td>";

          documentoidentidad=json[i].documentoidentidad;
          nombre=json[i].nombre+" "+json[i].apellido1+" "+json[i].apellido2;
          ahorro=json[i].ahorro;
          id=json[i].id;
          tipo=json[i].tipo;
          productor="'"+id+"'" ;
          html+='<td><a href="javascript:modalPagarAhorro('+productor+')"><span class="glyphicon glyphicon-credit-card"></span></a></td>';
          
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

function modalPagarAhorro(productor){
  html = "<p><button data-dismiss='modal' class='btn btn-danger'>Cerrar</button> </p>";
  html+= "<p><button data-dismiss='modal' onclick='pagarAhorro("+productor+")' class='btn btn-primary'>Aceptar</button> </p>";
  $("#botones").html(html);
  $("#modalConfirmacion").modal();
}

function pagarAhorro(idProductor){
  $(document).ready(function() {
      $.post('../../business/ahorro/actionAhorro.php', {
              action : 'pagarAhorro' , 
              idProductor:idProductor,

      }, function(responseText) {
          respuesta="";
          if(responseText=="true"){
              respuesta="<h4>Se ha realizado el pago del ahorro satisfactoriamente</h4>";
              mostrarAhorroTotal();

          }else{
              respuesta="<h4>Ocurrió un error al realizar el pago del ahorro</h4>";
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
      });
  });
}




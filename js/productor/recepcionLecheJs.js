function registrarLeche(){
  cliente=document.getElementById("selectCliente").value;

  fecha=document.getElementById("fecha").value;
  split=fecha.split("/");

  turno=document.getElementById("turno").value;
  peso=document.getElementById("peso").value;
  
  $(document).ready(function() {
      $.post('../../business/productor/actionRecepcionLeche.php', {
              action : 'registrarLeche' ,
              cliente: cliente,
              fecha: split[2]+"/"+split[1]+"/"+split[0],
              turno: turno,
              peso: peso,
              

      }, function(responseText) {
        alert(responseText);
          
          
          respuesta="<h4>"+responseText+"</h4>";
            
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
         
      });
  });

}

function mostrarRecepcion(){
  fecha = document.getElementById("fecha").value.split("/");
  fecha = fecha[2]+"-"+fecha[1]+"-"+fecha[0];
  $('#listaProductores').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../business/productor/actionRecepcionLeche.php', {
              action : 'consultarRecepcion',
              fecha:fecha,
      }, function(responseText) {
        console.log(responseText);  
        json = JSON.parse(responseText);
        html = "";
        for(i = 0 ;i<json.length; i++){
          fecha = json[i].fechaentregalechediario.split("-");
          html+="<tr>";
          html+="<td>"+json[i].nombrepersona+" "+json[i].apellido1persona+" "+json[i].apellido2persona+"</td>";
          html+="<td>"+fecha[2]+"-"+fecha[1]+"-"+fecha[0]+"</td>";
          html+="<td>"+json[i].turnomanana+"</td>";
          html+="<td>"+json[i].turnotarde+"</td>";
          pesototal=parseFloat(json[i].turnomanana)+parseFloat(json[i].turnotarde);

          html+="<td>"+pesototal+"</td>";
          nombre=json[i].nombrepersona+" "+json[i].apellido1persona+""+json[i].apellido2persona;
          mañana=json[i].pesoturno;
          tarde=json[i].pesoturno;
          fecha=json[i].fechaentregalechediario;
          id=json[i].idpesalechediario;
         //html+='<td><a href="javascript:modalModificarSocio('+id+')"><span class="glyphicon glyphicon-edit"></span></a></td>';
          
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



function modalModificarSocio(socio){
  string=socio.split('-');
  document.getElementById("documentoidentidad").value=string[0];
  document.getElementById("mañana").value=string[1];
  document.getElementById("tarde").value=string[2];
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



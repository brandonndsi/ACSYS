function cargarTabla(){
  $(document).ready(function () {
      $('#listaProductosVeterinarios').DataTable({
          "bDeferRender": true,
          "sordering": true,
          "responsive": true,
          'sDom': 't',

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
}


function consultarProductorCliente(html){
  $(document).ready(function () {
      $.post('../../business/productor/actionProductorCliente.php', {
              action : 'consultarproductores'
      }, function(responseText) {
        json = JSON.parse(responseText);
        for(i = 0 ;i<json.length; i++){
          idPersona = '"'+json[i].idpersona+'"';
          html+="<option value="+idPersona+">"+json[i].nombrepersona+" "+json[i].apellido1persona+" "+json[i].apellido2persona+"</option>";
        }
        $("#selectCliente").html(html);
      });
    });
}
function consultarProductorSocio(){
  $(document).ready(function () {
      $.post('../../business/productor/actionProductorSocio.php', {
            action : 'consultarproductores'
      }, function(responseText) {
        json = JSON.parse(responseText);
        html = "";
        for(i = 0 ;i<json.length; i++){
          idPersona = '"'+json[i].idpersona+'"';
          html+="<option value="+idPersona+">"+json[i].nombrepersona+" "+json[i].apellido1persona+" "+json[i].apellido2persona+"</option>";
        }
        consultarProductorCliente(html);
      });
    });
}

function agregarProductoCarritoBuscar(){
  var codigo = getRadioButtonSelectedValue(document.table.radios);
  alert(codigo);
}


function getRadioButtonSelectedValue(ctrl){
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
}

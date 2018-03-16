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
  $('#listaProductosVeterinarios').dataTable().fnDestroy();
  var code = $('input:radio[name=radios]:checked').val();
  $(document).ready(function () {
      $.post('../../business/ventas/actionVentaVeterinaria.php', {
            action : 'searchProduct',
            code: code,
      }, function(responseText) {
        json = JSON.parse(responseText);
        if(localStorage.getItem("listaProductos") == null){
          var listaProductos = [];
          listaProductos.push({"codigo":code,"nombre":json.nombreproductoveterinario,"precio":json.precioproductoveterinario,"cantidad":1,"descuento":0});
          localStorage.setItem("listaProductos",JSON.stringify(listaProductos));
        }else{
          listaProductos = JSON.parse(localStorage.getItem("listaProductos"));
          bandera = false;
          for(i = 0 ;i<listaProductos.length; i++){
            if(listaProductos[i].codigo == code){
              listaProductos[i].cantidad = listaProductos[i].cantidad + 1;
              bandera = true;
            }
          }
          if(!bandera){
            listaProductos.push({"codigo":code,"nombre":json.nombreproductoveterinario,"precio":json.precioproductoveterinario,"cantidad":1,"descuento":0});
          }
          localStorage.setItem("listaProductos",JSON.stringify(listaProductos));
        }
        listaProductos = JSON.parse(localStorage.getItem("listaProductos"));
        html = "";
        for(i = 0 ;i<listaProductos.length; i++){
          html+="<tr>";
          html+="<td>"+listaProductos[i].codigo+"</td>";
          html+="<td>"+listaProductos[i].nombre+"</td>";
          html+="<td>"+listaProductos[i].precio+"</td>";
          html+="<td><input type='text' value='"+listaProductos[i].cantidad+"'> </td>";
          html+="<td><input type='text' value='0'> </td>";
          html+="<td>"+((listaProductos[i].precio*listaProductos[i].cantidad)-listaProductos[i].descuento)+"</td>";
          html+="<td><button><span class='glyphicon glyphicon-remove'></span></button></td>";
          html+="</tr>";
        }
        $("#datos").html(html);
        $(document).ready(function() {
            $('#listaProductosVeterinarios').DataTable({
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


function getRadioButtonSelectedValue(ctrl){
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
}

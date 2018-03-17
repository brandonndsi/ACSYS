function cargarTabla1(){
  $('#buscarProductos').dataTable().fnDestroy();
  $('#datos1').html("");
  document.getElementById("productoBuscar").value="";
  $('#buscarProductos').DataTable({
      "bFilter": false,
      "bInfo": false,
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
}
function filtrar(){
  $('#buscarProductos').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../data/autocomplete/Auto_Distribuidor.php', {
              term : document.getElementById("productoBuscar").value ,
      }, function(responseText){
          json = JSON.parse(responseText);
          html = "";
          for(i = 0 ;i<json.length; i++){
            html+="<tr>";
            codigoProducto = "'"+json[i].codigoproductoslacteos+"'";
            html+="<td><input id='radios' name='radios' type='radio' value="+codigoProducto+"></td>";
            html+="<td>"+json[i].codigoproductoslacteos+"</td>";
            html+="<td>"+json[i].nombreproductolacteo+"</td>";
            /*html+="<td>"+json[i].cantidadinventarioproductolacteo+"</td>";*/
            html+="<td>"+json[i].preciounitarioproductolacteo+"</td>";
            html+="</tr>";
          }
          $('#datos1').html(html);
          $('#buscarProductos').DataTable({
              "bFilter": false,
              "bInfo": false,
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
  });

}

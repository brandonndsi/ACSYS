function mostrarTotalPago(){
  $('#listaProductores').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../business/reportes/actionReportePagoLeche.php', {
              action : 'verReportePagoLeche',
              fechainicio:document.getElementById("fechainicial").value,
              fechafinal:document.getElementById("fechafinal").value,
      }, function(responseText) {

        json = JSON.parse(responseText);
        html = "";

        for(i = 0 ;i<json.length; i++){
          fecha=json[i].fechacompramateriaprima.split("-");

          html+="<tr>";
          html+="<td>"+json[i].idcompramateriaprima+"</td>";
          html+="<td>"+json[i].nombrepersona+" "+json[i].apellido1persona+" "+json[i].apellido2persona+"</td>";
          html+="<td>"+json[i].cantidadlitroscompramateriaprima	+"</td>";
          html+="<td>"+json[i].montopagolitro+"</td>";
          html+="<td>"+json[i].totalpagarlitros+"</td>";
          html+="<td>"+fecha[2]+"-"+fecha[1]+"-"+fecha[0]+"</td>";
          html+='<td><a href="#"><span class="glyphicon glyphicon-list-alt"></span></a></td>';
          
        }
        $("#datos").html(html);
        $(document).ready(function() {
            $('#listaAhorro').DataTable({
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

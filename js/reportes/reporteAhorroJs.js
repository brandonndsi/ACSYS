$(document).ready(function () {
    CargarTablaPrincipal(); 
    temporalErrorBusqueda();           
});


function mostrarMontoLecheSemanalTotal(){
  var listaTodo = [];
  $('#listaAhorro').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../business/reportes/actionReporteAhorro.php', {
              action : 'verReporteAhorro',
              fechainicio:document.getElementById("fechainicial").value,
              fechafinal:document.getElementById("fechafinal").value,
      }, function(responseText) {
        json = JSON.parse(responseText);
        html = "";

        for(i = 0 ;i<json.length; i++){
          fecha=json[i].fechaentregapago.split("-");
          html+="<tr>";
          html+="<td>"+json[i].idahorro+"</td>";
          html+="<td>"+json[i].nombrepersona+" "+json[i].apellido1persona+" "+json[i].apellido2persona+"</td>";
          html+="<td>"+json[i].litrosentregadosahorrosemanal+"</td>";
          html+="<td>"+json[i].montoahorrosemanalporlitro+"</td>";
          html+="<td>"+(json[i].montoahorrosemanalporlitro*json[i].litrosentregadosahorrosemanal)+"</td>";
          html+="<td>"+fecha[2]+"-"+fecha[1]+"-"+fecha[0]+"</td>";
          html+='<td><a href="#"><span class="glyphicon glyphicon-list-alt"></span></a></td>';
          
          listaTodo.push({"nombre":json[i].nombrepersona+" "+json[i].apellido1persona+" "+json[i].apellido2persona,"litros":json[i].litrosentregadosahorrosemanal,"ahorro":json[i].montoahorrosemanalporlitro,"totalahorro":(json[i].montoahorrosemanalporlitro*json[i].litrosentregadosahorrosemanal),"fecha":json[i].fechaentregapago});
          localStorage.setItem("listaTodo", JSON.stringify(listaTodo)); 
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

/**
   * [retorna un mensaje en el data table inicial]
   * @return {[type]} [retorna un simple mensaje inicial]
   */
  function temporalErrorBusqueda(){
    html="<td colspan='7' align='center'>Seleccione la fecha para la busqueda</th>";
    $("#datos").html(html);
  }

  /**
   * [CargarTablaPrincipal Loque hace es darles los valores del datablable a la table normal del principal]
   */
  function CargarTablaPrincipal(){
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
  }

  function imprimirTodo(){
  if (localStorage.getItem("listaTodo") === null) {
  swal({
                    title: "Reportes.",
                    text: "La lista de reportes esta vacía",
                    icon: "error",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            value: "ok"
                        }

                    },
                    dangerMode: true
                });

}else{
  window.open("../../view/facturas/imprimirPDFReporteAhorro.php?lista="+localStorage.getItem("listaTodo")+"&tipo=Ahorros", "popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
  localStorage.clear();
  window.location.href = '../../view/reportes/ahorros.php';
}
}
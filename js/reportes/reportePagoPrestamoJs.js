$(document).ready(function () {
    CargarTablaPrincipal();            
});

function mostrarPagosPrestamos(){
  var listaTodo = [];
  $('#listaAhorro').dataTable().fnDestroy();
  idPrestamo = document.getElementById("selectPrestamos").value;
  if(idPrestamo!=0){
        $(document).ready(function() {
          $.post('../../business/reportes/actionReportePagoPrestamo.php', {
                  action : 'verPagosPrestamos',
                  idPrestamo:idPrestamo,
                  fechainicio:document.getElementById("fechainicial").value,
                  fechafinal:document.getElementById("fechafinal").value,

          }, function(responseText) {
            json = JSON.parse(responseText);
            html = "";

            for(i = 0 ;i<json.length; i++){
              fecha=json[i].fechapagoprestamo.split("-");
              html+="<tr>";
              html+="<td>"+json[i].idpagoprestamo+"</td>";
              html+="<td>"+json[i].saldoanteriorpagopretsamo+"</td>";
              html+="<td>"+json[i].saldoactualpagoprestamo+"</td>";
              html+="<td>"+json[i].montocuotapagoprestamo+"</td>";
              html+="<td>"+fecha[2]+"-"+fecha[1]+"-"+fecha[0]+"</td>";
              html+="<td>"+json[i].horapagoprestamo+"</td>";
              html+='<td><a href="#"><span class="glyphicon glyphicon-list-alt"></span></a></td>';
              listaTodo.push({"fecha":json[i].fechapagoprestamo,"saldoanterior":json[i].saldoanteriorpagopretsamo,"saldoactual":json[i].saldoactualpagoprestamo,"cuotas":json[i].montocuotapagoprestamo,"horapago":json[i].horapagoprestamo});
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
  
}

function obtenerPrestamosSocio(){
  id=document.getElementById("selectCliente").value;
  $(document).ready(function() {
      $.post('../../business/reportes/actionReportePagoPrestamo.php', {
              action : 'obtenerPrestamosSocio',
              id:id,
      }, function(responseText) {
        json = JSON.parse(responseText);
        html = "";
        for(i = 0 ;i<json.length; i++){
          html+="<option value="+json[i].idprestamo+">Adelanto N° "+json[i].idprestamo+" de "+json[i].montototalprestamo+"</option>";      
        }
        if(html==""){
          html="<option value='0'>No posee adelanto</option>"
        }
        $("#selectPrestamos").html(html);
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
        $("#selectCliente").html(html);
        obtenerPrestamosSocio();
      });
    });
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


  function imprimirReporte(){
  if (localStorage.getItem("listaTodo") === null) {//cambiar por la validacion de la consulta de los datos para poder ver lo que es la lista llena.
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
  
  window.open("../../view/facturas/imprimirPDFAdelantoPago.php?lista="+localStorage.getItem("listaTodo")+"&tipo=Pago Adelantado", "popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
  localStorage.clear();
  window.location.href = '../../view/reportes/pagosPrestamos.php';
}
}
function consultarVentasPorCobrar() {
    $('#listaVentas').dataTable().fnDestroy();
    idCliente = document.getElementById('selectCliente').value;
    $(document).ready(function () {
        $.post('../../business/ventas/actionPagarVentas.php', {
            action: 'consultarVentasPorCobrar',
            idCliente: idCliente,
        }, function (responseText) {
            json = JSON.parse(responseText);
            datos="";
            for (i = 0; i < json.length; i++) {
                datos+="<tr>"
                datos+="<td>"+(parseInt(json[i].numerofactura)+1)+"</td>";
                datos+="<td>"+json[i].fechaventa+"</td>";
                datos+="<td>"+json[i].tipoventa+"</td>";
                datos+="<td>"+json[i].totalbrutoventa+"</td>";
                idVentaPorCobrar = json[i].idventaporcobrar;
                datos+='<td><a href="javascript:modalRegistrarPagoVenta('+idVentaPorCobrar+','+json[i].totalbrutoventa+')"><span class="glyphicon glyphicon-credit-card"></span></a></td>';
                datos+="</tr>"
            }
            $("#datos").html(datos);
            $('#listaVentas').DataTable({
                "bDeferRender": true,
                "sordering": true,
                "responsive": true,
                "ordering": true,
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

function modalRegistrarPagoVenta(idVentaPorCobrar,total){
  
    swal("Digite el monto con el que el cliente paga:", {
     content: "input",
     })
   .then((value) => {
       if (value === false) return false;
         if (value === "" || value<total) {
           swal({
               title: "Error",
               text: "El monto ingresado no es valido",
               icon: "error",
               buttons: {
                 ok:{
                   text:"Aceptar",
                   value:"ok",
                 }
               },
               dangerMode: true,
           })
         }else{
           registrarPagoCuota(idVentaPorCobrar,(value-total));

         }
   });

}  

function registrarPagoCuota(idVentaPorCobrar,vuelto){
    idVentaPorCobrar=idVentaPorCobrar; 
   $(document).ready(function() {
      $.post('../../business/ventas/actionPagarVentas.php', {
          action: 'pagarVenta',
          idVentaPorCobrar: idVentaPorCobrar,
      },function(responseText) {
          if (responseText=="true") {
            swal({
                title: "Su cambio es de: "+vuelto,
                text: "¿Desea imprimir el comprobante de la cuota pagada?",
                icon: "success",
                buttons: {
                  cancelar:{
                    text:"Cancelar",
                    value:"cancel",
                  },
                  ok:{
                    text:"Aceptar",
                    value:"ok",
                  }
                },
                dangerMode: true,
            })
            .then((value) => {
                switch(value){
                  case "ok":
                    imprimir();
                    break;
                   case "cancel":

                     break;
                }
              });
          } else {
            swal("Oops, ha ocurrido un error al registrar el pago",{
              icon: "error",
            });
          }
          consultarVentasPorCobrar();
      });
    });
 }
 function consultarProductorCliente(html) {
    $(document).ready(function () {
        $.post('../../business/productor/actionProductorCliente.php', {
            action: 'consultarproductores'
        }, function (responseText) {
            json = JSON.parse(responseText);
            for (i = 0; i < json.length; i++) {
                idPersona = '"' + json[i].idpersona + '"';
                html += "<option value=" + idPersona + ">" + json[i].nombrepersona + " " + json[i].apellido1persona + " " + json[i].apellido2persona + "</option>";
            }
            $("#selectCliente").html(html);
        });
    });
}

 function consultaProductor() {
    $(document).ready(function () {
        $.post('../../business/productor/actionProductorSocio.php', {
            action: 'consultarproductores'
        }, function (responseText) {
            json = JSON.parse(responseText);
            html = "";
            for (i = 0; i < json.length; i++) {
                idPersona = '"' + json[i].idpersona + '"';
                html += "<option value=" + idPersona + ">" + json[i].nombrepersona + " " + json[i].apellido1persona + " " + json[i].apellido2persona + "</option>";
            }
            consultarProductorCliente(html);
        });
    });
}
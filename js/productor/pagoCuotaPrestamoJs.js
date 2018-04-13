function registrarPagoCuotaConfirmacion(){
    nombre = $('select[name="selectCliente"] option:selected').text();
    
    if($("#montoCuota").val() != ""){
      swal({
          title: "",
          text: "¿Estás seguro de registrar el pago de cuota  a nombre de  "+nombre+" por un monto de: "+$("#montoCuota").val()+" y un plazo de "+$("#plazoNumero").val()+" "+modoPlazo+"?",
          icon: "info",
          buttons: {
            cancel: true,
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
              registrarPagoCuota();
              break;
          }
        });
    }else{
      swal({
          title: "Error",
          text: "Hay campos requeridos sin completar",
          icon: "error",
          buttons: {
            ok:{
              text:"Aceptar",
              value:"ok",
            }
          },
          dangerMode: true,
      })
    }
  }

function registrarPagoCuota(){
    idProductor = $("#selectCliente").val();
    cuota = $("#montoCuota").val();
    saldoAnterior = $("#saldoActual").val();
  
   
    $(document).ready(function() {
       $.post('../../business/productor/actionPagoCuota.php', {
           action: 'registrarPagoCuota' ,
           idProductor: idProductor,
           cuota: cuota,
           saldoAnterior: saldoAnterior,
           
          
       },function(responseText) {
           if (responseText=="true") {
             swal({
                 title: "¡Se registró el pago correctamente!",
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
                     $("#montoPrestamo").val("");
                     $("#plazoNumero").val("");
                     break;
                    case "cancel":
                      $("#montoPrestamo").val("");
                      $("#plazoNumero").val("");
                      break;
                 }
               });
           } else {
             swal("Oops, ha ocurrido un error al registrar el pago",{
               icon: "error",
             });
           }
       });
     });
  }


  function mostrarCuota(){
    idProductor=document.getElementById("selectCliente").value;
    $('#listaProductores').dataTable().fnDestroy();
    $(document).ready(function() {
      $.post('../../business/productor/actionPagoCuota.php', {
              action : 'consultarCuota',
              id:idProductor,
      }, function(responseText) {
      
        json = JSON.parse(responseText);
        html = "";
        for(i = 0 ;i<json.length; i++){
          html+="<tr>";
          html+="<td>"+json[i].idprestamo+"</td>";
          html+="<td>"+json[i].montototalprestamo+"</td>";
          html+="<td>"+json[i].fechaprestamo+"</td>";
          html+="<td>"+json[i].montocuota+"</td>";
          html+="<td>"+json[i].saldoactualprestamoporcobrar+"</td>"
          html+='<td><a href="javascript:modalModificarSocio('+json[i].idprestamo+')"><span class="glyphicon glyphicon-credit-card"></span></a></td>';
          
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
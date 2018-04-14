

function modalAceptarSolicitud(idsolicitud){
         
     swal({
         title: "Confirmación",
         text: "¿Desea aprobar la solicitud?",
         icon: "info",
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
             $(document).ready(function() {
               $.post('../../business/productor/actionSolicitudPrestamo.php', {
                   action: 'aprobarsolicitud' ,
                   idsolicitud: idsolicitud,
                   
                 },function(responseText){
                   if(responseText=="true"){

                        swal({
                           title: "Confirmación",
                           text: "¡Se aprobó la solicitud correctamente!",
                           icon: "success",
                           buttons: {
                             
                             ok:{
                               text:"Aceptar",
                               value:"ok",
                             }
                           },
                           dangerMode: true,
                       });
                    
                     
                  }else{
                    swal({
                         title: "Confirmación",
                         text: "¡Opps! Ocurrió un error al tratar de aprobar la solicitud",
                         icon: "error",
                         buttons: {
                           
                           ok:{
                             text:"Aceptar",
                             value:"ok",
                           }
                         },
                         dangerMode: true,
                     });
                    
                   
                  }
                  mostrarSolicitudes();
               });
            });
             break;
            case "cancel":

              break;
         }
       });
  
  }

  function modalRechazarSolicitud(idsolicitud){
         
     swal({
         title: "Confirmación",
         text: "¿Desea rechazar la solicitud?",
         icon: "info",
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
             $(document).ready(function() {
               $.post('../../business/productor/actionSolicitudPrestamo.php', {
                   action: 'rechazarsolicitud' ,
                   idsolicitud: idsolicitud,
                   
                 },function(responseText){
                  if(responseText=="true"){

                        swal({
                           title: "Confirmación",
                           text: "¡Se rechazó la solicitud correctamente!",
                           icon: "success",
                           buttons: {
                             
                             ok:{
                               text:"Aceptar",
                               value:"ok",
                             }
                           },
                           dangerMode: true,
                       });
                      
                    
                  }else{
                    swal({
                         title: "Confirmación",
                         text: "¡Opps! Ocurrió un error al tratar de rechazar la solicitud",
                         icon: "error",
                         buttons: {
                           
                           ok:{
                             text:"Aceptar",
                             value:"ok",
                           }
                         },
                         dangerMode: true,
                     });
                    
                   
                  }
                  mostrarSolicitudes();
                  
               });
            });
             break;
            case "cancel":

              break;
         }
       });
  
  }


  function mostrarSolicitudes(){
    $('#listaProductores').dataTable().fnDestroy();
    $(document).ready(function() {
      $.post('../../business/productor/actionSolicitudPrestamo.php', {
              action : 'consultarSolicitud',
              
      }, function(responseText) {
        
        json = JSON.parse(responseText);
        html = "";
        for(i = 0 ;i<json.length; i++){
           
          cuota= (parseFloat(json[i].cantidadsolicitud)+parseFloat(json[i].cantidadsolicitud)*(parseFloat(json[i].porcentaje)/100))/parseFloat(json[i].plazo);               
          html+="<tr>";
          html+="<td>"+json[i].idsolicitud+"</td>";
          html+="<td>"+json[i].nombrepersona+" "+json[i].apellido1persona+" "+json[i].apellido2persona+"</td>";
          html+="<td>"+json[i].plazo+"</td>";
          html+="<td>"+json[i].tipopagoprestamo+"</td>";
          html+="<td>"+json[i].cantidadsolicitud+"</td>";
          html+="<td>"+json[i].porcentaje+"</td>";
          html+="<td>"+cuota+"</td>";
          html+="<td>"+json[i].fecha+"</td>";
          html+='<td><a style="margin-left:10px" href="javascript:modalAceptarSolicitud('+json[i].idsolicitud+')"><span class="glyphicon glyphicon-ok"></span></a>';
          html+='<a style="margin-left:10px" href="javascript:modalRechazarSolicitud('+json[i].idsolicitud+')"><span class="glyphicon glyphicon-remove"></span></a></td>';
          
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




function registrarSolicitudPrestamoConfirmacion(){
    nombre = $('select[name="selectCliente"] option:selected').text();
    modoPlazo = $('#plazoModo').val();
    if(modoPlazo=="mes"){
      modoPlazo+="(es)";
    }else{
      modoPlazo+="(s)";
    }
    if($("#plazoNumero").val() != "" && $("#montoPrestamo").val() != ""){
      swal({
          title: "",
          text: "¿Estás seguro de ingresar la solicitud de préstamo a "+nombre+" por un monto de: "+$("#montoPrestamo").val()+" y un plazo de "+$("#plazoNumero").val()+" "+modoPlazo+"?",
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
              registrarSolicitudPrestamo();
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

  function registrarSolicitudPrestamo(){
    idProductor = $("#selectCliente").val();
    interes = $("#interes").val();
    montoPrestamo = $("#montoPrestamo").val();
    plazo = $("#plazoNumero").val();
    modoPlazo = $("#plazoModo").val();
    $(document).ready(function() {
       $.post('../../business/productor/actionPrestamos.php', {
           action: 'registrarSolicitudPrestamo' ,
           idProductor: idProductor,
           interes: interes,
           montoPrestamo: montoPrestamo,
           plazo: plazo,
           modoPlazo: modoPlazo,
       },function(responseText) {
           if (responseText=="true") {
             swal({
                 title: "¡Se registró la solicitud correctamente! ",
                 text: "¿Desea imprimir el comprobante de la solicitud del préstamo?",
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
             swal("Oops, ha ocurrido un error al registrar la solicitud",{
               icon: "error",
             });
           }
       });
     });
  }

  function imprimir(){
    nombre = $('select[name="selectCliente"] option:selected').text();
    fecha = $("#fecha").val();
    interes = $("#interes").val();
    plazoNumero = $("#plazoNumero").val();
    plazoModo = $("#plazoModo").val();
    montoPrestamo = $("#montoPrestamo").val();
    location.href="../../view/facturas/imprimirComprobanteSolicitudPrestamo.php?nombreCliente="+nombre+"&fecha="+fecha+"&interes="+interes+"&plazo="+plazoNumero+"&modoPlazo="+plazoModo+"&montoSolicitado="+montoPrestamo+"&cuota="+calcularCuota()+"&total="+calcularTotalPagar();
  }

  function calcularCuota(){
    plazo = $("#plazoNumero").val();
    cuota=calcularTotalPagar();
    cuota = cuota/plazo;
    return cuota;
  }

  function calcularTotalPagar(){
    interes = $("#interes").val();
    montoPrestamo = $("#montoPrestamo").val();
    cuota = (((montoPrestamo*interes)/100)+parseFloat(montoPrestamo));
    return cuota;
  }
  function consultarCouta(){
    modoPlazo = $("#plazoModo").val();
    if(modoPlazo == "semana"){
      modoPlazo = "semanal";
    }else if(modoPlazo == "mes"){
      modoPlazo = "mensual";
    }else{
      modoPlazo = "quincenal";
    }
    swal("La cuota "+modoPlazo+" es de: "+calcularCuota(),{
      icon: "info",
    });
  }
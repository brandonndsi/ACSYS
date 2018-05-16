function mostrarMontoLecheSemanalTotal(){
  $('#listaProductores').dataTable().fnDestroy();
  $(document).ready(function() {
      $.post('../../business/productor/actionPagarLeche.php', {
              action : 'consultarMontoLeche',
      }, function(responseText) {

        json = JSON.parse(responseText);
        html = "";

        for(i = 0 ;i<json.length; i++){
          html+="<tr>";
          html+="<td>"+json[i].documentoidentidad+"</td>";
          html+="<td>"+json[i].nombre+" "+json[i].apellido1+" "+json[i].apellido2+"</td>";
          html+="<td>"+json[i].litros+"</td>";
          html+="<td>"+json[i].total+"</td>";

          documentoidentidad=json[i].documentoidentidad;
          nombre=json[i].nombre+" "+json[i].apellido1+" "+json[i].apellido2;
          cantidadlitros=json[i].litros;
          totalsemanal=json[i].total;
          id=json[i].id;
          tipo=json[i].tipo;
          productor="'"+id+"-"+cantidadlitros+"-"+tipo+"'" ;
          html+='<td><a href="javascript:modalPagarLeche('+productor+')"><span class="glyphicon glyphicon-credit-card"></span></a></td>';

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

function modalPagarLeche(productor){
    swal({
        title: "",
        text: "¿Estás seguro de realizar este pago?",
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
            pagarMontoLeche(productor);
            break;
        }
  });
}

function pagarMontoLeche(productor){

  productorArray=productor.split("-");
  idProductor=productorArray[0];
  tipo=productorArray[2];
  litros=productorArray[1];

   $(document).ready(function() {
      $.post('../../business/productor/actionPagarLeche.php', {

              action : 'pagarMontoLeche' ,
              idProductor:idProductor,
              tipo:tipo,
              litros:litros,

      }, function(responseText) {
        alert(responseText);
        json=JSON.parse(responseText);
        imprimirFactura(json);
            
        mostrarMontoLecheSemanalTotal();

      });
  });

}


function imprimirFactura(json){
  
  //window.location.replace("view/ventas/veterinario.php");
  window.open("../../view/facturas/imprimirPagoLechePDF.php?precioleche="+json.precioleche+"&&totallitros="+json.totallitros+"&&montototalcolonesahorro="+json.montototalcolonesahorro+"&&id="+json.id+"&&montototalpagarlitros="+json.montototalpagarlitros+"&&montoahorro="+json.montoahorro+"&&fecha="+json.fecha, "popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
}

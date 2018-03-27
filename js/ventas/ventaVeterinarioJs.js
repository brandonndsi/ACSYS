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

function procesarVenta(){
  $(document).ready(function () {
      $.post('../../business/ventas/actionVentaVeterinaria.php', {
            action : 'procesarVenta',
            productos:localStorage.getItem("listaProductos"),
            idCliente:document.getElementById('selectCliente').value,
            totalNeto:document.getElementById('totalPagar').value,
            totalBruto:document.getElementById('totalPagar').value,
      }, function(responseText) {

          //alert(responseText);
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
          listaProductos.push({"codigo":code,"nombre":json.nombreproductoveterinario,"precio":json.precioproductoveterinario,"cantidad":1});
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
            listaProductos.push({"codigo":code,"nombre":json.nombreproductoveterinario,"precio":json.precioproductoveterinario,"cantidad":1});
          }
          localStorage.setItem("listaProductos",JSON.stringify(listaProductos));
        }
        listaProductos = JSON.parse(localStorage.getItem("listaProductos"));
        html = "";
        total = 0;
        for(i = 0 ;i<listaProductos.length; i++){
          html+="<tr>";
          html+="<td>"+listaProductos[i].codigo+"</td>";
          html+="<td>"+listaProductos[i].nombre+"</td>";
          html+="<td>"+listaProductos[i].precio+"</td>";
          codigo = '"'+listaProductos[i].codigo+'"';
          html+="<td><input id='cantidad"+listaProductos[i].codigo+"' onblur='calcularSubTotal(this,"+codigo+")' type='text' style='border:none;' value='"+listaProductos[i].cantidad+"'> </td>";
          html+="<td><input id='subtotal"+listaProductos[i].codigo+"' type='text'style='border:none;' readonly='readonly' value='"+(listaProductos[i].precio*listaProductos[i].cantidad)+"'></td>";
          html+="<td><button onClick='eliminarArticuloCarrito("+codigo+")'><span class='glyphicon glyphicon-remove'></span></button></td>";
          html+="</tr>";
          total= total + (listaProductos[i].precio*listaProductos[i].cantidad);
        }
        document.getElementById('totalPagar').value=total;
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

function calcularSubTotal(cantidad,codigoProducto){
  listaProductos = JSON.parse(localStorage.getItem("listaProductos"));
  for(i = 0 ;i<listaProductos.length; i++){
    if(listaProductos[i].codigo == codigoProducto){
      total = $("#totalPagar").val() - (listaProductos[i].cantidad*listaProductos[i].precio);
      listaProductos[i].cantidad = cantidad.value;
      total = total + (listaProductos[i].cantidad*listaProductos[i].precio);
      $("#subtotal"+codigoProducto).val((listaProductos[i].cantidad*listaProductos[i].precio));
      $("#totalPagar").val(total)
    }
  }
  localStorage.setItem("listaProductos",JSON.stringify(listaProductos));
}

function getRadioButtonSelectedValue(ctrl){
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
}
/**
 * [eliminarArticuloCarrito descripción]
 * @param  {entero} code [Es el tipo de codigo del articulo a eliminar de la lista]
 * @return {arreglo}      [Elimina el arituculo de la lista y sobre escribe los datos de la tabla carrito.]
 */
function eliminarArticuloCarrito(code){
    //alert(code);
    $('#listaProductosLacteos').dataTable().fnDestroy();
    if (localStorage.getItem("listaProductos") != null) {
    listaProductos = JSON.parse(localStorage.getItem("listaProductos"));
    for (i = 0; i < listaProductos.length; i++) {
                    if (listaProductos[i].codigo === code) {
                        listaProductos.splice(i,1);
                       //localStorage.setItem("listaProductos", JSON.stringify(listaProductos));
                    }
                }
localStorage.setItem("listaProductos", JSON.stringify(listaProductos));
}

listaProductos = JSON.parse(localStorage.getItem("listaProductos"));
            html = "";
            total = 0;
            for (i = 0; i < listaProductos.length; i++) {
                html += "<tr>";
                html += "<td>" + listaProductos[i].codigo + "</td>";
                html += "<td>" + listaProductos[i].nombre + "</td>";
                html += "<td>" + listaProductos[i].precio + "</td>";
                codigo = '"' + listaProductos[i].codigo + '"';
                html += "<td><input id='cantidad" + listaProductos[i].codigo + "' onblur='calcularSubTotal(this," + codigo + ")' type='text' style='border:none;' value='" + listaProductos[i].cantidad + "'> </td>";
                html += "<td><input id='subtotal" + listaProductos[i].codigo + "' type='text'style='border:none;' readonly='readonly' value='" + (listaProductos[i].precio * listaProductos[i].cantidad) + "'></td>";
                html += "<td><button onClick='eliminarArticuloCarrito("+codigo+")' id='btnEliminarCar'><span class='glyphicon glyphicon-remove'></span></button></td>";
                html += "</tr>";
                total = total + (listaProductos[i].precio * listaProductos[i].cantidad);
            }
            document.getElementById('totalPagar').value = total;
            $("#datos").html(html);
           $(document).ready(function () {
                $('#listaProductosLacteos').DataTable({
                    "bDeferRender": true,
                    "sordering": true,
                    "responsive": true,
                    "ordering": true,
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

    //alert(codigo+" y el codigo es: "+code);

}

function carry() {

    var carrito = [];
    var idCliente = document.getElementById('selectCliente').value;
    //var d=llenarDatosCliente(idCliente);
    var totalNeto = document.getElementById('totalPagar').value;
    var totalBruto = document.getElementById('totalPagar').value;
    var tipoVenta = "Veterinario";

    $(document).ready(function () {
        $.post('../../business/ventas/actionVentaDistribuidor.php', {
            action: 'procesarVenta',
            idCliente: idCliente,
            productos:localStorage.getItem("listaProductos"),
            totalBruto: totalBruto,
            totalNeto: totalNeto
        }, function (responseText) {
            console.log(responseText);
            datosTabla = "";
            total = 0;
            carrito = JSON.parse(localStorage.getItem("listaProductos"));
            for (i = 0; i < carrito.length; i++) {
                datosTabla += "<table>";
                datosTabla += "<tr>";
                datosTabla += "<td>" + carrito[i].codigo + "</td>";
                datosTabla += "<td>" + carrito[i].nombre + "</td>";
                datosTabla += "<td>" + carrito[i].precio + "</td>";
                datosTabla += "<td>" + carrito[i].cantidad + "</td>";
                //datosTabla += "<td>" + totalBruto + "</td>";
                datosTabla += "</tr>";
            }
                datosTabla += "<td colspan='3'><b>TOTAL: </d></td>";
                datosTabla += "<td>" + totalBruto + "</td>";
                datosTabla += "</table>";
            $("#Re_ventaProductos").html(datosTabla);///modificar los datos para poder metre los datos.
           // document.getElementById("Re_recibo").value = responseText;
            if(idCliente!=0){
                $.post("../../business/ventas/actionVentaDistribuidor.php",{
                    action: 'nombrecompleto',
                    idClient: idCliente
                        },function (responseText){
                             console.log(responseText);
                                // alert(responseText);
                             document.getElementById("Re_cliente").value =responseText;
                });
        
            }else{
                    document.getElementById("Re_cliente").value =idCliente;
            }
            //alert(d);
            //document.getElementById("Re_cliente").value =d;
            //Re_recibo

            document.getElementById("Re_cliente").value = idCliente;
            document.getElementById("Re_tipoVenta").value = tipoVenta;
            
        });
    });
    /*funcion para obtener lo que es el numero de faltura*/
    var dato;
  $.post("../../business/ventas/actionVentaDistribuidor.php",{
            action: 'idfactura'
        },function (responseText){
            console.log(responseText);
            //alert(responseText);
            dato=responseText;
            dato++;
            document.getElementById("Re_recibo").value =dato;
            //alert(dato);
        }); 
    /*terminacion para poder optener el numero de factura.*/
    $("#modalRecibo").modal();
}

function ImprimirFactura(){
numerofactura=document.getElementById("Re_recibo").value;
totalBB = document.getElementById('totalPagar').value;
id = document.getElementById('selectCliente').value;
//window.location.replace("view/ventas/veterinario.php");
window.open("http://localhost/ACSYSIIIsemestre/view/facturas/imprimirPDF.php?numerofactura="+numerofactura+"&&lista="+localStorage.getItem("listaProductos")+"&&total="+totalBB+"&&tipo=Veterinario"+"&&id="+id, "popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
}
function redireccionamiento(){
  location.href = '../../view/ventas/veterinario.php';
}
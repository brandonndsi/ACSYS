
window.onload=function(){
cargarTablaLacteos();
consultarProductor();
};

function cargarTablaLacteos() {
    $(document).ready(function () {
        $('#listaProductosLacteos').DataTable({ ////////////////////////////////////////////////////////
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

function cargar_modal_tambien_llenar_dato1(){

    $('#modalProductosVentanilla').modal();
}
function redireccionamiento_a_la_pagina_sin_factura(){
    confirmacion_sin_factura();
}
function redireccionamiento_a_la_misma_clase(){
    //window.location.href = '../../view/ventas/distribuidor.php';
    modalConfirmar_La_Limpieza_del_Carrito();
}
function confirmacion_sin_factura(){
    swal({
                    title: "Sin factura",
                    text: "Venta procesada sin factura exitozamente.",
                    icon: "success",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            value: "ok"
                        }

                    },
                    dangerMode: true
                });
     window.location.href = '../../view/ventas/distribuidor.php';
}
function confirmacion_redireccionamiento(){
     swal({
                    title: "Carrito",
                    text: "El carrito de compras fue eliminado.",
                    icon: "success",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            value: "ok"
                        }

                    },
                    dangerMode: true
                });
     window.location.href = '../../view/ventas/distribuidor.php';
}
function modalConfirmar_La_Limpieza_del_Carrito(){
    botones = "<p><button data-dismiss='modal' id='arreglo' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button onclick='confirmacion_redireccionamiento();' data-dismiss='modal' class='btn btn-primary'>Aceptar</button></p>";
    $("#botonesEliminar").html(botones);
    $("#modalEliminar").modal();
}
function acciones_de_los_botones_principales(){
    
    carry();
    cargar();
   
}
function consultarProductorCliente(html) {
    $(document).ready(function () {
        $.post('../../business/distribuidor/DistribuidorAccion.php', {
            action: 'consultarDistribuidor'
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
function consultarProductor() {
    $(document).ready(function () {
        $.post('../../business/distribuidor/DistribuidorAccion.php', {
            action: 'consultarDistribuidor'
        }, function (responseText) {
            json = JSON.parse(responseText);
            html = "";
            /*html += "<option value='0'</option>";*/
            for (i = 0; i < json.length; i++) {
                idPersona = '"' + json[i].idpersona + '"';
                //html += "<option value=" + idPersona + ">" + json[i].nombrepersona + " " + json[i].apellido1persona + " " + json[i].apellido2persona + "</option>";
            }
            consultarProductorCliente(html);
        });
    });
}

function cargar() {
    $('#buscarProductos').dataTable().fnDestroy();
    $('#datos1').html("");
    document.getElementById("productoBuscar").value = "";
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

function Auto() {
    $('#buscarProductos').dataTable().fnDestroy();
    $(document).ready(function () {
        $.post('../../data/autocomplete/Auto_Distribuidor.php', {
            term: document.getElementById("productoBuscar").value
        }, function (responseText) {
            json = JSON.parse(responseText);
            html = "";
            for (i = 0; i < json.length; i++) {
                html += "<tr>";
                codigoProducto = "'" + json[i].codigoproductoslacteos + "'";
                html += "<td>" + json[i].codigoproductoslacteos + "</td>";
                html += "<td>" + json[i].nombreproductolacteo + "</td>";
                html += "<td>" + json[i].preciounitarioproductolacteo + "</td>";
                html += "<td><input id='radios' name='radios' type='radio' value=" + codigoProducto + "></td>";
                html += "</tr>";
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

function addCarrito() {
    $('#listaProductosLacteos').dataTable().fnDestroy();
    var code = $('input:radio[name=radios]:checked').val();
    
    $(document).ready(function () {
        $.post('../../business/ventas/actionVentaDistribuidor.php', {
            action: 'searchDairyProduct',
            code: code
        }, function (responseText) {
            json = JSON.parse(responseText);
            console.log(json);
            if (localStorage.getItem("listaProductos") === null) {
                var listaProductos = [];
                listaProductos.push({"codigo": code, "nombre": json.nombreproductolacteo, "precio": json.preciounitarioproductolacteo, "cantidad": 1,"descuento":0});
                localStorage.setItem("listaProductos", JSON.stringify(listaProductos));
            } else {
                listaProductos = JSON.parse(localStorage.getItem("listaProductos"));
                bandera = false;
                for (i = 0; i < listaProductos.length; i++) {
                    if (listaProductos[i].codigo === code) {
                        listaProductos[i].cantidad = listaProductos[i].cantidad + 1;
                        bandera = true;
                    }
                }
                if (!bandera) {
                    listaProductos.push({"codigo": code, "nombre": json.nombreproductolacteo, "precio": json.preciounitarioproductolacteo, "cantidad": 1,"descuento": 0});
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
                html += "<td><input id='descuento" + listaProductos[i].codigo + "' onblur='descuentoSubTotal(this," + codigo + ")' type='text' style='border:none;' value='" + listaProductos[i].descuento + "'> </td>";
                html += "<td><input id='subtotal" + listaProductos[i].codigo + "' type='text'style='border:none;' readonly='readonly' value='" + (listaProductos[i].precio * listaProductos[i].cantidad) + "'></td>";
                html += "<td><button onClick='eliminarArticuloCarrito("+codigo+")'><span class='glyphicon glyphicon-remove'></span></button></td>";
                html += "</tr>";
               
                total = total + (listaProductos[i].precio * listaProductos[i].cantidad)-listaProductos[i].descuento;/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            }
            document.getElementById('totalPagar').value = total;
            $("#datos").html(html);
           $(document).ready(function () {
                $('#listaProductosLacteos').DataTable({
                    "bDeferRender": true,
                    "sordering": true,
                    "responsive": true,
                    "destroy": true,
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
function descuentoSubTotal(descuento, codigoProducto) {

    listaProducto = JSON.parse(localStorage.getItem("listaProductos"));

    total = 0;
    for (i = 0; i < listaProducto.length; i++) {
        if (listaProducto[i].codigo === codigoProducto) {

            cantidad = listaProducto[i].cantidad;
            listaProducto[i].descuento = document.getElementById("descuento"+codigoProducto).value;
            descuento = listaProducto[i].descuento;
            descuento = descuento * cantidad;
            bruto = listaProducto[i].cantidad * listaProducto[i].precio;
            neto = bruto - descuento;
            total = total + neto;

            $("#subtotal" + codigoProducto).val(neto);
            $("#totalPagar").val(total);
        } else {
            cantidad = lista[i].cantidad;
            descuento = lista[i].descuento;
            descuento = descuento * cantidad;
            bruto = lista[i].cantidad * lista[i].precio;
            neto = bruto - descuento;
            total = total + neto;

            $("#totalPagar").val(total);
        }
    }
    localStorage.setItem("listaProductos", JSON.stringify(listaProducto));
}
function calcularSubTotal(cantidad, codigoProducto) {
    listaProductos = JSON.parse(localStorage.getItem("listaProductos"));
    for (i = 0; i < listaProductos.length; i++) {
        if (listaProductos[i].codigo === codigoProducto) {
            total = $("#totalPagar").val() - (listaProductos[i].cantidad * listaProductos[i].precio);
            listaProductos[i].cantidad = cantidad.value;
            total = total + (listaProductos[i].cantidad * listaProductos[i].precio);
            $("#subtotal" + codigoProducto).val((listaProductos[i].cantidad * listaProductos[i].precio));
            $("#totalPagar").val(total);
        }
    }
    localStorage.setItem("listaProductos", JSON.stringify(listaProductos));
}

function getRadioButtonSelectedValue(ctrl) {
    for (i = 0; i < ctrl.length; i++)
        if (ctrl[i].checked)
            return ctrl[i].value;
}
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
                html += "<td><input id='descuento" + listaProductos[i].codigo + "' onblur='descuentoSubTotal(this," + codigo + ")' type='text' style='border:none;' value='" + listaProductos[i].descuento + "'> </td>";
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
function llenarDatosCliente(idCliente){
    var nombreCompleto="";
    if(idCliente!=0){
        $.post("../../business/ventas/actionVentaDistribuidor.php",{
            action: 'nombrecompleto',
            idClient: idCliente
        },function (responseText){
            //console.log(responseText);
            //alert(responseText);
            nombreCompleto=responseText;
        });
        
        }else{
                nombreCompleto=idCliente;
            }
     return nombreCompleto;
}

function carry() {

    var carrito = [];
    var idCliente = document.getElementById('selectCliente').value;
    //var d=llenarDatosCliente(idCliente);
    var totalNeto = document.getElementById('totalPagar').value;
    var totalBruto = document.getElementById('totalPagar').value;
    var tipoVenta = "Distribuidor";
    carrito = JSON.parse(localStorage.getItem("listaProductos"));
    console.log(carrito);
if (carrito != null) {
    $(document).ready(function () {
        $.post('../../business/ventas/actionVentaDistribuidor.php', {
            action: 'procesarVenta',
            idCliente:document.getElementById('selectCliente').value,
            productos:localStorage.getItem("listaProductos"),
            totalBruto:document.getElementById('totalPagar').value,
            totalNeto: document.getElementById('totalPagar').value,
        }, function (responseText) {
           console.log(responseText);
           
            datosTabla = "";
            total = 0;
            //console.log(listaProductos);
            //carrito = JSON.parse(localStorage.getItem("listaProductos"));
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
                datosTabla += "<td colspan='3'><b>TOTAL: </b></td>";
                datosTabla += "<td>" + totalBruto + "</td>";
                datosTabla += "</table>";
            $("#Re_ventaProductos").html(datosTabla);///modificar los datos para poder metre los datos.
           // document.getElementById("Re_recibo").value = responseText;
            if(idCliente!=0){
                $.post("../../business/ventas/actionVentaDistribuidor.php",{
                    action: 'nombrecompleto',
                    idClient: idCliente
                        },function (responseText){
                             //console.log(responseText);
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
            console.log(responseText);/////////////////////////////////////
            //alert(responseText);
            dato=responseText;
            //dato++;
            document.getElementById("Re_recibo").value =dato;
            //alert(dato);
        }); 
    /*terminacion para poder optener el numero de factura.*/
    $("#modalRecibo").modal();
    //redireccionamiento();
  //ImprimirFactura();
}else{
     swal({
                    title: "Venta Distribuidor",
                    text: "El carrito esta vacio. Favor ingresar un articulo minimo.",
                    icon: "error",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            value: "ok"
                        }

                    },
                    dangerMode: true
                });
    //Mensaje de que no hay ningun articulo en el carrito de compras.
}
}

function ImprimirFactura(){
numerofactura=document.getElementById("Re_recibo").value;
totalBB = document.getElementById('totalPagar').value;
id = document.getElementById('selectCliente').value;
window.open("../../view/facturas/imprimirPDF.php?numerofactura="+numerofactura+"&&lista="+localStorage.getItem("listaProductos")+"&&total="+totalBB+"&&tipo=Distribuidor"+"&&id="+id, "popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
localStorage.clear();
redireccionamiento();
}


function procesarVenta(){
  $.post('../../business/ventas/actionVentaDistribuidor.php', {
            action: 'procesarVenta',
            productos:localStorage.getItem("listaProductos"),
            idCliente:document.getElementById('selectCliente').value,
            totalNeto:document.getElementById('totalPagar').value,
            totalBruto:document.getElementById('totalPagar').value,
      }, function(responseText) {

          console.log(responseText);
      });
    }

function redireccionamiento(){
 window.location.href = '../../view/ventas/distribuidor.php';
}
//window.location.href = '../../view/ventas/distribuidor.php';
function cargarTablaLacteo() {
    $(document).ready(function () {
        $('#listaProductosLacteos').DataTable({
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

function buscarProductos() {
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
            html += "<option value='0'>Contado</option>";
            for (i = 0; i < json.length; i++) {
                idPersona = '"' + json[i].idpersona + '"';
                html += "<option value=" + idPersona + ">" + json[i].nombrepersona + " " + json[i].apellido1persona + " " + json[i].apellido2persona + "</option>";
            }
            consultarProductorCliente(html);
        });
    });
}

function accionPrincipal() {
    procesa();
    carga();
}

function carga() {
    $('#buscarProductos').dataTable().fnDestroy();
    $('#datos1').html("");
    document.getElementById("productoBuscar").value = "";
    buscarProductos();

    botones = "<p><button data-dismiss='modal' class='btn btn-danger' id='btn-cancelar' data-dismiss='modal'>Cancelar</button> ";
    botones += " <button data-dismiss='modal' onclick='addCarrito();' class='btn btn-primary' id='btn-enviar'>Agregar</button></p>";
    $("#foo").html(botones);
    $('#btn-enviar').attr("disabled", true);

}

function modalCancelarVenta() {
    swal({
        title: "Confirmación",
        text: "¿Desea aprobar la solicitud?",
        icon: "warning",
        buttons: {
            cancelar: {
                text: "Cancelar",
                value: "cancel"
            },
            ok: {
                text: "Aceptar",
                value: "ok"
            }
        },
        dangerMode: true
    })
            .then((value) => {
                switch (value) {
                    case "ok":
                        mensajeCarritoEliminado();
                        break;
                    case "cancel":
                        break;
                }
            });
}

function mensajeCarritoEliminado() {

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
    recargar();
}

function sinFactura() {
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
    recargar();
}

function recargar() {

    var table = $('#listaProductosLacteos').DataTable();

    table
            .clear()
            .draw();
    localStorage.clear();

    document.getElementById("totalPagar").value = "";
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
                html += "<td><input onclick='validarProductoCheck()' id='radios' name='radios' type='radio' value=" + codigoProducto + "></td>";
                html += "</tr>";
            }
            $('#datos1').html(html);
            buscarProductos();
        });
    });
}

function validarProductoCheck() {
    $('#btn-enviar').attr("disabled", false);
}

function addCarrito() {
    $('#listaProductosLacteos').dataTable().fnDestroy();
    var code = $('input:radio[name=radios]:checked').val();
    $(document).ready(function () {
        $.post('../../business/ventas/actionVentaVentanilla.php', {
            action: 'searchDairyProduct',
            code: code
        }, function (responseText) {
            json = JSON.parse(responseText);
            if (localStorage.getItem("listaProductos") === null) {
                var listaProductos = [];
                listaProductos.push({"codigo": code, "nombre": json.nombreproductolacteo, "precio": json.preciounitarioproductolacteo, "cantidad": 1, "descuento": 0});
                localStorage.setItem("listaProductos", JSON.stringify(listaProductos));
            } else {
                listaProductos = JSON.parse(localStorage.getItem("listaProductos"));
                bandera = false;
                for (i = 0; i < listaProductos.length; i++) {
                    if (listaProductos[i].codigo == code) {
                        var cantidad = listaProductos[i].cantidad;
                        cantidad = parseInt(cantidad)+1;
                        listaProductos[i].cantidad = cantidad;
                        bandera = true;
                    }
                }
                if (!bandera) {
                    listaProductos.push({"codigo": code, "nombre": json.nombreproductolacteo, "precio": json.preciounitarioproductolacteo, "cantidad": 1, "descuento": 0});
                }
                localStorage.setItem("listaProductos", JSON.stringify(listaProductos));
            }
            listaProductos = JSON.parse(localStorage.getItem("listaProductos"));
            html = "";
            bruto = 0;
            descuento = 0;
            neto = 0;
            total = 0;
            for (i = 0; i < listaProductos.length; i++) {
                codigo = '"' + listaProductos[i].codigo + '"';
                html += "<tr>";
                html += "<td>" + listaProductos[i].codigo + "</td>";
                html += "<td>" + listaProductos[i].nombre + "</td>";
                html += "<td>" + listaProductos[i].precio + "</td>";
                html += "<td><input id='cantidad" + listaProductos[i].codigo + "' onblur='calcularSubTotal(this," + codigo + ")' type='text' style='border:none;' value='" + listaProductos[i].cantidad + "'></td>";
                html += "<td><input id='descuento" + listaProductos[i].codigo + "' onblur='calcularDescuentoSubTotal(this," + codigo + ")' type='text' style='border:none;' value='" + listaProductos[i].descuento + "'></td>";
                html += "<td><input id='subtotal" + listaProductos[i].codigo + "' type='text'style='border:none;' readonly='readonly' value='" + ((listaProductos[i].precio * listaProductos[i].cantidad) - listaProductos[i].descuento) + "'></td>";
                html += "<td><button onClick='eliminarArticuloCarrito(" + codigo + ")'><span class='glyphicon glyphicon-remove'></span></button></td>";
                html += "</tr>";
                bruto = bruto + (listaProductos[i].precio * listaProductos[i].cantidad) - listaProductos[i].descuento;
            }

            document.getElementById('totalPagar').value = bruto;
            $("#datos").html(html);
            cargarTablaLacteo();
        });
    });
}

function calcularSubTotal(cantidad, codigoProducto) {

    lista = JSON.parse(localStorage.getItem("listaProductos"));
    condicionCantidad = document.getElementById("cantidad" + codigoProducto).value;
    total = 0;
    if (condicionCantidad === "" || condicionCantidad == 0) {
        eliminarArticuloCarrito(codigoProducto);
    } else {
        for (i = 0; i < lista.length; i++) {
            if (lista[i].codigo === codigoProducto) {

                lista[i].cantidad = document.getElementById("cantidad" + codigoProducto).value;
                cantidad = lista[i].cantidad;
                descuento = lista[i].descuento;
                descuento = descuento * cantidad;
                bruto = lista[i].cantidad * lista[i].precio;
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
        localStorage.setItem("listaProductos", JSON.stringify(lista));
    }
}

function calcularDescuentoSubTotal(descuento, codigoProducto) {

    listaProducto = JSON.parse(localStorage.getItem("listaProductos"));

    total = 0;
    for (i = 0; i < listaProducto.length; i++) {
        if (listaProducto[i].codigo === codigoProducto) {

            cantidad = listaProducto[i].cantidad;
            listaProducto[i].descuento = document.getElementById("descuento" + codigoProducto).value;
            descuento = listaProducto[i].descuento;
            descuento = descuento * cantidad;
            bruto = listaProducto[i].cantidad * listaProducto[i].precio;
            neto = bruto - descuento;
            total = total + neto;

            $("#subtotal" + codigoProducto).val(neto);
            $("#totalPagar").val(total);
        } else {
            cantidad = listaProducto[i].cantidad;
            descuento = listaProducto[i].descuento;
            descuento = descuento * cantidad;
            bruto = listaProducto[i].cantidad * listaProducto[i].precio;
            neto = bruto - descuento;
            total = total + neto;

            $("#totalPagar").val(total);
        }
    }
    localStorage.setItem("listaProductos", JSON.stringify(listaProducto));
}

function getRadioButtonSelectedValue(ctrl) {
    for (i = 0; i < ctrl.length; i++)
        if (ctrl[i].checked)
            return ctrl[i].value;
}

function eliminarArticuloCarrito(code) {
    $('#listaProductosLacteos').dataTable().fnDestroy();
    if (localStorage.getItem("listaProductos") !== null) {
        listaProductos = JSON.parse(localStorage.getItem("listaProductos"));
        for (i = 0; i < listaProductos.length; i++) {
            if (listaProductos[i].codigo === code) {
                listaProductos.splice(i, 1);
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
        html += "<td><input id='descuento" + listaProductos[i].codigo + "' onblur='calcularDescuentoSubTotal(this," + codigo + ")' type='text' style='border:none;' value='" + listaProductos[i].descuento + "'></td>";
        html += "<td><input id='subtotal" + listaProductos[i].codigo + "' type='text'style='border:none;' readonly='readonly' value='" + (listaProductos[i].precio * listaProductos[i].cantidad) + "'></td>";
        html += "<td><button onClick='eliminarArticuloCarrito(" + codigo + ")' id='btnEliminarCar'><span class='glyphicon glyphicon-remove'></span></button></td>";
        html += "</tr>";
        total = total + (listaProductos[i].precio * listaProductos[i].cantidad);
    }
    document.getElementById('totalPagar').value = total;
    $("#datos").html(html);
    cargarTablaLacteo();
}

function procesa() {

    var carrito = [];
    var idCliente = document.getElementById('selectCliente').value;
    var totalNeto = document.getElementById('totalPagar').value;
    var totalBruto = document.getElementById('totalPagar').value;
    var tipoVenta = "Ventanilla";

    var carrito = JSON.parse(localStorage.getItem("listaProductos"));

    if ($.isEmptyObject(carrito)) {
        carrito = null;
    } else {
        console.log(carrito);
    }

    if (carrito !== null) {
        $(document).ready(function () {
            $.post('../../business/ventas/actionVentaVentanilla.php', {
                action: 'procesarVenta',
                idCliente: idCliente,
                productos: localStorage.getItem("listaProductos"),
                totalBruto: totalBruto,
                totalNeto: totalNeto
            }, function (responseText) {

                console.log(responseText);
                datosTabla = "";
                total = 0;
                /*carrito = JSON.parse(localStorage.getItem("listaProductos"));

                for (i = 0; i < carrito.length; i++) {
                    datosTabla += "<table>";
                    datosTabla += "<tr>";
                    datosTabla += "<td>" + carrito[i].codigo + "</td>";
                    datosTabla += "<td>" + carrito[i].nombre + "</td>";
                    datosTabla += "<td>" + carrito[i].precio + "</td>";
                    datosTabla += "<td>" + carrito[i].cantidad + "</td>";
                    datosTabla += "</tr>";
                }
                datosTabla += "<td colspan='3'><b>TOTAL: </d></td>";
                datosTabla += "<td>" + totalBruto + "</td>";
                datosTabla += "</table>";*/
                $("#Re_ventaProductos").html(datosTabla);///modificar los datos para poder metre los datos.

                var cliente = idCliente;
                if (cliente == 0) {
                    cliente = "Contado";
                } else {
                    buscarNombre(idCliente);
                }
                document.getElementById("Re_cliente").value = cliente;
                document.getElementById("Re_tipoVenta").value = tipoVenta;
            });
        });
        numeroFactura();
        //$("#modalRecibo").modal();

    } else {
        swal({
            title: "Error",
            text: "¡Opps! No se realizó la venta ya que no hay productos para vender",
            icon: "error",
            buttons: {
                ok: {
                    text: "Aceptar",
                    value: "ok"
                }
            },
            dangerMode: true
        });
    }
}

function buscarNombre(idCliente) {

    $.post("../../business/ventas/actionVentaDistribuidor.php", {
        action: 'nombrecompleto',
        idClient: idCliente
    }, function (responseText) {
        console.log(responseText);
        document.getElementById("Re_cliente").value = responseText;
    });
}

function numeroFactura() {
    /*funcion para obtener lo que es el numero de factura*/
    var dato;
    $.post("../../business/ventas/actionVentaVentanilla.php", {
        action: 'idfactura'
    }, function (responseText) {
        console.log(responseText);
        dato = responseText;
        dato++;
        //document.getElementById("idfactura").value = dato;
        $(idfactura).val(dato);
        ImprimirFactura(dato);
    });
    /*terminacion para poder optener el numero de factura.*/
    //$("#modalRecibo").modal();
}

function ImprimirFactura(dato) {
    //numerofactura = document.getElementById('idfactura').value;
    numerofactura = dato;
    totalBB = document.getElementById('totalPagar').value;
    id = document.getElementById('selectCliente').value;
    window.open("http://asoprolesa-saucetico/view/facturas/imprimirPDF.php?numerofactura=" + numerofactura + "&&lista=" + localStorage.getItem("listaProductos") + "&&total=" + totalBB + "&&tipo=Ventanilla" + "&&id=" + id, "popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
    recargar();
}

/* global swal */

//mostrar empleados//
function mostrarEmpleados() {
    $('#listaEmpleados').dataTable().fnDestroy();
    $(document).ready(function () {
        $.post('../../business/empleado/actionEmpleado.php', {
            action: 'consultarempleados'
        }, function (responseText) {
            json = JSON.parse(responseText);
            html = "";

            for (i = 0; i < json.length; i++) {
                html += "<tr>";
                html += "<td>" + json[i].documentoidentidadpersona + "</td>";
                html += "<td>" + json[i].nombrepersona + "</td>";
                html += "<td>" + json[i].apellido1persona + "</td>";
                html += "<td>" + json[i].apellido2persona + "</td>";
                html += "<td>" + json[i].telefonopersona + "</td>";
                html += "<td>" + json[i].direccionpersona + "</td>";
                html += "<td>" + json[i].correopersona + "</td>";

                documentoidentidad = json[i].documentoidentidadpersona;
                nombre = json[i].nombrepersona;
                primerapellido = json[i].apellido1persona;
                segundoapellido = json[i].apellido2persona;
                telefono = json[i].telefonopersona;
                direccion = json[i].direccionpersona;
                correo = json[i].correopersona;
                clave = json[i].passwordempleado;
                tipo = json[i].tipoempleado;
                id = json[i].idpersona;

                empleado = "'" + documentoidentidad + "," + nombre + "," + primerapellido + "," + segundoapellido + "," +
                        telefono + "," + direccion + "," + correo + "," + clave + "," + tipo + "," + id + "'";

                html += '<td><a href="javascript:modalModificarEmpleado(' + empleado + ')"><span class="glyphicon glyphicon-edit"></span></a></td>';
                html += '<td><a href="javascript:mostrarImagenes(' + id + ')"><span class="glyphicon glyphicon-paperclip"></span></a></td>';
                html += '<td><a href="javascript:modalEliminarEmpleado(' + empleado + ')"><span class="glyphicon glyphicon-trash"></span></a></td>';
            }
            $("#datos").html(html);

            $(document).ready(function () {
                $('#listaEmpleados').DataTable({
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

// registrar empleado//
function registrarEmpleado() {

    cedula = $("#documentoidentidadr").val();
    nombre = $("#nombrer").val();
    apellido1 = $("#primerapellidor").val();
    apellido2 = $("#segundoapellidor").val();
    telefono = $("#telefonor").val();
    direccion = $("#direccionr").val();
    correo = $("#correor").val();
    password = $("#passwordempleador").val();
    tipoEmpleado = $("#tipoempleador").val();
    manipulacionalimentos = "../../image/empleado/vacioManipulacion.jpg";
    identidad = "../../image/empleado/vacioCedula.jpg";
    //manipulacionalimentos = "../../image/empleado/"+ cedula + "manipulacion.jpg";
    //identidad = "../../image/empleado/"+ cedula + "cedula.jpg";

    $(document).ready(function () {
        $.post('../../business/empleado/actionEmpleado.php', {
            action: 'registrarempleado',
            cedula: cedula,
            nombre: nombre,
            apellido1: apellido1,
            apellido2: apellido2,
            telefono: telefono,
            direccion: direccion,
            correo: correo,
            clave: password,
            tipo: tipoEmpleado,
            manipulacionalimentos: manipulacionalimentos,
            identidad: identidad
        }, function (responseText) {
            if (responseText === "true") {
                swal({
                    title: "Confirmación",
                    text: "¡Se ha registrado el empleado satisfactoriamente!",
                    icon: "success",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            value: "ok"
                        }
                    },
                    dangerMode: true
                });
            } else {
                swal({
                    title: "Confirmación",
                    text: "¡Opps! Ocurrió un error al registrar el empleado",
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

            document.getElementById("documentoidentidadr").value = "";
            document.getElementById("nombrer").value = "";
            document.getElementById("primerapellidor").value = "";
            document.getElementById("segundoapellidor").value = "";
            document.getElementById("telefonor").value = "";
            document.getElementById("direccionr").value = "";
            document.getElementById("correor").value = "";

            $("#icon").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
            $("#icon2").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
            $("#icon3").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
            $("#icon4").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
            $("#icon5").html("<span class=' glyphicon-asterisk' style= 'color:red'>");

            mostrarEmpleados();
        });
    });
}

function modalRegistrarEmpleado() {
    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button id='boton' onclick='registrarEmpleado()' data-dismiss='modal' class='btn btn-primary'>Registrar</button></p>";
    $("#botonesRegistrar").html(botones);
    $('#boton').attr("disabled", true);
    $("#modalRegistrar").modal();

    document.getElementById("documentoidentidadr").value = "";
    document.getElementById("nombrer").value = "";
    document.getElementById("primerapellidor").value = "";
    document.getElementById("segundoapellidor").value = "";
    document.getElementById("telefonor").value = "";
    document.getElementById("direccionr").value = "";
    document.getElementById("correor").value = "";

    $("#icon").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
    $("#icon2").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
    $("#icon3").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
    $("#icon4").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
    $("#icon5").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
}

//modificar empleado//
function modificarEmpleado(id, clave) {

    cedula = $("#documentoidentidadm").val();
    nombre = $("#nombrem").val();
    apellido1 = $("#primerapellidom").val();
    apellido2 = $("#segundoapellidom").val();
    telefono = $("#telefonom").val();
    direccion = $("#direccionm").val();
    correo = $("#correom").val();
    password = $("#passwordempleadom").val();
    tipoEmpleado = $("#tipoempleadom").val();

    if (password === "pass") {
        password = clave;
    }

    $(document).ready(function () {
        $.post('../../business/empleado/actionEmpleado.php', {
            action: 'modificarempleado',
            cedula: cedula,
            nombre: nombre,
            apellido1: apellido1,
            apellido2: apellido2,
            telefono: telefono,
            direccion: direccion,
            correo: correo,
            clave: password,
            tipo: tipoEmpleado,
            id: id
        }, function (responseText) {
            if (responseText === "true") {
                swal({
                    title: "Confirmación",
                    text: "¡Se ha modificado el empleado satisfactoriamente!",
                    icon: "success",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            value: "ok"
                        }
                    },
                    dangerMode: true
                });
            } else {
                swal({
                    title: "Confirmación",
                    text: "¡Opps! Ocurrió un error al modificar el empleado",
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

            mostrarEmpleados();
        });
    });
}

function modalModificarEmpleado(empleado) {

    string = empleado.split(",");

    $("#documentoidentidadm").val(string[0]);
    $("#nombrem").val(string[1]);
    $("#primerapellidom").val(string[2]);
    $("#segundoapellidom").val(string[3]);
    $("#telefonom").val(string[4]);
    $("#direccionm").val(string[5]);
    $("#correom").val(string[6]);

    clave = '"' + string[7] + '"';
    id = '"' + string[9] + '"';

    document.ready = document.getElementById("tipoempleadom").value = string[8];

    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button onclick='modificarEmpleado(" + id + "," + clave + ")' data-dismiss='modal' class='btn btn-primary'>Modificar</button></p>";
    $("#botones").html(botones);
    $("#modalModificar").modal();
}

// eliminar empleado//
function eliminarEmpleado(id) {

    $(document).ready(function () {
        $.post('../../business/empleado/actionEmpleado.php', {
            action: 'eliminarempleado',
            id: id
        }, function (responseText) {
            if (responseText === "true") {
                swal({
                    title: "Confirmación",
                    text: "¡Se ha eliminado el empleado satisfactoriamente!",
                    icon: "success",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            value: "ok"
                        }
                    },
                    dangerMode: true
                });
            } else {
                swal({
                    title: "Confirmación",
                    text: "¡Opps! Ocurrió un error al eliminar el empleado",
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
            mostrarEmpleados();
        });
    });
}

function modalEliminarEmpleado(empleado) {

    string = empleado.split(',');

    id = string[9];

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
                        eliminarEmpleado(id);
                        break;
                    case "cancel":
                        break;
                }
            });
}

function validarCamposCedula() {

    cedula = $("#documentoidentidadr").val();
    nombre = $("#nombrer").val();
    apellido = $("#primerapellidor").val();
    direccion = $("#direccionr").val();
    tipo = $("#tipoempleador").val();
    var caracteres = /[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/;

    if (cedula !== "" && cedula.length === 9 && !cedula.match(caracteres)) {
        $("#icon").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon').show();
        if (cedula !== "" && nombre !== "" && apellido !== "" && direccion !== "" && tipo !== "") {
            $('#boton').attr("disabled", false);
        }
    } else {
        $("#icon").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}
function validarCamposNombre() {

    cedula = $("#documentoidentidadr").val();
    nombre = $("#nombrer").val();
    apellido = $("#primerapellidor").val();
    direccion = $("#direccionr").val();
    tipo = $("#tipoempleador").val();
    var caracteres = /[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/;

    if (nombre !== "" && nombre.length > 3 && nombre.match(caracteres)) {

        $("#icon2").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon2').show();
        if (cedula !== "" && nombre !== "" && apellido !== "" && direccion !== "" && tipo !== "") {
            $('#boton').attr("disabled", false);
        }

    } else {
        $("#icon2").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}
function validarCamposApellido() {

    cedula = $("#documentoidentidadr").val();
    nombre = $("#nombrer").val();
    apellido = $("#primerapellidor").val();
    direccion = $("#direccionr").val();
    tipo = $("#tipoempleador").val();
    var caracteres = /[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/;

    if (apellido !== "" && apellido.length > 3 && apellido.match(caracteres)) {

        $("#icon3").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon3').show();
        if (cedula !== "" && nombre !== "" && apellido !== "" && direccion !== "" && tipo !== "") {
            $('#boton').attr("disabled", false);
        }

    } else {
        $("#icon3").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}
function validarCamposDireccion() {

    cedula = $("#documentoidentidadr").val();
    nombre = $("#nombrer").val();
    apellido = $("#primerapellidor").val();
    direccion = $("#direccionr").val();
    tipo = $("#tipoempleador").val();
    var caracteres = /[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/;

    if (direccion !== "" && direccion.length > 3 && direccion.match(caracteres)) {

        $("#icon4").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon4').show();
        if (cedula !== "" && nombre !== "" && apellido !== "" && direccion !== "" && tipo !== "") {
            $('#boton').attr("disabled", false);
        }

    } else {
        $("#icon4").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}

function validarCamposTipo() {

    cedula = $("#documentoidentidadr").val();
    nombre = $("#nombrer").val();
    apellido = $("#primerapellidor").val();
    direccion = $("#direccionr").val();
    tipo = $("#tipoempleador").val();

    if (tipo !== "") {

        $("#icon5").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon5').show();
        if (cedula !== "" && nombre !== "" && apellido !== "" && direccion !== "" && tipo !== "") {
            $('#boton').attr("disabled", false);
        }

    } else {
        $("#icon5").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#icon5').show();
        $('#boton').attr("disabled", true);
    }
}

function mostrarImagenes(id) {
    var dato = "";
    dato = btoa(id);/*encripta la palabra en base 68*/
    //alert(dato);
    //alert(atob(dato));/*desencripta la balabra en base 68*/
    location.href = "../../view/empleado/verImagenEmpleadoView.php?id=" + dato;
}
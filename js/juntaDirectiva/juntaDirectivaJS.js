//mostrar lista de juntas directivas//
function mostrarJuntaDirectiva() {
    $('#listaJuntas').dataTable().fnDestroy();
    $(document).ready(function () {
        $.post('../../business/juntaDirectiva/actionJuntaDirectiva.php', {
            action: 'consultarjuntas'
        }, function (responseText) {
            json = JSON.parse(responseText);
            html = "";
            for (i = 0; i < json.length; i++) {

                html += "<tr>";
                html += "<td>" + json[i].fechainicioperiodo + "</td>";
                html += "<td>" + json[i].fechafinalperiodo + "</td>";
                idjunta = json[i].idjuntadirectiva;
                inicioperiodo = json[i].fechainicioperiodo;
                finalperiodo = json[i].fechafinalperiodo;
                presidente = json[i].presidente;
                vicepresidente = json[i].vicepresidente;
                secretario = json[i].secretario;
                tesorero = json[i].tesorero;
                fiscal = json[i].fiscal;
                vocal1 = json[i].vocal1;
                vocal2 = json[i].vocal2;
                junta = "'" + idjunta + "," + inicioperiodo + "," + finalperiodo + "'";
                miembros = "'" + presidente + "," + vicepresidente + "," + secretario + "," + tesorero + "," + fiscal + "," + vocal1 + "," + vocal2 + "'";
                html += '<td><a href="javascript:modalModificarJunta(' + junta + ',' + miembros + ')"><span class="glyphicon glyphicon-edit"></span></a></td>';
                html += '<td><a href="javascript:modalVerJunta(' + miembros + ')"><span class="glyphicon glyphicon-user"></span></a></td>';
            }
            $("#datos").html(html);
            $(document).ready(function () {
                $('#listaJuntas').DataTable({
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

// registrar junta
function registrarJunta() {

    presidente = document.getElementById("presidenter").value;
    vicepresidente = document.getElementById("vicepresidenter").value;
    secretario = document.getElementById("secretarior").value;
    tesorero = document.getElementById("tesoreror").value;
    fiscal = document.getElementById("fiscalr").value;
    vocal1 = document.getElementById("vocal1r").value;
    vocal2 = document.getElementById("vocal2r").value;
    fechainicioperiodo = document.getElementById("fechainicioperiodor").value;
    fechafinalperiodo = document.getElementById("fechafinalperiodor").value;

    if (presidente !== vicepresidente && presidente !== secretario && presidente !== tesorero && presidente !== fiscal && presidente !== vocal1
            && presidente !== vocal2 && vicepresidente !== secretario && vicepresidente !== tesorero && vicepresidente !== fiscal
            && vicepresidente !== vocal1 && vicepresidente !== vocal2 && secretario !== tesorero && secretario !== fiscal
            && secretario !== vocal1 && secretario !== vocal2 && tesorero !== fiscal
            && tesorero !== vocal1 && tesorero !== vocal2 && fiscal !== vocal1 && fiscal !== vocal2 && vocal1 !== vocal2
            && inicio !== "" && final !== "" && inicio < final) {
        $(document).ready(function () {
            $.post('../../business/juntaDirectiva/actionJuntaDirectiva.php', {
                action: 'registrarjunta',
                presidente: presidente,
                vicepresidente: vicepresidente,
                secretario: secretario,
                tesorero: tesorero,
                fiscal: fiscal,
                vocal1: vocal1,
                vocal2: vocal2,
                inicio: fechainicioperiodo,
                final: fechafinalperiodo
            }, function (responseText) {
                if (responseText === "true") {
                    swal({
                        title: "Confirmación",
                        text: "¡Se ha registrado la junta  satisfactoriamente!",
                        icon: "success",
                        buttons: {
                            ok: {
                                text: "Aceptar",
                                value: "ok"
                            }
                        },
                        dangerMode: true
                    });
                }
            });
        });
    } else {
        swal({
            title: "Confirmación",
            text: "¡Opps! Ocurrió un error al registrar la junta,\n\
                    *No pueden repetirse Miembros, \n\
                    *Verifique que la fecha inicial no sea posterior a la final, \n\
                    Intente nuevamente",
            icon: "error",
            buttons: {
                ok: {
                    text: "Aceptar",
                    value: "ok"
                }
            },
            dangerMode: true
        });

        document.getElementById("presidenter").value = "";
        document.getElementById("vicepresidenter").value = "";
        document.getElementById("secretarior").value = "";
        document.getElementById("tesoreror").value = "";
        document.getElementById("fiscalr").value = "";
        document.getElementById("vocal1r").value = "";
        document.getElementById("vocal2r").value = "";
        document.getElementById("fechainicioperiodor").value = "";
        document.getElementById("fechafinalperiodor").value = "";

        $("#icon").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $("#icon2").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $("#icon3").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $("#icon4").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $("#icon5").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $("#icon6").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $("#icon7").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $("#icon8").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $("#icon9").html("<span class=' glyphicon-asterisk' style= 'color:red'>");

    }
    mostrarJuntaDirectiva();
}

function verProductor() {
    $(document).ready(function () {
        $.post('../../business/juntaDirectiva/actionJuntaDirectiva.php', {
            action: 'consultarSocio'
        }, function (responseText) {
            json = JSON.parse(responseText);
            html = "";
            html += "<option ></option>";
            for (i = 0; i < json.length; i++) {
                idPersona = '"' + json[i].idpersona + '"';
                html += "<option value=" + json[i].nombrepersona + ">" + json[i].nombrepersona + " " + json[i].apellido1persona + " " + json[i].apellido2persona + "</option>";
            }
            $("#presidenter").html(html);
            $("#vicepresidenter").html(html);
            $("#secretarior").html(html);
            $("#tesoreror").html(html);
            $("#fiscalr").html(html);
            $("#vocal1r").html(html);
            $("#vocal2r").html(html);
        });
    });
}

function Limpiar() {

    document.getElementById("presidenter").value = "";
    document.getElementById("vicepresidenter").value = "";
    document.getElementById("secretarior").value = "";
    document.getElementById("tesoreror").value = "";
    document.getElementById("fiscalr").value = "";
    document.getElementById("vocal1r").value = "";
    document.getElementById("vocal2r").value = "";
    document.getElementById("fechainicioperiodor").value = "";
    document.getElementById("fechafinalperiodor").value = "";

    $("#icon").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
    $("#icon2").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
    $("#icon3").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
    $("#icon4").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
    $("#icon5").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
    $("#icon6").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
    $("#icon7").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
    $("#icon8").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
    $("#icon9").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
}

function modalRegistrarJunta() {

    botones = "<p><button data-dismiss='modal' onclick='Limpiar()' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button id='boton' onclick='registrarJunta()' data-dismiss='modal' class='btn btn-primary'>Registrar</button></p>";
    $("#botonesRegistrar").html(botones);
    $('#boton').attr("disabled", true);
    $("#modalRegistrar").modal();
}

//modificar empleado//
function modificarJunta(id) {

    presidente = $("#presidentem").val();
    vicepresidente = $("#vicepresidentem").val();
    secretario = $("#secretariom").val();
    tesorero = $("#tesorerom").val();
    fiscal = $("#fiscalm").val();
    vocal1 = $("#vocal1m").val();
    vocal2 = $("#vocal2m").val();
    inicio = $("#fechainicioperiodom").val();
    final = $("#fechafinalperiodom").val();

    $(document).ready(function () {
        $.post('../../business/juntaDirectiva/actionJuntaDirectiva.php', {
            action: 'modificarjunta',
            presidente: presidente,
            vicepresidente: vicepresidente,
            secretario: secretario,
            tesorero: tesorero,
            fiscal: fiscal,
            vocal1: vocal1,
            vocal2: vocal2,
            inicio: inicio,
            final: final,
            id: id
        }, function (responseText) {
            if (responseText === "true") {
                swal({
                    title: "Confirmación",
                    text: "¡Se ha modificado la junta  satisfactoriamente!",
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
                    text: "¡Opps! Ocurrió un error al modificar la junta,\n\
                            *El formato debe ser el correcto \n\
                            *Verifique que los campos no se encuentren vacios, \n\
                            Intente nuevamente",
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
            mostrarJuntaDirectiva();
        });
    });
}

function modalModificarJunta(junta, miembros) {

    stringJunta = junta.split(",");
    string = miembros.split(",");
    $("#presidentem").val(string[0]);
    $("#vicepresidentem").val(string[1]);
    $("#secretariom").val(string[2]);
    $("#tesorerom").val(string[3]);
    $("#fiscalm").val(string[4]);
    $("#vocal1m").val(string[5]);
    $("#vocal2m").val(string[6]);
    id = '"' + stringJunta[0] + '"';
    $("#fechainicioperiodom").val(stringJunta[1]);
    $("#fechafinalperiodom").val(stringJunta[2]);

    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button id='boton2' onclick='modificarJunta(" + id + ")' data-dismiss='modal' class='btn btn-primary'>Modificar</button></p>";
    $("#botones").html(botones);
    $("#modalModificar").modal();
}

//ver miembros de Junta//
function modalVerJunta(miembros) {

    string = miembros.split(",");
    $("#presidentev").val(string[0]);
    $("#vicepresidentev").val(string[1]);
    $("#secretariov").val(string[2]);
    $("#tesorerov").val(string[3]);
    $("#fiscalv").val(string[4]);
    $("#vocal1v").val(string[5]);
    $("#vocal2v").val(string[6]);

    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    $("#botonesVer").html(botones);
    $("#modalVer").modal();
}

function validarCamposPresidente() {

    presidente = $("#presidenter").val();
    vicepresidente = $("#vicepresidenter").val();
    secretario = $("#secretarior").val();
    tesorero = $("#tesoreror").val();
    fiscal = $("#fiscalr").val();
    vocal1 = $("#vocal1r").val();
    vocal2 = $("#vocal2r").val();
    inicio = $("#fechainicioperiodor").val();
    final = $("#fechafinalperiodor").val();

    if (presidente !== "") {
        $("#icon").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon').show();
        if (presidente !== "" && vicepresidente !== "" && secretario !== "" && tesorero !== "" && fiscal !== ""
                && vocal1 !== "" && vocal2 !== "" && inicio !== "" && final !== "") {
            $('#boton').attr("disabled", false);
        }
    } else {
        $("#icon").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}

function validarVicepresidente() {

    presidente = $("#presidenter").val();
    vicepresidente = $("#vicepresidenter").val();
    secretario = $("#secretarior").val();
    tesorero = $("#tesoreror").val();
    fiscal = $("#fiscalr").val();
    vocal1 = $("#vocal1r").val();
    vocal2 = $("#vocal2r").val();
    inicio = $("#fechainicioperiodor").val();
    final = $("#fechafinalperiodor").val();

    if (vicepresidente !== "") {
        $("#icon2").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon2').show();
        if (presidente !== "" && vicepresidente !== "" && secretario !== "" && tesorero !== "" && fiscal !== ""
                && vocal1 !== "" && vocal2 !== "" && inicio !== "" && final !== "") {
            $('#boton').attr("disabled", false);
        }
    } else {
        $("#icon2").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}

function validarCamposSecretario() {

    presidente = $("#presidenter").val();
    vicepresidente = $("#vicepresidenter").val();
    secretario = $("#secretarior").val();
    tesorero = $("#tesoreror").val();
    fiscal = $("#fiscalr").val();
    vocal1 = $("#vocal1r").val();
    vocal2 = $("#vocal2r").val();
    inicio = $("#fechainicioperiodor").val();
    final = $("#fechafinalperiodor").val();

    if (secretario !== "") {
        $("#icon3").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon3').show();
        if (presidente !== "" && vicepresidente !== "" && secretario !== "" && tesorero !== "" && fiscal !== ""
                && vocal1 !== "" && vocal2 !== "" && inicio !== "" && final !== "") {
            $('#boton').attr("disabled", false);
        }
    } else {
        $("#icon3").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}

function validarCamposTesorero() {

    presidente = $("#presidenter").val();
    vicepresidente = $("#vicepresidenter").val();
    secretario = $("#secretarior").val();
    tesorero = $("#tesoreror").val();
    fiscal = $("#fiscalr").val();
    vocal1 = $("#vocal1r").val();
    vocal2 = $("#vocal2r").val();
    inicio = $("#fechainicioperiodor").val();
    final = $("#fechafinalperiodor").val();

    if (tesorero !== "") {
        $("#icon4").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon4').show();
        if (presidente !== "" && vicepresidente !== "" && secretario !== "" && tesorero !== "" && fiscal !== ""
                && vocal1 !== "" && vocal2 !== "" && inicio !== "" && final !== "") {
            $('#boton').attr("disabled", false);
        }
    } else {
        $("#icon4").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}

function validarCamposFiscal() {

    presidente = $("#presidenter").val();
    vicepresidente = $("#vicepresidenter").val();
    secretario = $("#secretarior").val();
    tesorero = $("#tesoreror").val();
    fiscal = $("#fiscalr").val();
    vocal1 = $("#vocal1r").val();
    vocal2 = $("#vocal2r").val();
    inicio = $("#fechainicioperiodor").val();
    final = $("#fechafinalperiodor").val();

    if (fiscal !== "") {
        $("#icon5").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon5').show();
        if (presidente !== "" && vicepresidente !== "" && secretario !== "" && tesorero !== "" && fiscal !== ""
                && vocal1 !== "" && vocal2 !== "" && inicio !== "" && final !== "") {
            $('#boton').attr("disabled", false);
        }
    } else {
        $("#icon5").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}

function validarCamposVocal1() {

    presidente = $("#presidenter").val();
    vicepresidente = $("#vicepresidenter").val();
    secretario = $("#secretarior").val();
    tesorero = $("#tesoreror").val();
    fiscal = $("#fiscalr").val();
    vocal1 = $("#vocal1r").val();
    vocal2 = $("#vocal2r").val();
    inicio = $("#fechainicioperiodor").val();
    final = $("#fechafinalperiodor").val();

    if (vocal1 !== "") {
        $("#icon6").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon6').show();
        if (presidente !== "" && vicepresidente !== "" && secretario !== "" && tesorero !== "" && fiscal !== ""
                && vocal1 !== "" && vocal2 !== "" && inicio !== "" && final !== "") {
            $('#boton').attr("disabled", false);
        }
    } else {
        $("#icon6").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}

function validarCamposVocal2() {

    presidente = $("#presidenter").val();
    vicepresidente = $("#vicepresidenter").val();
    secretario = $("#secretarior").val();
    tesorero = $("#tesoreror").val();
    fiscal = $("#fiscalr").val();
    vocal1 = $("#vocal1r").val();
    vocal2 = $("#vocal2r").val();
    inicio = $("#fechainicioperiodor").val();
    final = $("#fechafinalperiodor").val();
    if (vocal2 !== "") {
        $("#icon7").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon7').show();
        if (presidente !== "" && vicepresidente !== "" && secretario !== "" && tesorero !== "" && fiscal !== ""
                && vocal1 !== "" && vocal2 !== "" && inicio !== "" && final !== "") {
            $('#boton').attr("disabled", false);
        }
    } else {
        $("#icon7").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}

function validarCamposInicio() {

    presidente = $("#presidenter").val();
    vicepresidente = $("#vicepresidenter").val();
    secretario = $("#secretarior").val();
    tesorero = $("#tesoreror").val();
    fiscal = $("#fiscalr").val();
    vocal1 = $("#vocal1r").val();
    vocal2 = $("#vocal2r").val();
    inicio = $("#fechainicioperiodor").val();
    final = $("#fechafinalperiodor").val();
    if (inicio !== "") {
        $("#icon8").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon8').show();
        if (presidente !== "" && vicepresidente !== "" && secretario !== "" && tesorero !== "" && fiscal !== ""
                && vocal1 !== "" && vocal2 !== "" && inicio !== "" && final !== "") {
            $('#boton').attr("disabled", false);
        }
    } else {
        $("#icon8").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}

function validarCamposFinal() {

    presidente = $("#presidenter").val();
    vicepresidente = $("#vicepresidenter").val();
    secretario = $("#secretarior").val();
    tesorero = $("#tesoreror").val();
    fiscal = $("#fiscalr").val();
    vocal1 = $("#vocal1r").val();
    vocal2 = $("#vocal2r").val();
    inicio = $("#fechainicioperiodor").val();
    final = $("#fechafinalperiodor").val();
    if (final !== "") {
        $("#icon9").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon9').show();
        if (presidente !== "" && vicepresidente !== "" && secretario !== "" && tesorero !== "" && fiscal !== ""
                && vocal1 !== "" && vocal2 !== "" && inicio !== "" && final !== "") {
            $('#boton').attr("disabled", false);
        }
    } else {
        $("#icon9").html("<span class=' glyphicon-asterisk' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
}

function validarCamposPresidentem() {

    presidente = $("#presidentem").val();
    var caracteres = /[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/;

    if (presidente !== "" && presidente.length >= 3 && presidente.match(caracteres)) {
        $('#boton2').attr("disabled", false);
    } else {
        $('#boton2').attr("disabled", true);
    }
}

function validarCamposVicePresidentem() {

    vicepresidente = $("#vicepresidentem").val();
    var caracteres = /[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/;

    if (vicepresidente !== "" && vicepresidente.length >= 3 && vicepresidente.match(caracteres)) {
        $('#boton2').attr("disabled", false);
    } else {
        $('#boton2').attr("disabled", true);
    }
}

function validarCamposSecretariom() {

    secretario = $("#secretariom").val();
    var caracteres = /[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/;

    if (secretario !== "" && secretario.length >= 3 && secretario.match(caracteres)) {
        $('#boton2').attr("disabled", false);
    } else {
        $('#boton2').attr("disabled", true);
    }
}

function validarCamposTesorerom() {

    tesorero = $("#tesorerom").val();
    var caracteres = /[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/;

    if (tesorero !== "" && tesorero.length >= 3 && tesorero.match(caracteres)) {
        $('#boton2').attr("disabled", false);
    } else {
        $('#boton2').attr("disabled", true);
    }
}

function validarCamposFiscalm() {

    fiscal = $("#fiscalm").val();
    var caracteres = /[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/;

    if (fiscal !== "" && fiscal.length >= 3 && fiscal.match(caracteres)) {
        $('#boton2').attr("disabled", false);
    } else {
        $('#boton2').attr("disabled", true);
    }
}

function validarCamposVocal1m() {

    vocal1 = $("#vocal1m").val();
    var caracteres = /[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/;

    if (vocal1 !== "" && vocal1.length >= 3 && vocal1.match(caracteres)) {
        $('#boton2').attr("disabled", false);
    } else {
        $('#boton2').attr("disabled", true);
    }
}
function validarCamposVocal2m() {

    vocal2 = $("#vocal2m").val();
    var caracteres = /[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]/;

    if (vocal2 !== "" && vocal2.length >= 3 && vocal2.match(caracteres)) {
        $('#boton2').attr("disabled", false);
    } else {
        $('#boton2').attr("disabled", true);
    }
}

function validarCamposFecham() {

    inicio = $("#fechainicioperiodom").val();
    final = $("#fechafinalperiodom").val();

    if (inicio < final) {
        $('#boton2').attr("disabled", false);
    } else {
        $('#boton2').attr("disabled", true);
    }
}




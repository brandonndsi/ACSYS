//mostrar procesos//
function mostrarProcesos() {
    $('#listaProcesos').dataTable().fnDestroy();
    $(document).ready(function () {
        $.post('../../business/proceso/actionProceso.php', {
            action: 'consultarprocesos'
        }, function (responseText) {
            json = JSON.parse(responseText);
            html = "";

            for (i = 0; i < json.length; i++) {
                html += "<tr>";
                html += "<td>" + json[i].fechaproceso + "</td>";
                html += "<td>" + json[i].horaproceso + "</td>";
                html += "<td>" + json[i].productoproceso + "</td>";
                html += "<td>" + json[i].cantidadproceso + "</td>";
                html += "<td>" + json[i].porcentajegrasalecheproceso + "</td>";
                html += "<td>" + json[i].cultivocodigoproceso + "</td>";

                producto = json[i].productoproceso;
                cantidad = json[i].cantidadproceso;
                porcentaje = json[i].porcentajegrasalecheproceso;
                lecheEntera = json[i].lecheenteraproceso;
                lecheDescremada = json[i].lechedescremadaproceso;
                cuajo = json[i].cuajoproceso;
                clorurDeCalcio = json[i].clorurdecalcioproceso;
                sal = json[i].salproceso;
                cultivoCodigo = json[i].cultivocodigoproceso;
                estabilizador = json[i].estabilizadorcodigo;
                colorante = json[i].colorateproceso;
                cremaProce1 = json[i].cremaproceso1;
                lecheProce1 = json[i].lecheproceso1;
                cremaProce2 = json[i].cremaproceso2;
                lecheProce2 = json[i].lecheproceso2;
                hora = json[i].horaproceso;
                fecha = json[i].fechaproceso;
                id = json[i].idproceso;

                proceso = "'" + producto + "," + cantidad + "," + porcentaje + "," + lecheEntera + "," +
                        lecheDescremada + "," + cuajo + "," + clorurDeCalcio + "," + sal + "," + cultivoCodigo +
                        "," + estabilizador + "," + colorante + "," + cremaProce1 + "," + lecheProce1 + "," +
                        cremaProce2 + "," + lecheProce2 + "," + hora + "," + fecha + "," + id + "'";

                html += '<td><a href="javascript:modalModificarProceso(' + proceso + ')"><span class="glyphicon glyphicon-edit"></span></a></td>';
                html += '<td><a href="javascript:modalVerProceso(' + proceso + ')"><span class="glyphicon glyphicon-cloud"></span></a></td>';
                html += '<td><a href="javascript:modalEliminarProceso(' + proceso + ')"><span class="glyphicon glyphicon-trash"></span></a></td>';
            }
            $("#datos").html(html);

            $(document).ready(function () {
                $('#listaProcesos').DataTable({
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

//ver proceso//
function modalVerProceso(proceso) {

    string = proceso.split(",");

    $("#productov").val(string[0]);
    $("#cantidadv").val(string[1]);
    $("#porcentajev").val(string[2]);
    $("#lecheEnterav").val(string[3]);
    $("#lecheDescremadav").val(string[4]);
    $("#cuajov").val(string[5]);
    $("#clorurov").val(string[6]);
    $("#salv").val(string[7]);
    $("#cultivoCodigov").val(string[8]);
    $("#estabilizadorCodigov").val(string[9]);
    $("#colorateprocesov").val(string[10]);
    $("#cremaproceso1v").val(string[11]);
    $("#lecheproceso1v").val(string[12]);
    $("#cremaproceso2v").val(string[13]);
    $("#lecheproceso2v").val(string[14]);
    $("#horaprocesov").val(string[15]);
    $("#fechaprocesov").val(string[16]);

    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    $("#botonesVer").html(botones);
    $("#modalVer").modal();
}

// registrar proceso//
function registrarProceso() {

    nombre = $("#selectproductor").val();
    cantidad = $("#cantidadr").val();
    porcentaje = $("#porcentajer").val();
    entera = $("#lecheEnterar").val();
    descremada = $("#lecheDescremadar").val();
    cuajo = $("#cuajor").val();
    cloruro = $("#cloruror").val();
    sal = $("#salr").val();
    cultivo = $("#cultivoCodigor").val();
    estabilizador = $("#estabilizadorCodigor").val();
    colorante = $("#colorateprocesor").val();
    crema1 = $("#cremaproceso1r").val();
    leche1 = $("#lecheproceso1r").val();
    crema2 = $("#cremaproceso2r").val();
    leche2 = $("#lecheproceso2r").val();

    $(document).ready(function () {
        $.post('../../business/proceso/actionProceso.php', {
            action: 'registrarproceso',
            nombre: nombre,
            cantidad: cantidad,
            porcentaje: porcentaje,
            entera: entera,
            descremada: descremada,
            cuajo: cuajo,
            cloruro: cloruro,
            sal: sal,
            cultivo: cultivo,
            estabilizador: estabilizador,
            colorante: colorante,
            crema1: crema1,
            leche1: leche1,
            crema2: crema2,
            leche2: leche2
        }, function (responseText) {
            respuesta = "";
            if (responseText === "true") {
                respuesta = "<h4>Se ha registrado el proceso satisfactoriamente</h4>";
                mostrarProcesos();
            } else {
                respuesta = "<h4>Ocurrió un error al registrar el proceso</h4>";
            }
            $("#mensaje").html(respuesta);
            $("#modalRespuesta").modal();

            document.getElementById("selectproductor").value = "";
            document.getElementById("cantidadr").value = "";
            document.getElementById("porcentajer").value = "";
            document.getElementById("lecheEnterar").value = "";
            document.getElementById("lecheDescremadar").value = "";
            document.getElementById("cuajor").value = "";
            document.getElementById("cloruror").value = "";
            document.getElementById("salr").value = "";
            document.getElementById("cultivoCodigor").value = "";
            document.getElementById("estabilizadorCodigor").value = "";
            document.getElementById("colorateprocesor").value = "";
            document.getElementById("cremaproceso1r").value = "";
            document.getElementById("lecheproceso1r").value = "";
            document.getElementById("cremaproceso2r").value = "";
            document.getElementById("lecheproceso2r").value = "";

        });
    });
}

function modalRegistrarProceso() {
    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button id='boton' onclick='registrarProceso()' data-dismiss='modal' class='btn btn-primary'>Registrar</button></p>";
    $("#botonesRegistrar").html(botones);
    $('#boton').attr("disabled", false);
    $("#modalRegistrar").modal();
}

//modificar //
function modificarProceso(id) {

    nombre = $("#productom").val();
    cantidad = $("#cantidadm").val();
    porcentaje = $("#porcentajem").val();
    entera = $("#lecheEnteram").val();
    descremada = $("#lecheDescremadam").val();
    cuajo = $("#cuajom").val();
    cloruro = $("#clorurom").val();
    sal = $("#salm").val();
    cultivo = $("#cultivoCodigom").val();
    estabilizador = $("#estabilizadorCodigom").val();
    colorante = $("#colorateprocesom").val();
    crema1 = $("#cremaproceso1m").val();
    leche1 = $("#lecheproceso1m").val();
    crema2 = $("#cremaproceso2m").val();
    leche2 = $("#lecheproceso2m").val();
    hora = $("#horaprocesom").val();
    fecha = $("#fechaprocesom").val();

    $(document).ready(function () {
        $.post('../../business/proceso/actionProceso.php', {
            action: 'modificarproceso',
            nombre: nombre,
            cantidad: cantidad,
            porcentaje: porcentaje,
            entera: entera,
            descremada: descremada,
            cuajo: cuajo,
            cloruro: cloruro,
            sal: sal,
            cultivo: cultivo,
            estabilizador: estabilizador,
            colorante: colorante,
            crema1: crema1,
            leche1: leche1,
            crema2: crema2,
            leche2: leche2,
            hora: hora,
            fecha: fecha,
            id: id
        }, function (responseText) {
            respuesta = "";
            if (responseText === "true") {
                respuesta = "<h4>Se ha modificado el proceso satisfactoriamente</h4>";
                mostrarProcesos();
            } else {
                respuesta = "<h4>Ocurrió un error al modificar el proceso</h4>";
            }
            $("#mensaje").html(respuesta);
            $("#modalRespuesta").modal();
        });
    });
}

function modalModificarProceso(proceso) {

    string = proceso.split(",");

    $("#productom").val(string[0]);
    $("#cantidadm").val(string[1]);
    $("#porcentajem").val(string[2]);
    $("#lecheEnteram").val(string[3]);
    $("#lecheDescremadam").val(string[4]);
    $("#cuajom").val(string[5]);
    $("#clorurom").val(string[6]);
    $("#salm").val(string[7]);
    $("#cultivoCodigom").val(string[8]);
    $("#estabilizadorCodigom").val(string[9]);
    $("#colorateprocesom").val(string[10]);
    $("#cremaproceso1m").val(string[11]);
    $("#lecheproceso1m").val(string[12]);
    $("#cremaproceso2m").val(string[13]);
    $("#lecheproceso2m").val(string[14]);
    $("#horaprocesom").val(string[15]);
    $("#fechaprocesom").val(string[16]);

    id = '"' + string[17] + '"';

    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button onclick='modificarProceso(" + id + ")' data-dismiss='modal' class='btn btn-primary'>Modificar</button></p>";
    $("#botones").html(botones);
    $("#modalModificar").modal();
}

// eliminar //
function eliminarProceso(cantidad,nombre,id) {

    $(document).ready(function () {
        $.post('../../business/proceso/actionProceso.php', {
            action: 'eliminarproceso',
            cantidad:cantidad,
            nombre:nombre,
            id: id
        }, function (responseText) {
            respuesta = "";
            if (responseText === "true") {
                respuesta = "<h4>Se ha eliminado el proceso satisfactoriamente</h4>";
                mostrarProcesos();
            } else {
                respuesta = "<h4>Ocurrió un error al eliminar el proceso</h4>";
            }
            $("#mensaje").html(respuesta);
            $("#modalRespuesta").modal();
        });
    });
}

function modalEliminarProceso(proceso) {
    string = proceso.split(',');

    cantidad = '"' + string[1] + '"';
    nombre = '"' + string[0] + '"';
    id = '"' + string[17] + '"';

    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button onclick='eliminarProceso(" + cantidad + "," + nombre + "," + id + ")' data-dismiss='modal' class='btn btn-primary'>Aceptar</button></p>";
    $("#botonesEliminar").html(botones);
    $("#modalEliminar").modal();
}

function consultarProduct() {
    $(document).ready(function () {
        $.post('../../business/proceso/actionProceso.php', {
            action: 'consultarProducto'
        }, function (responseText) {
            json = JSON.parse(responseText);
            html = "";
            for (i = 0; i < json.length; i++) {
                
                producto = '"' + json[i].nombreproductolacteo + '"';
                html += "<option value=" + producto + ">" + json[i].nombreproductolacteo + "</option>";
            }
            
            $("#selectproductor").html(html);
        });
    });
}

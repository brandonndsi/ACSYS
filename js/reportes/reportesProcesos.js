/*Variables glovales las cuales contendran los datos de los dos input iniciales a buscar.*/
var fechainicial;
var fechaFinal;

$(document).ready(function () {
    CargarTablaPrincipal();
});

/**
 * [CargarTablaPrincipal Loque hace es darles los valores del datablable a la table normal del principal]
 */
function CargarTablaPrincipal() {
    $('#listaVentas').DataTable({
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
}

function buscaDatos() {
    fechainicial = document.getElementById("fechainicial").value;
    fechaFinal = document.getElementById("fechafinal").value;
    validarLasFechas();
}

function validarLasFechas() {

    if (fechainicial <= fechaFinal) {
        buscarPeticion();
    } else {

        swal({
            title: "Confirmación",
            text: "¡Opps! Ocurrió un error al mostrar los registros entre este rango de fechas",
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

function buscarPeticion() {
    $.post('../../business/reportes/actionReporteProcesos.php', {
        action: 'ventaProcesos',
        fechai: fechainicial,
        fechaf: fechaFinal
    }, function (responseText) {
        json = JSON.parse(responseText);
        CargarNuevosDatosALaTablaInicial(json);
    });
}

function CargarNuevosDatosALaTablaInicial(json) {
    var listaTodo = [];
    html = "";
    for (i = 0; i < json.length; i++) {
        html += "<tr>";
        html += "<td>" + json[i].idproceso + "</td>";
        html += "<td>" + json[i].productoproceso + "</td>";
        html += "<td>" + json[i].fechaproceso + "</td>";
        html += "<td>" + json[i].horaproceso + "</td>";
        html += "<td>" + json[i].estadoproceso + "</td>";

        id = json[i].idproceso;
        nombre = json[i].productoproceso;
        cantidad = json[i].cantidadproceso;
        porcentaje = json[i].porcentajegrasalecheproceso;
        entera = json[i].lecheenteraproceso;
        descremada = json[i].lechedescremadaproceso;
        cuajo = json[i].cuajoproceso;
        cloruro = json[i].clorurdecalcioproceso;
        sal = json[i].salproceso;
        cultivo = json[i].cultivocodigoproceso;
        estabilizador = json[i].estabilizadorcodigo;
        colorante = json[i].colorateproceso;
        crema1 = json[i].cremaproceso1;
        leche1 = json[i].lecheproceso1;
        crema2 = json[i].cremaproceso2;
        leche2 = json[i].lecheproceso2;
        fecha = json[i].fechaproceso;
        hora = json[i].horaproceso;
        estado = json[i].estadoproceso;

        proceso = "'" + id + "," + nombre + "," + cantidad + "," + porcentaje + "," + entera + "," + descremada +
                "," + cuajo + "," + cloruro + "," + sal + "," + cultivo + "," + estabilizador + "," + colorante +
                "," + crema1 + "," + leche1 + "," + crema2 + "," + leche2 + "," + fecha + "," + hora + "," + estado + "'";
        listaTodo.push({"nombre": nombre, "cantidad": cantidad, "hora": hora, "fecha": fecha, "id": id});
        localStorage.setItem("listaTodo", JSON.stringify(listaTodo));
        html += '<td><a href="javascript:mostrarImprimir(' + proceso + ')"><span class="glyphicon glyphicon-file"></span></a></td>';
        html += "</tr>";
    }
    destruirTablaPrincipal();
    $("#datos").html(html);
    CargarTablaPrincipal();
}

function destruirTablaPrincipal() {
    $('#listaVentas').dataTable().fnDestroy();
}

function mostrarImprimir(proceso) {

    string = proceso.split(",");
    id = string[0];
    nombre = string[1];
    cantidad = string[2];
    porcentaje = string[3];
    entera = string[4];
    descremada = string[5];
    cuajo = string[6];
    cloruro = string[7];
    sal = string[8];
    cultivo = string[9];
    estabilizador = string[10];
    colorante = string[11];
    crema1 = string[12];
    leche1 = string[13];
    crema2 = string[14];
    leche2 = string[15];
    fecha = string[16];
    hora = string[17];
    estado = string[18];

    window.open("http://asoprolesa-saucetico/view/facturas/imprimirReporteDeProcesos.php?numeroProceso=" + id + "&&producto=" + nombre + "&&cantidad=" + cantidad + "&&porcentaje=" + porcentaje + "&&entera=" + entera + "&&descremada=" + descremada + "&&cuajo=" + cuajo + "&&cloruro=" + cloruro + "&&sal=" + sal + "&&cultivo=" + cultivo + "&&estabilizador=" + estabilizador + "&&colorante=" + colorante + "&&crema1=" + crema1 + "&&leche1=" + leche1 + "&&crema2=" + crema2 + "&&leche2=" + leche2 + "&&fecha=" + fecha + "&&hora=" + hora + "&&estado=" + estado, "popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
}

function TodoProceso() {
    if (localStorage.getItem("listaTodo") === null) {
        swal({
            title: "Reportes.",
            text: "La lista de reportes esta vacía",
            icon: "error",
            buttons: {
                ok: {
                    text: "Aceptar",
                    value: "ok"
                }

            },
            dangerMode: true
        });

    } else {
        window.open("http://asoprolesa-saucetico/view/facturas/imprimirTodoProcesos.php?listaTodo=" + localStorage.getItem("listaTodo"),"popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
        localStorage.removeItem("listaTodo");
        window.location.href = '../../view/reportes/procesos.php';

    }
}
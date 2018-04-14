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
/**
 * [buscarDatos Lo que hace es poder capturar los valores de los input ingresados por el usaurio]
 * @return {[type]} [procesa la informacion a las variables globales las cuales contienen la informacion]
 */
function buscaDatos() {
    fechainicial = document.getElementById("fechainicial").value;
    fechaFinal = document.getElementById("fechafinal").value;
    validarLasFechas();
}
/**
 * [validarLasFechas Lo que hace es verificar que la fecha inicial sea igual o menor a la final para lo de la busqueda]
 * @return {[type]} [modal o el contenido a buscar en la base de datos si esat bien]
 */
function validarLasFechas() {
    informacion = "";
    if (fechainicial <= fechaFinal) {
        buscarPeticion();
    } else {
        informacion = "la fecha inicial no debe ser menor a la fecha final.";
        modalRespuestas(informacion);
    }
}
/**
 * [modalRespuestas lo que hace es poder imprimir solo el mensaje de confirmacion de los datos de la validacion]
 * @param  {[type]} respuesta [Es el dato a mostrar en el modal]
 * @return {[type]}           [retorna el modal con el contenido enviado como parametro]
 */
function modalRespuestas(respuesta) {
    dato = "<h4>" + respuesta + "</h4>";

    $("#mensaje").html(dato);
    $("#modalRespuesta").modal();
}
/**
 * [buscarPeticion Lo que hace es traer los datos a buscar en la base de datos y los restorna  en la tabla.]
 * @return {[type]} [Actualiza la tabla inicial con los valores de la base de datos]
 */
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
/**
 * [CargarNuevosDatosALaTablaInicial Comnezamos a recorrer los datos de la busqueda y incorporarlos a la tabla principal]
 * @param {[array objeto ]} json [resive todos los datos de la busqueda en la base de datos]
 */
function CargarNuevosDatosALaTablaInicial(json) {
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
        fecha = json[i].fechaproceso;
        hora = json[i].horaproceso;
        estado = json[i].estadoproceso;

        facturanueva = "'" + id + "," + nombre + "," + fecha + "," + hora + "," +
                estado + "'";

        html += '<td><a href="javascript:modalVer(' + facturanueva + ')"><span class="glyphicon glyphicon-eye-open"></span></a></td>';
        html += '<td><a href="javascript:mostrarImprimir(' + facturanueva + ')"><span class="glyphicon glyphicon-file"></span></a></td>';
        html += "</tr>";
    }
    destruirTablaPrincipal();
    $("#datos").html(html);
    CargarTablaPrincipal();
}
/**
 * [destruirTablaPrincipal lo que hace es destruir todos los atrinutos que se le dieron a la tabla principal]
 * @return {[type]} [la vuelve a su estado original]
 */
function destruirTablaPrincipal() {
    $('#listaVentas').dataTable().fnDestroy();
}
/**
 * [mostrarImprimir la factura total con los datos]
 * @param  {[type]} facturanueva   [es un objeto de la factura nueva la cual se reutiliza]
 * @return {[type]}            [description]
 */
function mostrarImprimir(facturanueva) {
    ImprimirFactura(facturanueva);
}
/**
 * [llenarTablaDeVerDeTallesFactura lo que hace es llenar los datos de veterinario en el buscador]
 * @param  {[type]} json [Resibe el json de los datos que se mandaron por el post del servidor]
 * @return {[type]}      [Genera lo que es una tabla la cual luego sobre escribe la que tiene el modal de ver detalles]
 */
function llenarTablaDeVerDeTallesFactura(json) {
    html = "";
    for (i = 0; i < json.length; i++) {
        html += "<tr>";
        html += "<td>" + json[i].idproceso + "</td>";
        html += "<td>" + json[i].productoproceso + "</td>";
        html += "<td>" + json[i].fechaproceso + "</td>";
        html += "<td>" + json[i].horaproceso + "</td>";
        html += "<tr>";
    }


}
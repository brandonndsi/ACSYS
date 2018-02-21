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
                html += "<td>" + json[i].idjuntadirectiva + "</td>";
                html += "<td>" + json[i].fechainicioperiodo + "</td>";
                html += "<td>" + json[i].fechafinalperiodo + "</td>";


                idjunta = json[i].idjuntadirectiva;
                inicioperiodo = json[i].fechainicioperiodo;
                finalperiodo = json[i].fechafinalperiodo;

                junta = "'" + idjunta + "," + inicioperiodo + "," + finalperiodo + "'";

                html += '<td><a href="javascript:modalModificarJuntaDirectiva(' + junta + ')"><span class="glyphicon glyphicon-edit"></span></a></td>';
                html += '<td><a href="javascript:deleteAgentModal()"><span class="glyphicon glyphicon-paperclip"></span></a></td>';
                html += '<td><a href="javascript:modalEliminarJuntaDirectiva(' + junta + ')"><span class="glyphicon glyphicon-trash"></span></a></td>';
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

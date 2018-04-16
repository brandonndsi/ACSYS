function verPrecio() {
    $(document).ready(function () {
        $.post('../../business/precioLeche/actionPrecioLeche.php', {
            action: 'verprecioleche'
        }, function (responseText) {
            json = JSON.parse(responseText);

            for (i = 0; i < json.length; i++) {
                id = json[i].idpreciolitroleche;
                precio = json[i].preciolitroleche;
                fecha = json[i].fechainicio;
            }

            $("#idpreciolitroleche").val(id);
            $("#vigente").val(precio);
            $("#fecha").val(fecha);
        });
    });
}

//modificar //
function ActualizarPrecio() {

    id = $("#idpreciolitroleche").val();
    precio = $("#precioactualizado").val();

    $(document).ready(function () {
        $.post('../../business/precioLeche/actionPrecioLeche.php', {
            action: 'modificarprecio',
            id: id,
            precio: precio
        }, function (responseText) {
            respuesta = "";
            if (responseText === "true") {
                respuesta = "<h4>Se ha actualizado el precio de la leche satisfactoriamente</h4>";
            } else {
                respuesta = "<h4>Ocurrió un error al actualizar el precio de la leche</h4>";
            }
            $("#mensaje").html(respuesta);
            $("#modalRespuesta").modal();

            document.getElementById("precioactualizado").value = "";
            verPrecio();
        });
    });
}


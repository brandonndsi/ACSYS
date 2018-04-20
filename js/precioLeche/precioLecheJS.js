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
            if (responseText === "true") {
                swal({
                    title: "Confirmación",
                    text: "¡Se ha actualizado el precio de la leche satisfactoriamente!",
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
                    text: "¡Opps! No se actualizo el precio de la leche correctamente",
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

            document.getElementById("precioactualizado").value = "";
            verPrecio();
        });
    });
}


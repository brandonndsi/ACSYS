//modificar contrasenia//
function modificarContrasenia() {

    id = $("#idpersonaempleado").val();
    password = $("#passwordempleadoa").val();
    password2 = $("#passwordempleadon").val();
    password3 = $("#passwordempleadoc").val();

    $(document).ready(function () {
        $.post('../../business/perfil/actionPerfil.php', {
            action: 'modificarperfil',
            id: id,
            password: password,
            password2: password2,
            password3: password3
        }, function (responseText) {
            respuesta = "";
            if (responseText === "true") {
                respuesta = "<h4>Se ha modificado la Contraseña satisfactoriamente</h4>";
            } else {
                respuesta = "<h4>Ocurrió un error al modificar la Contraseña</h4>";
            }
            $("#mensaje").html(respuesta);
            $("#modalRespuesta").modal();
        });
    }
    );
}

function modalModificarContrasenia() {

    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button onclick='modificarContrasenia()' data-dismiss='modal' class='btn btn-primary'>Cambiar</button></p>";
    $("#botonesEditar").html(botones);
    $("#modalPassword").modal();

}
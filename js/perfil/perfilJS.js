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

            document.getElementById("idpersonaempleado").value = "";
            document.getElementById("passwordempleadoa").value = "";
            document.getElementById("passwordempleadon").value = "";
            document.getElementById("passwordempleadoc").value = "";
        });
    }
    );
}

function modalModificarContrasenia() {

    document.getElementById("idpersonaempleado").value = "";
    document.getElementById("passwordempleadoa").value = "";
    document.getElementById("passwordempleadon").value = "";
    document.getElementById("passwordempleadoc").value = "";

    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button id='boton' onclick='modificarContrasenia()' data-dismiss='modal' class='btn btn-primary'>Cambiar</button></p>";
    $("#botonesEditar").html(botones);
    $('#boton').attr("disabled", true);
    $("#modalPassword").modal();

}

function validarContraseniaNueva() {

    password = $("#passwordempleadoa").val();
    password2 = $("#passwordempleadon").val();
    password3 = $("#passwordempleadoc").val();

    if (password2 !== "" && password3 !== "") {
        if (password2 === password3) {

            $("#icon").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
            $('#icon').show();
            $('#boton').attr("disabled", false);

        } else {
            $("#icon").html("<span class='glyphicon glyphicon-remove' style= 'color:red'>");
        }
    }
    if (password === "") {
        $("#icon").html("<span class='glyphicon glyphicon-remove' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
    if (password2 === "") {
        $("#icon").html("<span class='glyphicon glyphicon-remove' style= 'color:red'>");
        $('#icon').show();
        $('#boton').attr("disabled", true);
    }
    if (password3 === "") {
        $("#icon").html("<span class='glyphicon glyphicon-remove' style= 'color:red'>");
        $('#icon').show();
        $('#boton').attr("disabled", true);
    }
    if (password === "" && password2 === "" && password3 === "") {
        $('#icon').hide();
        $('#boton').attr("disabled", false);
    }
}

function validarContraNueva() {

    password = $("#passwordempleadoa").val();
    password2 = $("#passwordempleadon").val();
    password3 = $("#passwordempleadoc").val();

    if (password !== "" && password2 !== "" && password3 !== "") {
        $("#icon").html("<span class='glyphicon glyphicon-ok' style= 'color:green'>");
        $('#icon').show();
        $('#boton').attr("disabled", false);
    }
    if (password === "") {
        $("#icon").html("<span class='glyphicon glyphicon-remove' style= 'color:red'>");
        $('#boton').attr("disabled", true);
    }
    if (password === "" && password2 === "" && password3 === "") {
        $('#icon').hide();
        $('#boton').attr("disabled", false);
    }
}

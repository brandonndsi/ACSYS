var rutaimagen;//variable global apr poder intanciar la nueva ruta al modal de la imagen
window.onload=function(){
cargarTablaDistribuidor();
};
/*Esta funcion es la encargada de poder destruir las cualidades que se le habian dado a la tabla con datatable*/
function destruir_Tabla(){
     $('#listaDistribuidor').dataTable().fnDestroy();
}
/*Esta function es la encargada de poder darles las cualidades del data table a una tabla estandar en php*/
function Cartar_Tabla_usando_Data_Table(){
     $(document).ready(function () {
                $('#listaDistribuidor').DataTable({
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
}
function cargarTablaDistribuidor(){
    destruir_Tabla();
    $(document).ready(function () {
        $.post('../../business/distribuidor/DistribuidorAccion.php', {
            action: 'consultarDistribuidor'
        }, function (responseText) {
            json = JSON.parse(responseText);
            html = "";

            for (i = 0; i < json.length; i++) {
                html += "<tr>";
                html += "<td>" + json[i].documentoidentidadpersona + "</td>";
                html += "<td>" + json[i].nombrepersona +" "+json[i].apellido1persona+" "+json[i].apellido2persona+"</td>";
                /*html += "<td>" + json[i].apellido1persona + "</td>";
                html += "<td>" + json[i].apellido2persona + "</td>";*/
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
                id = json[i].idpersona;
                rutaimagen=json[i].rutaimagen;
                distribuidor = "'" + documentoidentidad + "," + nombre + "," + primerapellido + "," + segundoapellido + "," +
                        telefono + "," + direccion + "," + correo + ","+ id +"'";

                html += '<td><a href="javascript:modalModificarDistribuidor(' + distribuidor + ')"><span class="glyphicon glyphicon-edit"></span></a></td>';
                html += '<td><a href="javascript:modalEliminarDistribuidor(' + distribuidor + ')"><span class="glyphicon glyphicon-trash"></span></a></td>';
            }
            $("#datos").html(html);
            Cartar_Tabla_usando_Data_Table();
        });
    });
 }
function modalimagen(){

alert(rutaimagen);
var ruta="<img src='"+rutaimagen+"'>";
document.getElementById("imagen").innerHTML=ruta;
document.getElementById("contenedorImagen").style.transform="translateY(0%)";
}

function probarqueestellenoelfile(){
      //file type validation
    $("#file").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#file").val('');
            return false;
        }
    });
}
// registrar Distribuidor//
function registrarDistribuidor() {

    cedula = $("#documentoidentidadr").val();
    nombre = $("#nombrer").val();
    apellido1 = $("#primerapellidor").val();
    apellido2 = $("#segundoapellidor").val();
    telefono = $("#telefonor").val();
    direccion = $("#direccionr").val();
    correo = $("#correor").val();
   /*verificando que los campos no esten vacios a la hora de enviarlos*/
   if(cedula!="" && nombre!="" && apellido1!="" && apellido2!="" && telefono!="" && direccion!="" && correo!=""){
    $(document).ready(function () {
        $.post('../../business/distribuidor/DistribuidorAccion.php', {
            action: 'registrarDistribuidor',
            cedula: cedula,
            nombre: nombre,
            apellido1: apellido1,
            apellido2: apellido2,
            telefono: telefono,
            direccion: direccion,
            correo: correo

        }, function (responseText) {
            
            if (responseText === "true") {
                swal({
                    title: "Confirmación",
                    text: "¡Se ha registrado el Distribuidor satisfactoriamente!",
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
                    text: "¡Opps! Ocurrió un error al registrar el distribuidor",
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
            limpiar_datos_del_formulario();
            cargarTablaDistribuidor();
        });
    });
}else{
    swal({
                    title: "Datos vacios",
                    text: "¡Opps! Ocurrió un error datos vacios",
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

/*funcion encargada de poder limpiar los campos del formulario*/
function limpiar_datos_del_formulario(){
            document.getElementById("documentoidentidadr").value = "";
            document.getElementById("nombrer").value = "";
            document.getElementById("primerapellidor").value = "";
            document.getElementById("segundoapellidor").value = "";
            document.getElementById("telefonor").value = "";
            document.getElementById("direccionr").value = "";
            document.getElementById("correor").value = "";
    }
/*Funcion de verifiacion del correo que los datos sean correctos.*/
function verificarCorreo(valor){
emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(valor.value)) {
      alert("válido");
       document.getElementById(valor.id).className = "form-control input";//.style.border="1px solid green";
    } else {
    document.getElementById(valor.id).style.border="1px solid red";
      swal({
                    title: "Correo No vàlido",
                    text: "Ejemplo  de correo: andres@gmail.com",
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

function modalRegistrarDistribuidor() {
    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button onclick='registrarDistribuidor()' data-dismiss='modal' class='btn btn-primary'>Registrar</button></p>";
    $("#botonesRegistrar").html(botones);
    $("#modalRegistrar").modal({backdrop: 'static', keyboard: false});
}

//modificar empleado//
function modificarDistribuidor(id) {

    cedula = $("#documentoidentidadm").val();
    nombre = $("#nombrem").val();
    apellido1 = $("#primerapellidom").val();
    apellido2 = $("#segundoapellidom").val();
    telefono = $("#telefonom").val();
    direccion = $("#direccionm").val();
    correo = $("#correom").val();

    $(document).ready(function () {
        $.post('../../business/distribuidor/DistribuidorAccion.php', {
            action: 'modificarDistribuidor',
            cedula: cedula,
            nombre: nombre,
            apellido1: apellido1,
            apellido2: apellido2,
            telefono: telefono,
            direccion: direccion,
            correo: correo,
            id: id
        }, function (responseText) {
            if (responseText === "true") {
                swal({
                    title: "Confirmación",
                    text: "¡Se ha modificado el Dsitribuidor satisfactoriamente!",
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
                    text: "¡Opps! Ocurrió un error al modificar el Distribuidor",
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
                cargarTablaDistribuidor();

        });
    });
}

function modalModificarDistribuidor(distribuidor) {

    string = distribuidor.split(",");

    $("#documentoidentidadm").val(string[0]);
    $("#nombrem").val(string[1]);
    $("#primerapellidom").val(string[2]);
    $("#segundoapellidom").val(string[3]);
    $("#telefonom").val(string[4]);
    $("#direccionm").val(string[5]);
    $("#correom").val(string[6]);

    id = '"' + string[7] + '"';


    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button onclick='modificarDistribuidor(" + id + ")' data-dismiss='modal' class='btn btn-primary'>Modificar</button></p>";
    $("#botones").html(botones);
    $("#modalModificar").modal();
}

// eliminar distribuidor//
function eliminarDistribuidor(id) {

    $(document).ready(function () {
        $.post('../../business/distribuidor/DistribuidorAccion.php', {
            action: 'eliminarDistribuidor',
            id: id
        }, function (responseText) {
            if (responseText === "true") {
                swal({
                    title: "Confirmación",
                    text: "¡Se ha eliminado el Distribuidor satisfactoriamente!",
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
                    text: "¡Opps! Ocurrió un error al eliminar el Distribuidor",
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
           cargarTablaDistribuidor();
        });
    });
}

function modalEliminarDistribuidor(distribuidor) {
    string = distribuidor.split(',');

    id = '"' + string[7] + '"';

    botones = "<p><button data-dismiss='modal' class='btn btn-danger'>Cancelar</button> ";
    botones += "<button onclick='eliminarDistribuidor(" + id + ")' data-dismiss='modal' class='btn btn-primary'>Aceptar</button></p>";
    $("#botonesEliminar").html(botones);
    $("#modalEliminar").modal();
}

/*funcion que se encarga de verificar que lo que se ingrese sea solo letras*/
function textonly(e){
var code;
if (!e) var e = window.event;
if (e.keyCode) code = e.keyCode;
else if (e.which) code = e.which;
var character = String.fromCharCode(code);

    var AllowRegex  = /^[\ba-zA-Z\s-]$/;
    if (AllowRegex.test(character)) return true;
    return false;

}
/*esto lo que hace es preguntar si esta basio o no*/
function verifyOnChange(id){

    if(document.getElementById(id).value.length>0){
      document.getElementById(id).style.border="1px solid green";
    }else{
      //document.getElementById(id).className = "form-control input error";
      document.getElementById(id).style.border="1px solid red";
    }
}
function verificarQueSeanNueveDijitos(id){
    if(document.getElementById(id).value.length>=9){

      document.getElementById(id).style.border="1px solid green";

    }else{
        swal({
                    title: "Cèdula",
                    text: "¡Opps! La Cèdula debe de  tener solo 9 digìtos",
                    icon: "error",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            value: "ok"
                        }
                    },
                    dangerMode: true
                });
        document.getElementById(id).style.border="1px solid red";
    }
}
function verificarQueSeanOchoDijitos(id){
    if(document.getElementById(id).value.length>=8){

      document.getElementById(id).style.border="1px solid green";

    }else{
        swal({
                    title: "Telèfono",
                    text: "¡Opps! El telèfono debe tener solo 8 digìtos",
                    icon: "error",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            value: "ok"
                        }
                    },
                    dangerMode: true
                });
        document.getElementById(id).style.border="1px solid red";
    }
}
function validarEspaciosEnBlancoInput(e,id) {
 if (e.target.value.trim() == ""){
    swal({
                    title: "Datos incorrectos",
                    text: "¡Opps! Error en los datos ingresados",
                    icon: "error",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            value: "ok"
                        }
                    },
                    dangerMode: true
                });
  limpiarCampoInput(id);
 }else{
    document.getElementById(id).className = "form-control input";
 }
}
function limpiarCampoInput(id){
    document.getElementById(id).value="";
    document.getElementById(id).style.border="1px solid red";
     /*document.getElementById(id).style.border="1px solid red"; */ 
}

function soloNumeros(e){
    var key = e.charCode;
    console.log(key);
    return key >= 48 && key <= 57;
}

function soloNumeros(e){
    var key = window.event ? e.which : e.keyCode;
    if (key < 48 || key > 57) {
        if(key!=46){

            //Usando la definición del DOM level 2, "return" NO funciona.
            e.preventDefault();
        }
        
    }
  }

  function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }


function correoValidar(correo) {

    var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

    if (!regex.test(correo.value.trim())&& correo.value!="") {
        
        swal({
            title: "Error",
            text: "Correo ingresado no válido",
            icon: "error",
            buttons: {
                ok:{
                text:"Aceptar",
                value:"ok",
                }
            },
            dangerMode: true,
        });
    }
}



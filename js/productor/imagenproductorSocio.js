var rutaimagen;

//window.onload=function(){
$(document).ready(function(){
	buscarImagenes();
});
/*creando la consulta ajax*/
function crearAjax(){
    var ajax;
    try{
        ajax= new XMLHttpRequest();
    }catch(error){
        alert("ERROR: datos del ajax.");
    }
    return ajax;
}
/*terminado la consulta ajax*/
function descaragarCBO(){
	rutaimagen=document.getElementById("imagenCBO").value;
	mostrarImagenAntesDeImprimir();
}
function descaragarSangrado(){
	rutaimagen=document.getElementById("imagenSangrado").value;
	mostrarImagenAntesDeImprimir();
}
function descaragarEscritura(){
	rutaimagen=document.getElementById("imagenEscritura").value;
	mostrarImagenAntesDeImprimir();
}
function descaragarLuz(){
	rutaimagen=document.getElementById("imagenLuz").value;
	mostrarImagenAntesDeImprimir();
}
function descaragarAgua(){
	rutaimagen=document.getElementById("imagenAgua").value;
	mostrarImagenAntesDeImprimir();
}
function descaragarSolido(){
	rutaimagen=document.getElementById("imagenSolido").value;
	mostrarImagenAntesDeImprimir();
}
function descaragarPlano(){
	rutaimagen=document.getElementById("imagenPlano").value;
	mostrarImagenAntesDeImprimir();
}
function descaragarCedula(){
	rutaimagen=document.getElementById("imagenCedula").value;
	mostrarImagenAntesDeImprimir();
}
function mostrarImagenAntesDeImprimir(){
	window.open("http://asoprolesa-saucetico/view/facturas/imprimirMostrarImagenes.php?ruta="+rutaimagen, "popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
}
/*estandar de las consultas ajax*/
function datosAjax(mensaje,contenido){
    var nuevo = crearAjax();
    //console.log(nuevo);
    nuevo.open("POST","../../data/imagenes/procesar-subida.php");
    nuevo.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    nuevo.send(mensaje);

    nuevo.onreadystatechange=function(){
        if(nuevo.readyState == 4 && nuevo.status == 200){

            contenido.innerHTML=nuevo.responseText;
        }
    }
}

function buscarImagenes(){
	codigo=document.getElementById("far").value;
	contenido=document.getElementById("gall");
    mensaje="accion=imagenesproductorsocio&&id="+codigo;
    datosAjax(mensaje,contenido);
}

$(document).ready(function(){

	$('#btn_enviar').on("click", function(evt){

		evt.preventDefault();

		// declaro la variable formData e instancio el objeto nativo de javascript new FormData
		var formData = new FormData(document.getElementById("frmSubir"));

		// declaro la variable ruta
		var ruta = '../../data/imagenes/procesar-subida.php';

		// iniciar el ajax
		$.ajax({

			url: ruta,

			// el metodo para enviar los datos es POST
			type: "POST",

			// colocamos la variable formData para el envio de la imagen
			data: formData,

			contentType: false,

			processData: false,

			beforeSend: function()
			{
			    //$('#mensaje').prepend('<img src="facebook.gif" width="30px" height="30px"/>');
			    $('#mensaje').prepend('Procesando datos ....');
			},

			success: function(data)
			{

				$('#mensaje').fadeOut("fast",function(){
					//$('#mensaje').html(data);
					var archivo=document.getElementById("filemage").value;
					if(archivo!=""){
						men='<h3 style=color:green;">Imagen guardada correctamente.</h3>';
										$('#mensaje').html(men);
					}else{
						men='<h3 style="color:red;">Seleccione una IMAGEN.</h3>';
										$('#mensaje').html(men);
					}

				});

				$('#mensaje').fadeIn("slow");

			}


		});

	});
	document.getElementById("filemage").value="";
//location.href = '../../view/productor/pedo.php';
});
/**
 * [rutaImagenColocar lo que hace es colocar la imagen en el modal que se va a visusalizar para la modificacion]
 * @return {[img]} [Reescribe la imagen del modal por la que se pasa por parametros]
 */
function rutaImagenColocar(){
var ruta="<img src='"+rutaimagen+"'>";
document.getElementById("imagen").innerHTML=ruta;
}
/**
 * [abrirCBO Lo que hace es abrir el modal de las imagen para poder modificarla de acuerdo a la imagen del CBO ]
 * @return {[modal]} [habre el modal para que se pueda modificar lo de la imagen seleccionada]
 */
	function abrirCBO(){

		rutaimagen=document.getElementById("imagenCBO").value;/*obtendremos el valor  de la ruta a la variable global*/

		document.getElementById("nombre").value=rutaimagen;/*la variable global sobre escribe el hidden del modal de nombre*/

		rutaImagenColocar();/*lo que hace es colocar la imagen al modal antes de la visualizacion de los datos*/

		document.getElementById("contenedorImagen").style.transform="translateY(0%)";
		//alert(rutaimagen);
	}
	/**
	 * [abrirSangrado Lo que hace es abrir el modal de las imagen para poder modificarla de acuerdo a la imagen del sangrado]
 	* @return {[modal]} [habre el modal para que se pueda modificar lo de la imagen seleccionada]
 	*/
	function abrirSangrado(){

		rutaimagen=document.getElementById("imagenSangrado").value;/*obtendremos el valor  de la ruta a la variable global*/

		document.getElementById("nombre").value=rutaimagen;/*la variable global sobre escribe el hidden del modal de nombre*/

		rutaImagenColocar();/*lo que hace es colocar la imagen al modal antes de la visualizacion de los datos*/

		document.getElementById("contenedorImagen").style.transform="translateY(0%)";
		//alert(rutaimagen);
	}
		/**
 		* [abrirEscritura Lo que hace es abrir el modal de las imagen para poder modificarla de acuerdo a la imagen del Escritura]
 		* @return {[modal]} [habre el modal para que se pueda modificar lo de la imagen seleccionada]
 		*/
	function abrirEscritura(){

		rutaimagen=document.getElementById("imagenEscritura").value;/*obtendremos el valor  de la ruta a la variable global*/

		document.getElementById("nombre").value=rutaimagen;/*la variable global sobre escribe el hidden del modal de nombre*/

		rutaImagenColocar();/*lo que hace es colocar la imagen al modal antes de la visualizacion de los datos*/

		document.getElementById("contenedorImagen").style.transform="translateY(0%)";
		//alert(rutaimagen);
	}
		/**
 		* [abrirLuz Lo que hace es abrir el modal de las imagen para poder modificarla de acuerdo a la imagen del Luz]
 		* @return {[modal]} [habre el modal para que se pueda modificar lo de la imagen seleccionada]
 		*/
	function abrirLuz(){

		rutaimagen=document.getElementById("imagenLuz").value;/*obtendremos el valor  de la ruta a la variable global*/

		document.getElementById("nombre").value=rutaimagen;/*la variable global sobre escribe el hidden del modal de nombre*/

		rutaImagenColocar();/*lo que hace es colocar la imagen al modal antes de la visualizacion de los datos*/

		document.getElementById("contenedorImagen").style.transform="translateY(0%)";
		//alert(rutaimagen);
	}
		/**
 		* [abrirAgua Lo que hace es abrir el modal de las imagen para poder modificarla de acuerdo a la imagen del Agua]
 		* @return {[modal]} [habre el modal para que se pueda modificar lo de la imagen seleccionada]
 		*/
	function abrirAgua(){

		rutaimagen=document.getElementById("imagenAgua").value;/*obtendremos el valor  de la ruta a la variable global*/

		document.getElementById("nombre").value=rutaimagen;/*la variable global sobre escribe el hidden del modal de nombre*/

		rutaImagenColocar();/*lo que hace es colocar la imagen al modal antes de la visualizacion de los datos*/

		document.getElementById("contenedorImagen").style.transform="translateY(0%)";
		//alert(rutaimagen);
	}
		/**
 		* [abrirSolido Lo que hace es abrir el modal de las imagen para poder modificarla de acuerdo a la imagen del solido]
 		* @return {[modal]} [habre el modal para que se pueda modificar lo de la imagen seleccionada]
 		*/
	function abrirSolido(){

		rutaimagen=document.getElementById("imagenSolido").value;/*obtendremos el valor  de la ruta a la variable global*/

		document.getElementById("nombre").value=rutaimagen;/*la variable global sobre escribe el hidden del modal de nombre*/

		rutaImagenColocar();/*lo que hace es colocar la imagen al modal antes de la visualizacion de los datos*/

		document.getElementById("contenedorImagen").style.transform="translateY(0%)";
		//alert(rutaimagen);
	}
		/**
 		* [abrirPlano Lo que hace es abrir el modal de las imagen para poder modificarla de acuerdo a la imagen del plano]
 		* @return {[modal]} [habre el modal para que se pueda modificar lo de la imagen seleccionada]
 		*/
	function abrirPlano(){

		rutaimagen=document.getElementById("imagenPlano").value;/*obtendremos el valor  de la ruta a la variable global*/

		document.getElementById("nombre").value=rutaimagen;/*la variable global sobre escribe el hidden del modal de nombre*/

		rutaImagenColocar();/*lo que hace es colocar la imagen al modal antes de la visualizacion de los datos*/

		document.getElementById("contenedorImagen").style.transform="translateY(0%)";
		//alert(rutaimagen);
	}
		/**
 		* [abrirCedula Lo que hace es abrir el modal de las imagen para poder modificarla de acuerdo a la imagen del Cedula]
 		* @return {[modal]} [habre el modal para que se pueda modificar lo de la imagen seleccionada]
 		*/
	function abrirCedula(){

		rutaimagen=document.getElementById("imagenCedula").value;/*obtendremos el valor  de la ruta a la variable global*/

		document.getElementById("nombre").value=rutaimagen;/*la variable global sobre escribe el hidden del modal de nombre*/

		rutaImagenColocar();/*lo que hace es colocar la imagen al modal antes de la visualizacion de los datos*/

		document.getElementById("contenedorImagen").style.transform="translateY(0%)";
		//alert(rutaimagen);
	}
/**
 * [Le da la funcionalidad al btn del modal de la imagen cancelar.]
 * @param  {Click} evt){[sobre escribe los datos de la posicion Y del modal a visualizar]
 * @return {[Llo que hace es ocultar de nuevo el modal el cual ya no  se ocupa]}                                                                     [description]
 */
$(document).ready(function(){
	$('#btn_cancelar').on("click", function(evt){
		evt.preventDefault();//Este metodo lo que se encarga es de que no se sobre cargue la pagina principal donde esta el metod en si.
		//alert("Tocando el boton de Cerrar el modal.");//Alerta encargada de poder motrar el mensaje de la informacion de que se se se elcciono el modal de cerra.
		po=document.getElementById("encriptado").value;
		document.getElementById("contenedorImagen").style.transform="translateY(-150%)";//Esta funcion lo que hace es ocultar de nuevo el modal de la imagen visualizada.
		//window.location.reload();//lo que hace es recargar la paguina de origen global y sin necesidad de la redireccionamiento.
		window.location.reload(true);
		/*id=document.getElementById("encriptado").value;
		window.location.href = '../../view/productor/verImagenProductorSocioView.php?id='+id;
		*/
});
});
/*Finalización del metodo de la función de cancelar o cerrar el modal de la imagen a modificar.*/
function fileProview(input){/*El metodo lo que resive como parametro es un input de tipo file para poder hacer la corrobacion de los datos.*/
	if(input.files && input.files[0]){/*Este if es el encargado de poder corroborar que todos los datos esten bien osea que la imagen sea seleccionada y carge bien.*/
		var reader= new FileReader();//Se crea una instancia de un archivo para poder cargar los datos en el mismo.
		reader.readAsDataURL(input.files[0]);//Lo que hacemos es poder asignare el valor del input de la subida en la nueva imagen a poder visualizar.
		reader.onload =function (e){//Esta funcion es la encargada de poder eliminar los datos del modal y cargar los nuevos datos del mismo.
			//$('#imagen + img').remove();//Lo que hace es poder remover la imagen que sta
			nuevaImagen='<img src="'+e.target.result+'" width="430" height="300" />';
			$('#imagen').html(nuevaImagen);
			//after('<img src="'+e.target.result+'" width="430" height="300" />');/*Se crea la instancia a utilizar la cual sera la nueva imagen que se visualizara en el modal que el usaurio esta biendo*/
		}
	}
}
/*terminacion del metodo de ensenar la imagen antes de poder subirla con el objetio de que el usuario pueda ver si esa imagen es la correcta a la hora de la subida.*/
$(document).ready(function(){
$("#filemage").change(function(){
	console.log("Datos cargados bien");
	var datooo=control(this);
	if(datooo==true){
		fileProview(this);/*Se redirecciona la funcionalidad y el focus del file a el metodo de sobre escritura de la imagen en el input del modal.*/
	}else{
		swal({
                    title: "Imagen",
                    text: "Error, estenciones validas .JPG, .JPEG, .PNG",
                    icon: "error",
                    buttons: {
                        ok: {
                            text: "Aceptar",
                            value: "ok"
                        }
                    },
                    dangerMode: true
                });
		//alert("Extencion no valida.");
		this.value="";
	}

});
});

function control(f){
	var bandera=false;
    var ext=['gif','jpg','jpeg','png'];
    var v=f.value.split('.').pop().toLowerCase();
    for(var i=0,n;n=ext[i];i++){
        if(n.toLowerCase()==v){
            bandera=true;
        }
    }
    return bandera;
    /*var t=f.cloneNode(true);
    t.value='';
    f.parentNode.replaceChild(t,f);
    alert('extensión no válida');*/
}

var rutaimagen;
window.onload=function(){
	buscarImagenes();
};
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
					$('#mensaje').html(data);

				});

				$('#mensaje').fadeIn("slow");
				
			} 


		});

	});
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
	$('#btn_cancelar').on("click", function(evt){
		document.getElementById("contenedorImagen").style.transform="translateY(-150%)";
		window.location.href = '../../view/productor/verImagenProductorSocioView.php';
	});

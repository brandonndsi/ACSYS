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
    mensaje="accion=imagenesempleado&&id="+codigo;
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
	 * [abrirSangrado Lo que hace es abrir el modal de las imagen para poder modificarla de acuerdo a la imagen del sangrado]
 	* @return {[modal]} [habre el modal para que se pueda modificar lo de la imagen seleccionada]
 	*/
	function abrirManipulacionAlimento(){

		rutaimagen=document.getElementById("imagenManipulacionAlimento").value;/*obtendremos el valor  de la ruta a la variable global*/

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
		evt.preventDefault();
		//alert("sdsadsa");
		//po=document.getElementById("encriptado").value;
		document.getElementById("contenedorImagen").style.transform="translateY(-150%)";
		location.reload();
});
});
	/*$('#btn_cancelar').on("click", function(evt){
		document.getElementById("contenedorImagen").style.transform="translateY(-150%)";
		window.location.href = '../../view/empleado/verImagenEmpleadoView.php';
	});*/
function descaragarManipulacionAlimento(){
	rutaimagen=document.getElementById("imagenManipulacionAlimento").value;
	window.open("http://localhost/ACSYSIIIsemestre/view/facturas/imprimirMostrarImagenes.php?ruta="+rutaimagen, "popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
}
//descaragarCedula
function descaragarCedula(){
	rutaimagen=document.getElementById("imagenCedula").value;
	window.open("http://localhost/ACSYSIIIsemestre/view/facturas/imprimirMostrarImagenes.php?ruta="+rutaimagen, "popupId", "location=center,menubar=no,titlebar=no,resizable=no,toolbar=no, menubar=no,width=1000,height=600");
}
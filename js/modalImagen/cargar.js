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

});

$('#btn_cancelar').on("click", function(evt){
		document.getElementById("contenedorImagen").style.transform="translateY(-150%)";
		//location.href = '../../view/distribuidor/verDistribuidorView.php';
		});
$("#filemage").on("change",function(){
					alert("hola");
});
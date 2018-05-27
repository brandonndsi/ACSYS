$(document).ready(function() {

  $('#btn_enviar').on('click', function(evt) {

    evt.preventDefault();

    //Declaro la variable formData e instancio el objeto nativo de javascript new FormData
    var formData = new FormData(document.getElementById('frmSubir'));

    // declaro la variable ruta
    var ruta = '../../data/imagenes/procesar-subida.php';

    // iniciar el ajax
    $.ajax({

      url: ruta,

      // el metodo para enviar los datos es POST
      type: 'POST',

      // colocamos la variable formData para el envio de la imagen
      data: formData,

      contentType: false,

      processData: false,

      beforeSend: function() {
        //$('#mensaje').prepend('<img src="facebook.gif" width="30px" height="30px"/>');
        $('#mensaje').prepend('Procesando datos ....');
      },

      success: function(data) {
        $('#mensaje').fadeOut('fast', function() {
					var men;
          var archivo=document.getElementById("filemage").value;
          if(archivo!=NULL){
            men='<h3 style="background:green;">Imagen guardada correctamente.</h3>';
                    $('#mensaje').html(men);
          }else{
            men='<h3 style="background:red;">Imagen  No guardada.</h3>';
                    $('#mensaje').html(men);
          }


        });

        $('#mensaje').fadeIn('slow');

      }


    });


  });

});

$('#btn_cancelar').on('click', function(evt) {
  id = document.getElementById('encriptado').value;
  alert('Tocando el boton de Cancelar de la imagen');
  document.getElementById('contenedorImagen').style.transform = 'translateY(-150%)';
  location.href = '../../view/distribuidor/verDistribuidorView.php?id=' + id;
});

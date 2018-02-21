function registrarLeche(){
  cliente=document.getElementById("selectCliente").value;

  fecha=document.getElementById("fecha").value;
  split=fecha.split("/");

  tarde=document.getElementById("tarde").value;
  manana=document.getElementById("manana").value;
  
  $(document).ready(function() {
      $.post('../../business/productor/actionRecepcionLeche.php', {
              action : 'registrarLeche' ,
              cliente: cliente,
              fecha: split[2]+"/"+split[1]+"/"+split[0],
              tarde: tarde,
              manana: manana,
              

      }, function(responseText) {
          respuesta="";
          if(responseText=="true"){
              respuesta="<h4>Se ha registrado los litros de leche satisfactoriamente</h4>";
              mostrarProductores();

          }else{
              respuesta="<h4>Ocurrió un error al registrar los litros de leche</h4>";
          }     
          $("#mensaje").html(respuesta);
          $("#modalRespuesta").modal();
         
      });
  });

}


function mostrarFunciones(id){

  $(document).ready(function() {
      $.post('../../business/producto/actionVeterinarios.php', {
              action : 'consultarfunciones'
      }, function(responseText) {
        
        json = JSON.parse(responseText);
        html = "";

        for(i = 0 ;i<json.length; i++){
          
          html+="<option >"+json[i].nombrefuncion+"</option>";
          
        }
        $("#"+id).html(html);
        
      });
  });
}

function mostrarVias(id){

  $(document).ready(function() {
      $.post('../../business/producto/actionVeterinarios.php', {
              action : 'consultarvias'
      }, function(responseText) {
        
        json = JSON.parse(responseText);
        html = "";

        for(i = 0 ;i<json.length; i++){
          
          html+="<option >"+json[i].nombreviaaplicacion+"</option>";
          
        }
        $("#"+id).html(html);
        
      });
  });
}
function mostrarUnidades(id){

  $(document).ready(function() {
      $.post('../../business/producto/actionUnidades.php', {
              action : 'consultarunidades'
      }, function(responseText) {
        
        json = JSON.parse(responseText);
        html = "";

        for(i = 0 ;i<json.length; i++){
          
          html+="<option >"+json[i].unidad+"</option>";
          
        }
        $("#"+id).html(html);
        
      });
  });
}

function mostrarVias(id){
  $(document).ready(function() {
      $.post('../../business/producto/actionUnidades.php', {
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

function mostrarFuncion(id){
  $(document).ready(function() {
      $.post('../../business/producto/actionUnidades.php', {
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
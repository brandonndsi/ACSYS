function mostrarUnidades(){

  $(document).ready(function() {
      $.post('../../business/producto/actionUnidades.php', {
              action : 'consultarunidades'
      }, function(responseText) {
        
        json = JSON.parse(responseText);
        html = "";

        for(i = 0 ;i<json.length; i++){
          
          html+="<option >"+json[i].unidad+"</option>";
          
        }
        $("#unidad").html(html);
        
      });
  });
}
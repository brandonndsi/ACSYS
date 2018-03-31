<!DOCTYPE html>
<html>
<head>
  <title>Productor Cliente Imagen</title>

  <!-- CSS 
  <script type="text/javascript" src="../../js/jquery-1.10.2.js"></script>-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../../css/imagenes/imagenesProductor.css">
  <link rel="stylesheet" type="text/css" href="../../css/distribuidor/modalImagen.css">

  <link rel="stylesheet" href="../../css/menu.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="../../js/productor/imagenproductorCliente.js"></script>
</head>
<body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%">
          <?php 
          include '../menuView.php';
          $id;
           if(isset($_GET['id']) && !empty($_GET['id'])){
          //$dato=$_GET['id'];
          //$id=$dato;
        $id=base64_decode($_GET['id']);
          //echo $d;
          }
           ?>
<div class="container">
  <!-- Modal de la imagenes -->
  <input type="hidden" value="<?php echo $id ?>" id="far">
<div id="contenedorImagen">
    <div id=contImagen>
        <div id="imagen">
           <img src="" id="recibir-imagene"> 
        </div>
        <div id="formImagen">
            <?php 
                include_once '../modalimagen/modalImagen.php';
             ?>
        </div>
    </div>
</div>
<!-- terminacion del modal de las imagenes-->
<div class="gallery" id="gall"></div>
</div>

</body>
</html>

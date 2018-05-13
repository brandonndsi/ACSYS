<!DOCTYPE html>
<html>
<head>
  <title>Productor Cliente Imagen</title>

  <!-- CSS 
  <script type="text/javascript" src="../../js/jquery-3.3.1.js"></script>-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../../css/imagenes/imagenesProductor.css">
  <link rel="stylesheet" type="text/css" href="../../css/distribuidor/modalImagen.css">
    <link rel="stylesheet" href="../../css/ventaVeterinaria.css">

  <link rel="stylesheet" href="../../css/menu.css">
  <link rel="stylesheet" href="../../css/bootstrap.min.css" >
  
  <script src="../../js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="../../js/productor/imagenproductorCliente.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body background="../fondo.jpg">
          <?php 
          //include '../menuView.php';
          include '../InterumtorDeMenus.php';
          $id;
           if(isset($_GET['id']) && !empty($_GET['id'])){
          //$dato=$_GET['id'];
          $ids=$_GET['id'];
        $id=base64_decode($_GET['id']);
          //echo $d;
          }
           ?>
<div class="container">
  <!-- Modal de la imagenes -->
  <input type="hidden" value="<?php echo $ids ?>" id="encriptado">
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

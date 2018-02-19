<!DOCTYPE html>
<?php 
    session_start();
    error_reporting(0);
    if($_SESSION['user']!=null){

        header("Location:view/productor/verProductorSocioView.php");

    }

?>
<html>
  <head>
    <title>Sistema de planilla</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Import library bootstrap-->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Import style and js Login -->
    <script src="js/loginJS.js"></script>
    <link rel="stylesheet" href="css/loginStyle.css">
  </head>
  <body>
    <!-- Login html -->
    <div class="container">
	     <div class="login-container">
            <div id="output"></div>
            <div class="avatar"></div>
            <div class="form-box">
                <form action="business/login/loginAction.php" method="POST">
                    <input name="user" type="text" placeholder="Usuario">
                    <input type="password" name="password" placeholder="Contraseña">
                    <button class="btn btn-info btn-block login" type="submit">Iniciar sesión</button>
                </form>
            </div>
        </div>
      </div>
  </body>
</html

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <!--CSS-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <link rel="stylesheet" href="../../css/jquery.dataTables.css">
        <link rel="stylesheet" href="../../css/menu.css">
        <link rel="stylesheet" href="../../css/bootstrap.min.css" >
        <!--<link rel="stylesheet" href="../../css/info.css">-->
        <link rel="stylesheet" href="../../css/carrucel/carrucel.css">
        <!--Javascript-->
        <script src="../../js/jquery.dataTables.js"></script>
        <script src="../../js/menuJs.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/ventas/ventaDistribuidor.js"></script>
        <script src="../../js/autocomplete.js"></script>
        <script>
            localStorage.clear();
            $(document).ready(function () {
                $('[data-toggle="tooltip"]');
            });
        </script>
    </head>

    <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%">
        <?php
        include '../InterumtorDeMenus.php';
        
        ?>
        <main>
        <section id="info">
                <h3>Bienvenidos  a ASOPROLESA.</h3>
                <!--Carrucel-->
            <section id="bienvenidos">

                <div id="contenedor_carrucel">
                    <ul id="carrucel" >
                        <li data-target="#contenedor_carrucel">
                            <a style="color:white;" href="#">
                                <strong style="color:black;">Animales</strong>
                                <img src="../../image/prin/venta.jpg" id="carru">
                            </a>
                        </li>
                        <li data-target="#contenedor_carrucel">
                            <a style="color:white;" href="#">
                                <strong style="color:black;">Productos</strong>
                                <img src="../../image/prin/procesos.jpg" id="carru">
                            </a>
                        </li>
                        <li data-target="#contenedor_carrucel">
                            <a style="color:white;" href="#">
                                <strong style="color:black;">Productos</strong>
                                <img src="../../image/prin/productos.jpg" id="carru">
                            </a>
                        </li>
                        <li data-target="#contenedor_carrucel">
                            <a style="color:white;" href="#">
                                <strong style="color:black;">Productos</strong>
                                <img src="../../image/prin/lacteos.jpg" id="carru">
                            </a>
                        </li>
                    </ul>
                </div>
            </section>
            <!-- Terminacion del carrucel-->
                <!--<div class="contenedor">
                    <div class="info-repuesto">
                        <a href="#"><img src="../../image/prin/venta.jpg"></a>
                        <h4>Venta</h4>
                    </div>

                    <div class="info-repuesto">
                        <a href="#"><img src="../../image/prin/procesos.jpg"></a> 
                        <h4>procesos</h4>
                    </div>

                    <div class="info-repuesto">
                        <a href="#"><img src="../../image/prin/productos.jpg"></a>
                        <h4>Producto</h4>
                    </div>
                    <div class="info-repuesto">
                        <a href="#pro"><img src="../../image/prin/perfil.png"></a>
                        <h4>Productores</h4>
                    </div>
                </div>-->
            </section>
        </main>
    </body>
</html>


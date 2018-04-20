<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">

        <!--CSS-->
        <link rel="stylesheet" href="../../css/jquery.dataTables.css">
        <link rel="stylesheet" href="../../css/menu.css">
        <link rel="stylesheet" href="../../css/bootstrap.min.css" >

        <!--Javascript-->
        <script src="../../js/jquery-3.2.1.js"></script>
        <script src="../../js/jquery.dataTables.js"></script>
        <script src="../../js/proceso/procesoJS.js"></script>
        <script src="../../js/menuJs.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </head>

    <body background="../fondo.jpg" style="width:90%;margin-left:5%;margin-top:2%" onload="mostrarTabla();consultarProduct();">
        <?php
        //include '../menuView.php';
        include '../InterumtorDeMenus.php';
        ?>

        <div class='col-md-3' >
            <h3>ASOPROLESA</h3>
            <h5>EL SAUCE SANTA TERESITA</h5>
        </div>
        <div class='col-md-7' >
            <h3> REGISTRO DE PROCESOS              
                <button onclick="location.href = '../proceso/verProcesoView.php'" class="btn btn-primary">Ver Procesos </button> 
                <button onclick="registrarProceso()" class="btn btn-primary">Registrar </button>
            </h3>
        </div>

        <div>
            <table id="tabla" class="table" cellspacing="0" >
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="datos">

                </tbody>      
            </table>  
        </div>   

    </body>
</html>

 <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
         <link href="../../css/me.css" rel="stylesheet">
 <div class="nav-side-menu">
    <div class="brand">ASOPROLESA</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="./principalEmpleadoView.php">
                  <i class="fa fa-dashboard fa-lg"></i> Escritorio
                  </a>
                </li>

                 <li>
                  <a href="../empleado/verEmpleadoView.php">
                  <i class="fa fa-user fa-lg"></i> Empleados
                  </a>
                  </li>
                <li>
                  <a href="../distribuidor/verDistribuidorView.php">
                  <i class="fa fa-user fa-lg"></i> Distribuidor
                  </a>
                </li>

                <li  data-toggle="collapse" data-target="#productores" class="collapsed ">
                  <a href="#"><i class="fa fa-gift fa-lg"></i>Productor <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="productores">
                    <li class="active"><a href="../productor/verProductorSocioView.php">Productor Socio</a></li>
                    <li><a href="../productor/verProductorClienteView.php">Productor Cliente</a></li>
                    <li><a href="../productor/verAhorro.php">Ver cantidad ahorro x litro</a></li>
                    <li><a href="../productor/verAhorroTotal.php">Total ahorro</a></li>
                </ul>

                <li  data-toggle="collapse" data-target="#leche" class="collapsed ">
                  <a href="#"><i class="fa fa-gift fa-lg"></i>Recepción de leche <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="leche">
                    <li class="active"><a href="../productor/verRecepcionLeche.php">Ver</a></li>
                    <li><a href="../productor/recepcionLeche.php">Recibir leche</a></li>
                    <li><a href="../productor/verPagoLeche.php">Pagar leche</a></li>
                </ul>



                <li data-toggle="collapse" data-target="#productos" class="collapsed">
                  <a href="#"><i class="fa fa-globe fa-lg"></i> Productos <span class="arrow"></span></a>
                </li>  
                <ul class="sub-menu collapse" id="productos">
                  <li><a href="../producto/verProductoLacteoView.php"> Producto Lácteo</a></li>
                  <li><a href="../producto/verProductoVeterinarioView.php"> Producto Veterinario</a></li>
                </ul>


                <li data-toggle="collapse" data-target="#ventas" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i>Ventas <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="ventas">
                  <li><a href="../ventas/ventanilla.php">Ventanilla</a></li>
                  <li><a href="../ventas/distribuidor.php">Distribuidor</a></li>
                  <li><a href="../ventas/veterinario.php">Veterinario</a></li>
                </ul>

                <li data-toggle="collapse" data-target="#adelanto" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i>Adelanto de pago <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="adelanto">
                  <li><a href="../productor/registrarPrestamo.php">Solicitud de adelanto</a></li>
                  <li><a href="../productor/aprobarPrestamos.php">Aprobar solicitud</a></li>
                  <li><a href="../productor/pagarCuotaPrestamo.php">Pagar cuota</a></li>
                </ul>
                <li data-toggle="collapse" data-target="#proceso" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i>Procesos <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="proceso">
                  <li><a href="../../view/proceso/procesoView.php">Ver proceso</a></li>
                  <li><a href="">Agregar proceso</a></li>
                </ul>
                <li data-toggle="collapse" data-target="#reportes" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i>Reportes <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="reportes">
                  <li><a href="../../view/reportes/ventas.php">Venta veterinaria</a></li>
                  <li><a href="../../view/reportes/ventaDistribuidor.php">Venta Distribuidor</a></li>
                  <li><a href="../../view/reportes/ventaVentanilla.php">Venta Ventanilla</a></li>
                  <li><a href="../../view/reportes/prestamos.php">Adelanto de pago</a></li>
                  <li><a href="../../view/reportes/pagosPrestamos.php">Pago de adelanto</a></li>
                  <li><a href="../../view/reportes/pagoLeche.php">Pago de leche</a></li>
                  <li><a href="../../view/reportes/ahorros.php">Ahorros</a></li>
                  <li><a href="../../view/reportes/procesos.php">Procesos</a></li>
                </ul>
                <li data-toggle="collapse" data-target="#perfil" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i><?php  echo @$_SESSION['nombreUsuario'] ?><span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="perfil">
                  <li><a href="../../view/perfil/perfil.php">Mi perfil</a></li>
                  <li><a href="../../data/login/cerrarSesionData.php">Salir</a></li>
                </ul>
            </ul>
     </div>
</div>
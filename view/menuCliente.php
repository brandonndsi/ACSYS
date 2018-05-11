 <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
         <link href="../../css/me.css" rel="stylesheet">
 <div class="nav-side-menu">
    <div class="brand">ASOPROLESA</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="#">
                  <i class="fa fa-dashboard fa-lg"></i> Escritorio
                  </a>
                </li>

                 <li>
                  <a href="#">
                  <i class="fa fa-user fa-lg"></i> Empleados
                  </a>
                  </li>
                <li>
                  <a href="#">
                  <i class="fa fa-user fa-lg"></i> Distribuidor
                  </a>
                </li>

                <li  data-toggle="collapse" data-target="#productores" class="collapsed ">
                  <a href="#"><i class="fa fa-gift fa-lg"></i>Productor <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="productores">
                    <li class="active"><a href="#">Productor Socio</a></li>
                    <li><a href="#">Productor Cliente</a></li>
                    <li><a href="#">Ver cantidad ahorro x litro</a></li>
                    <li><a href="#">Total ahorro</a></li>
                </ul>

                <li  data-toggle="collapse" data-target="#leche" class="collapsed ">
                  <a href="#"><i class="fa fa-gift fa-lg"></i>Recepción de leche <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="leche">
                    <li class="active"><a href="#">Ver</a></li>
                    <li><a href="#">Recibir leche</a></li>
                    <li><a href="#">Pagar leche</a></li>
                </ul>



                <li data-toggle="collapse" data-target="#productos" class="collapsed">
                  <a href="#"><i class="fa fa-globe fa-lg"></i> Productos <span class="arrow"></span></a>
                </li>  
                <ul class="sub-menu collapse" id="productos">
                  <li>Producto Veterinario</li>
                  <li>Producto Lácteo</li>
                </ul>


                <li data-toggle="collapse" data-target="#ventas" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i>Ventas <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="ventas">
                  <li>Ventanilla</li>
                  <li>Distribuidor</li>
                  <li>Veterinario</li>
                </ul>

                <li data-toggle="collapse" data-target="#adelanto" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i>Adelanto de pago <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="adelanto">
                  <li>Solicitud de adelanto</li>
                  <li>Aprobar solicitud</li>
                  <li>Pagar cuota</li>
                </ul>
                <li data-toggle="collapse" data-target="#proceso" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i>Procesos <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="proceso">
                  <li>Ver proceso</li>
                  <li>Agregar proceso</li>
                </ul>
                <li data-toggle="collapse" data-target="#reportes" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i>Reportes <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="reportes">
                  <li>Venta veterinaria</li>
                  <li>Venta Distribuidor</li>
                  <li>Venta Ventanilla</li>
                  <li>Adelanto de pago</li>
                  <li>Pago de adelanto</li>
                  <li>Pago de leche</li>
                  <li>Ahorros</li>
                  <li>Procesos</li>
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
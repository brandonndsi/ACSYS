 <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
         <link href="../../css/me.css" rel="stylesheet">
         
 <div class="nav-side-menu">
    <div class="brand">ASOPROLESA</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="../principalEmpleado/principalEmpleadoView.php">
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
                </ul>

                <li  data-toggle="collapse" data-target="#leche" class="collapsed ">
                  <a href="#"><i class="fa fa-gift fa-lg"></i>Recepción de leche <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="leche">
                    <li class="active"><a href="../productor/verRecepcionLeche.php">Ver</a></li>
                    <li><a href="../productor/recepcionLeche.php">Recibir leche</a></li>
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
                  <li><a href="../ventas/ventanilla.php">Ventanilla</a></li>
                  <li><a href="../ventas/distribuidor.php">Distribuidor</a></li>
                  <li><a href="../ventas/veterinario.php">Veterinario</a></li>
                </ul>
                <li data-toggle="collapse" data-target="#proceso" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i>Procesos <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="proceso">
                  <li><a href="../../view/proceso/procesoView.php">Ver proceso</a></li>
                  <li>Agregar proceso</li>
                </ul>
            </ul>
     </div>
</div>
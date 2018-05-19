 <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
         <link href="../../css/me.css" rel="stylesheet">
         
 <div class="nav-side-menu">
    <div class="brand">ASOPROLESA</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
  
        <div class="menu-list">
  
            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="../principalEmpleado/principalEmpleadoView.php">
                  <i class="glyphicon glyphicon-pushpin"></i> Escritorio
                  </a>
                </li>
                <li>
                  <a href="../distribuidor/verDistribuidorView.php">
                  <i class="glyphicon glyphicon-user"></i> Distribuidor
                  </a>
                </li>

                <li  data-toggle="collapse" data-target="#productores" class="collapsed ">
                  <a href="#"><i class="fa fa-user"></i>Productor <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="productores">
                    <li class="active"><a href="../productor/verProductorSocioView.php">Productor Socio</a></li>
                    <li><a href="../productor/verProductorClienteView.php">Productor Cliente</a></li>
                </ul>

                <li  data-toggle="collapse" data-target="#leche" class="collapsed ">
                  <a href="#"><i class="glyphicon glyphicon-import"></i>Recepción de leche <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="leche">
                    <li class="active"><a href="../productor/verRecepcionLeche.php">Ver</a></li>
                    <li><a href="../productor/recepcionLeche.php">Recibir leche</a></li>
                </ul>



                <li data-toggle="collapse" data-target="#productos" class="collapsed">
                  <a href="#"><i class="glyphicon glyphicon-ice-lolly"></i> Productos <span class="arrow"></span></a>
                </li>  
                <ul class="sub-menu collapse" id="productos">
                  <li><a href="../producto/verProductoLacteoView.php"> Producto Lácteo</a></li>
                  <li><a href="../producto/verProductoVeterinarioView.php"> Producto Veterinario</a></li>
                </ul>


                <li data-toggle="collapse" data-target="#ventas" class="collapsed">
                  <a href="#"><i class="glyphicon glyphicon-shopping-cart"></i>Ventas <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="ventas">
                  <li><a href="../ventas/ventanilla.php">Ventanilla</a></li>
                  <li><a href="../ventas/distribuidor.php">Distribuidor</a></li>
                  <li><a href="../ventas/veterinario.php">Veterinario</a></li>
                </ul>
                <li data-toggle="collapse" data-target="#proceso" class="collapsed">
                  <a href="#"><i class="glyphicon glyphicon-tasks"></i>Procesos <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="proceso">
                  <li><a href="../../view/proceso/verProcesoView.php">Ver proceso</a></li>
                  <li><a href="../../view/proceso/procesoView.php">Agregar proceso</a></li>
                </ul>
            </ul>
     </div>
</div>
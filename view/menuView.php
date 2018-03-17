<?php
    session_start();
    if(@!$_SESSION['user']){

      header("Location:../../index.php");
    }
?>
<div class="container">
  <nav class="navbar navbar-inverse">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">ASOPROLESA</a>
  </div>

  <div class="collapse navbar-collapse js-navbar-collapse">
    <ul class="nav navbar-nav">
      <li>

        <li><a href="../empleado/verEmpleadoView.php">Empleados</a></li>
        <li><a href="../distribuidor/verDistribuidorView.php">Distribuidores</a></li>


         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Productores<span class="caret"></span></a>
        <ul class="dropdown-menu mega-dropdown-menu">
          <li>
              <ul>
                <li><a href="../productor/verProductorClienteView.php">Productor Cliente</a></li>
                <li><a href="../productor/verProductorSocioView.php">Producto Socio</a></li>
                <li><a href="../productor/verAhorro.php">Ver Monto de Ahorros</a></li>
                <li><a href="../productor/verAhorroTotal.ph">Ver Ahorros Totales</a></li>
                <li class="dropdown"><a href="../productor/recepcionLeche.php" >Recepción de leche<span class="caret"></span></a>
                   <ul class="dropdown-menu mega-dropdown-menu">
                     <li>
                       <ul>
                          <li><a href="../productor/verRecepcionLeche.php" >Ver </a></li>
                          <li><a href="../productor/recepcionLeche.php">Pago entrega de leche</a></li>
                        </ul>
                      </li>
                    </ul>
                </li>

            </ul>
          </li>
        </ul>
      </li>
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Productos<span class="caret"></span></a>
        <ul class="dropdown-menu mega-dropdown-menu">
          <li>
              <ul>
                <li><a href="../producto/verProductoLacteoView.php">Productos Lacteos</a></li>
                <li><a href="../producto/verProductoVeterinarioView.php">Productos Veterinarios</a></li>

            </ul>
          </li>
        </ul>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ventas<span class="caret"></span></a>
      <ul class="dropdown-menu mega-dropdown-menu">
        <li>
            <ul>
              <li><a href="../ventas/ventanilla.php">Ventanilla</a></li>
              <li><a href="../ventas/distribuidor.php">Distribuidor</a></li>
              <li><a href="../ventas/veterinario.php">Veterinario</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Préstamos<span class="caret"></span></a>
      <ul class="dropdown-menu mega-dropdown-menu">
        <li>
            <ul>
              <li><a href="#">Solicitud de préstamo</a></li>
              <li><a href="#">Pago de préstamo</a></li>

          </ul>
        </li>
      </ul>
    </li>
    <li><a href="#">Procesos</a></li>


    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes<span class="caret"></span></a>
      <ul class="dropdown-menu mega-dropdown-menu">
        <li>
            <ul>
              <li><a href="#">Ventas</a></li>
              <li><a href="#">Pagos</a></li>
              <li><a href="#">Préstamos</a></li>
              <li><a href="#">Procesos</a></li>
              <li><a href="#">Ahorros</a></li>
          </ul>
        </li>
      </ul>
    </li>
    </ul>
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php  echo $_SESSION['nombreUsuario'] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="../../view/perfil/perfil.php">Mi perfil</a></li>
            <li><a href="#">Actualizar precio de leche</a></li>
            <li><a href="../juntaDirectiva/juntaDirectivaView.php">Junta Directiva</a></li>
            <li><a href="../../data/login/cerrarSesionData.php">Salir</a></li>

          </ul>
        </li>
      </ul>
  </div><!-- /.nav-collapse -->
  </nav>
</div>


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
        
        <li><a href="#">Empleados</a></li>
        <li><a href="#">Distribuidores</a></li>
       
         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Productores<span class="caret"></span></a>        
        <ul class="dropdown-menu mega-dropdown-menu">
          <li>
              <ul>
                <li><a href="#">Productor Cliente</a></li>
                <li><a href="#">Producto Socio</a></li>
              
            </ul>
          </li>
        </ul>       
      </li>
            <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Productos<span class="caret"></span></a>        
        <ul class="dropdown-menu mega-dropdown-menu">
          <li>
              <ul>
                <li><a href="#">Productos Lacteos</a></li>
                <li><a href="#">Productos Veterinarios</a></li>
              
            </ul>
          </li>
        </ul>       
      </li>
    </ul>
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php session_start(); echo $_SESSION['nombreUsuario'] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Mi perfil</a></li>
            <li><a href="#">Salir</a></li>
          </ul>
        </li>
      </ul>
  </div><!-- /.nav-collapse -->
  </nav>
</div>


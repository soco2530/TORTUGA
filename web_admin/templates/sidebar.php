<nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">

          <?php


            $uri = $_SERVER['REQUEST_URI'];
            $uriAr = explode("/", $uri);
            $page = end($uriAr);

          ?>






          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'pedidos_clientes.php') ? 'active' : ''; ?>" href="pedidos_clientes.php">
              <span data-feather="shopping-bag"></span>
              ideas
            </a>
        </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'representantes.php') ? 'active' : ''; ?>" href="representantes.php">
              <span data-feather="users"></span>
              Representantes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'comision.php') ? 'active' : ''; ?>" href="comision.php">
              <span data-feather="users"></span>
              Comisión
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'proyecto.php') ? 'active' : ''; ?>" href="proyecto.php">
              <span data-feather="shopping-cart"></span>
              Proyectos
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'colaboradores.php') ? 'active' : ''; ?>" href="colaboradores.php">
              <span data-feather="users"></span>
              Colaboradores
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'pedidos_clientes.php') ? 'active' : ''; ?>" href="pedidos_clientes.php">
              <span data-feather="shopping-bag"></span>
              Comentarios
            </a>
</li>
        </ul>

    


      </div>
    </nav>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">


      </div>

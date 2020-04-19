<nav class="col-md-2 d-none d-md-block bg-dark sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="pt-2" style="color: #f5f5f5">
        Bienvenido, <?php echo $_SESSION['nombre'] ?>
      </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Facturas</span>
      <a class="d-flex align-items-center text-muted" href="#">
        <span data-feather="plus-circle"></span>
      </a>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="facturas.php">
          <span data-feather="file-text"></span>
          Ver
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="crear-factura.php">
          <span data-feather="file-text"></span>
          Nueva factura
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="modificar-factura.php">
          <span data-feather="file-text"></span>
          Modificar
        </a>
      </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Empresas</span>
      <a class="d-flex align-items-center text-muted" href="#">
        <span data-feather="plus-circle"></span>
      </a>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="empresas.php">
          <span data-feather="file-text"></span>
          Ver
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="agregar-empresa.php">
          <span data-feather="file-text"></span>
          Agregar
        </a>
      </li>
      <?php
        if ($_SESSION['tipo_usuario'] == "admin") {
      ?>
      <li class="nav-item">
        <a class="nav-link" href="modificar-empresa.php">
          <span data-feather="file-text"></span>
          Modificar
        </a>
      </li>
      <?php
      }
      ?>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Clientes</span>
      <a class="d-flex align-items-center text-muted" href="#">
        <span data-feather="plus-circle"></span>
      </a>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="clientes.php">
          <span data-feather="file-text"></span>
          Ver
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="agregar-cliente.php">
          <span data-feather="file-text"></span>
          Agregar
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="modificar-cliente.php">
          <span data-feather="file-text"></span>
          Modificar
        </a>
      </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Servicios</span>
      <a class="d-flex align-items-center text-muted" href="#">
        <span data-feather="plus-circle"></span>
      </a>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="servicios.php">
          <span data-feather="file-text"></span>
          Ver
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="agregar-servicio.php">
          <span data-feather="file-text"></span>
          Agregar
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="modificar-servicio.php">
          <span data-feather="file-text"></span>
          Modificar
        </a>
      </li>
    </ul>

    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Usuarios</span>
      <a class="d-flex align-items-center text-muted" href="#">
        <span data-feather="plus-circle"></span>
      </a>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="usuarios.php">
          <span data-feather="file-text"></span>
          Ver
        </a>
      </li>
      <?php
        if ($_SESSION['tipo_usuario'] == "admin") {
      ?>
        <li class="nav-item">
          <a class="nav-link" href="agregar-usuario.php">
            <span data-feather="file-text"></span>
            Agregar
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="modificar-usuario.php">
            <span data-feather="file-text"></span>
            Modificar
          </a>
        </li>
      </ul>
      <?php
      }
      ?>
    <?php
      if ($_SESSION['tipo_usuario'] == "admin") {
    ?>
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Reportes</span>
      <a class="d-flex align-items-center text-muted" href="#">
        <span data-feather="plus-circle"></span>
      </a>
    </h6>
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="reporte-usuarios.php">
          <span data-feather="file-text"></span>
          Usuarios
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reporte-facturas.php">
          <span data-feather="file-text"></span>
          Facturas
        </a>
      </li>
    </ul>
    <?php
      }
    ?>
  </div>
</nav>

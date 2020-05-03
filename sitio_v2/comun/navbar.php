<nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
  <a href="<?php echo $path_absoluto ?>index.php" class="navbar-brand">
    <img class="d-inline-block align-top" src="<?php echo $path_absoluto ?>img/logo.png" alt="Logo">
    <p>Factura Fácil</p>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item" id="navbar_index">
        <a class="nav-link" href="<?php echo $path_absoluto ?>index.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item" id="navbar_iniciar-sesion">
        <a class="nav-link" href="<?php echo $path_absoluto ?>iniciar-sesion.php">Iniciar Sesión</a>
      </li>
      <li class="nav-item" id="navbar_sobre-nosotros">
        <a class="nav-link" href="<?php echo $path_absoluto ?>sobre-nosotros.php">Sobre Nosotros</a>
      </li>
      <li class="nav-item" id="navbar_contacto">
        <a class="nav-link" href="<?php echo $path_absoluto ?>#">Contacto</a>
      </li>
    </ul>
  <?php
    if (isset($_SESSION['tipo_usuario'])) {
      ?>
        <div class="collapse navbar-collapse justify-content-end">
          <form class="form-inline" name="cierreSesion" action="cerrar-sesion.php" method="post">
            <a href="<?php
              if ($nivel == 1) {
                echo "crear-factura.php";
              } else {
                echo "usuarios/crear-factura.php";
              }?>">
              <button type="button" class="btn btn-outline-light mr-2" name="usuarios">
                Ir al Dashboard
              </button>
            </a>
            <button type="submit" class="btn btn-outline-warning" name="cerrarSesion">
              Cerrar Sesion
            </button>
          </form>
        </div>
      <?php
    }
    ?>
  </div>
</nav>
<!-- Seleccionar página activa -->
<script type="text/javascript">
$(document).ready(function() {
  var ruta = window.location.pathname.split("/");
  var pagina = "";
  for (var i = 0; i < ruta.length; i++) {
    if (ruta[i].includes(".php")) {
      pagina = ruta[i].replace(".php", "");
      break;
    }
  }
  $('#navbar_' + pagina).addClass('active');
});
</script>
<!-- Seleccionar página activa -->

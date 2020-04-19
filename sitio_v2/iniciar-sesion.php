<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <?php
      require 'comun/recursos.php';
      include 'comun/sesion.php';
    ?>
    <link rel="stylesheet" href="css/global.css" action="iniciar_sesion.php">
    <title>Factura Fácil</title>
  </head>
  <body>
    <?php
      require 'comun/navbar.php';
      if (!empty($_POST)) {
        if(iniciarSesion($_POST[email], $_POST[password])) {
          header("Location: usuarios/crear-factura.php");
        } else {
          errorIniciandoSesion($_POST[email]);
        }
      }
      ?>
    <div class="container">
      <div class="row align-items-center justify-content-center pt-4">
        <div class="col-sm-6 align-self-center pt-4">
          <form action="iniciar-sesion.php" method="post" name="sesion">
            <div class="form-group">
              <label for="email">Correo</label>
              <input type="email" name="email" class="form-control" id="email" aria-describedby="emailAyuda" required>
              <small id="emailAyuda" class="form-text text-muted">Dirección de correo electrónico con el que te registraste.</small>
            </div>
            <div class="form-group">
              <label for="passwordInput">Contraseña</label>
              <input type="password" name="password" class="form-control" id="passwordInput" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            <button type="button" class="btn btn-secondary" onclick="irIndex()">Cancelar</button>
          </form>
        </div>
      </div>
    </div>
    <?php require 'comun/footer.php' ?>
  </body>
</html>

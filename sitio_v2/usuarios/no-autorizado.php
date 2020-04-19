<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <?php
      $nivel = 1;
      require "../comun/recursos.php"
    ?>
    <title>Factura Fácil</title>
  </head>
  <body>
    <?php require "../comun/navbar.php" ?>
    <div class="container-fluid">
      <div class="row align-items-center justify-content-center pt-4">
        <div class="col">
          <h1>Acceso no autorizado</h1>
          <p>Usted no está autorizado para entrar a esta página. Si considera que usted debería tener acceso a esta página <a href="../iniciar_sesion.php">inicie sesión</a>.</p>
          <button type="button" class="btn btn-info" onclick="irA('../index.php')">Ir al inicio</button>

        </div>
      </div>
    </div>
    <?php require "../comun/footer.php" ?>
  </body>
</html>

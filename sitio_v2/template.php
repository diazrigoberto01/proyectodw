<?php
  session_start();
  if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != "admin" || $_SESSION['tipo_usuario'] != "auxiliar") {
    header("Location: no-autorizado.php");
    die();
  }
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
      Contenido aquí.
    </div>
    <?php require "../comun/footer.php" ?>
  </body>
</html>

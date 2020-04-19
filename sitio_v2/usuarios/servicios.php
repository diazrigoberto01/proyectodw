<?php
  session_start();
  if (!isset($_SESSION['tipo_usuario'])) {
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
    <title>Servicios - Factura Fácil</title>
  </head>
  <body>
    <?php
      require "../comun/navbar.php";
    ?>
    <div class="container-fluid">
      <div class="row">
        <?php
          include "sidebar.php";
          $link = conectarse();
          $consulta = mysqli_query($link,"SELECT clave, descripcion, unidad_medida, precio, id FROM f_concepto");
          if ($error = mysqli_error($link)) {
            echo 'Error buscando los datos en la Base de Datos: '.$error;
            ?>
            <br>
            <br>
            <?php
            die();
          }
        ?>
        <div class="col">
          <table class="table">
            <thead>
              <tr>
                <th>Clave</th>
                <th>Descripción</th>
                <th>Unidad de medida</th>
                <th>Precio unitario</th>
              </tr>
            </thead>
            <?php
              while ($row = mysqli_fetch_array($consulta)) {
                printf('<tr>
                <td> %s </td>
                <td> %s </td>
                <td> %s </td>
                <td> $%.2f </td>
                <td>
                <a href="modificar-servicio.php?id='.$row[4].'&op=1">
                <input type="button" class="btn btn-outline-secondary" value="Modificar">
                </a>', $row[0], $row[1], $row[2], $row[3]);
                if ($_SESSION['tipo_usuario'] == "admin") {
                  printf('<a href="modificar-servicio.php?id='.$row[4].'&op=2">
                  <input type="button" class="btn btn-outline-danger" value="Eliminar">
                  </a>');
                }
                printf('</td></tr>');
              }
            ?>
          </table>
        </div>
      </div>
    </div>
    <?php require "../comun/footer.php" ?>
  </body>
</html>

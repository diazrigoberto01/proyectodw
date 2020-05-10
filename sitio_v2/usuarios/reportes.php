<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
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
    <title>Factura Fácil</title>
  </head>
  <body>
    <?php
      require "../comun/navbar.php";
    ?>
    <div class="container-fluid">
      <div class="row justify-content-end">
        <?php
          include "sidebar.php";
        ?>
        <div class="col-md-10  align-self-end">
          <h2 style="text-align: center">Seleccionar reporte a generar</h2>
          <form action="reportes.php" method="post" name="forma-reportes">
            <table align="center">
              <tr>
                <td>
                  <input type="radio" name="tipo" value="facturas" checked>Últimas facturas</input>
                </td>
                <td>
                  <input type="radio" name="tipo" value="clientes">Últimos clientes</input>
                </td>
                <td >
                  <input type="radio" name="tipo" value="empresas">Últimas empresas</input>
                </td>
              </tr>
              <tr>
                <td colspan="3" style="text-align: center; padding-top: 10px"><input type="submit" name="submit" value="Generar"></td>
              </tr>
            </table>
          </form>
          <br><br>
          <hr>
          <h2 style="text-align: center">Reportes</h2>
          <hr>
          <table class="table" border="1" align="center">
            <?php
            $link = conectarse();
            if ($error = mysqli_error($link)) {
              echo 'Error conectando a la Base de Datos: '.$error;
              die();
            }
            if ($_POST) {
              $tipo = $_POST['tipo'];
              if ($tipo == "facturas") {
                $consulta = mysqli_query($link, "SELECT sum(importe_total) FROM f_factura ORDER BY id DESC LIMIT 10");
                if ($error = mysqli_error($link)) {
                  echo 'Error buscando los datos en la Base de Datos: '.$error;
                  die();
                }
                $datos = mysqli_fetch_array($consulta);
                ?>
                <tr>
                  <td colspan="6">
                    <h3>El monto facturado en las últimas 10 facturas es de <?php printf('$%.2f',$datos[0]) ?></h3>
                  </td>
                </tr>
                <th>Folio</th>
                <th>Fecha de emisión</th>
                <th>RFC Emisor</th>
                <th>RFC Receptor</th>
                <th>Método de pago</th>
                <th>Importe</th>
                <?php
                $consulta = mysqli_query($link, "SELECT folio, fecha_emision, rfc_emisor, rfc_receptor, metodo_pago, importe_total FROM f_factura ORDER BY id DESC LIMIT 10");
                while ($datos = mysqli_fetch_array($consulta)) {
                  printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>$ %.2f</td></tr>', $datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5]);
                }
              } else if ($tipo == "clientes") {
                $consulta = mysqli_query($link, "SELECT rfc, razon_social, email, telefono, estado, municipio FROM f_cliente ORDER BY id DESC LIMIT 10");
                if ($error = mysqli_error($link)) {
                  echo 'Error buscando los datos en la Base de Datos: '.$error;
                  die();
                }
                ?>
                <th>RFC</th>
                <th>Razón social</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Municipio</th>
                <?php
                while ($datos = mysqli_fetch_array($consulta)) {
                  printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5]);
                }
              } else if ($tipo == "empresas") {
                $consulta = mysqli_query($link, "SELECT rfc, razon_social, nombre_comercial, contacto, email, telefono FROM f_empresas ORDER BY id DESC LIMIT 10");
                if ($error = mysqli_error($link)) {
                  echo 'Error buscando los datos en la Base de Datos: '.$error;
                  die();
                }
                ?>
                <th>RFC</th>
                <th>Razón social</th>
                <th>Nombre comercial</th>
                <th>Persona de contacto</th>
                <th>Email</th>
                <th>Teléfono</th>
                <?php
                while ($datos = mysqli_fetch_array($consulta)) {
                  printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5]);
                }
              }
            } else {
              $consulta_facturas = mysqli_query($link, "SELECT folio, fecha_emision, rfc_emisor, rfc_receptor, metodo_pago, importe_total FROM f_factura ORDER BY id DESC LIMIT 3");
              if ($error = mysqli_error($link)) {
                echo 'Error buscando los datos en la Base de Datos: '.$error;
                die();
              }
              $consulta_clientes = mysqli_query($link, "SELECT rfc, razon_social, email, telefono, estado, municipio FROM f_cliente ORDER BY id DESC LIMIT 3");
              if ($error = mysqli_error($link)) {
                echo 'Error buscando los datos en la Base de Datos: '.$error;
                die();
              }
              $consulta_empresas = mysqli_query($link, "SELECT rfc, razon_social, nombre_comercial, contacto, email, telefono FROM f_empresas ORDER BY id DESC LIMIT 3");
              if ($error = mysqli_error($link)) {
                echo 'Error buscando los datos en la Base de Datos: '.$error;
                die();
              }
              ?>
              <th colspan="6" style="text-align: center">Últimas facturas</th>
              <tr>
                <td>Folio</td>
                <td>Fecha de emisión</td>
                <td>RFC Emisor</td>
                <td>RFC Receptor</td>
                <td>Método de pago</td>
                <td>Importe</td>
              </tr>
              <?php
              while ($datos = mysqli_fetch_array($consulta_facturas)) {
                printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>$ %.2f</td></tr>', $datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5]);
              }
              ?>
              <th colspan="6" style="text-align: center">Últimos clientes</th>
              <tr>
                <td>RFC</td>
                <td>Razón social</td>
                <td>Email</td>
                <td>Teléfono</td>
                <td>Estado</td>
                <td>Municipio</td>
              </tr>
              <?php
              while ($datos = mysqli_fetch_array($consulta_clientes)) {
                printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5]);
              }
              ?>
              <th colspan="6" style="text-align: center">Últimas empresas</th>
              <tr>
                <td>RFC</td>
                <td>Razón social</td>
                <td>Nombre comercial</td>
                <td>Persona de contacto</td>
                <td>Email</td>
                <td>Teléfono</td>
              </tr>
              <?php
              while ($datos = mysqli_fetch_array($consulta_empresas)) {
                printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5]);
              }
            }
            ?>
          </table>
        </div>
      </div>
    </div>
    <?php require "../comun/footer.php" ?>
  </body>
</html>

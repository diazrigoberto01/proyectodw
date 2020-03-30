<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Reportes - Administrador</title>
  </head>
  <body>
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
    <table border="1" align="center">
      <?php
      include '../comun/conexion.php';
      $link = Conectarse();
      if ($error = mysqli_error($link)) {
        echo 'Error conectando a la Base de Datos: '.$error;
        die();
      }
      if ($_POST) {
        $tipo = $_POST['tipo'];
        if ($tipo == "facturas") {
          $consulta = mysqli_query($link, "SELECT folio, fecha_emision, rfc_emisor, rfc_receptor, metodo_pago, importe_total FROM f_factura ORDER BY id ASC LIMIT 10");
          if ($error = mysqli_error($link)) {
            echo 'Error buscando los datos en la Base de Datos: '.$error;
            die();
          }
          ?>
          <th>Folio</th>
          <th>Fecha de emisión</th>
          <th>RFC Emisor</th>
          <th>RFC Receptor</th>
          <th>Método de pago</th>
          <th>Importe</th>
          <?php
          while ($datos = mysqli_fetch_array($consulta)) {
            printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%f</td></tr>', $datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5]);
          }
        } else if ($tipo == "clientes") {
          $consulta = mysqli_query($link, "SELECT rfc, razon_social, email, telefono, estado, municipio FROM f_cliente ORDER BY id ASC LIMIT 10");
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
          $consulta = mysqli_query($link, "SELECT rfc, razon_social, nombre_comercial, contacto, email, telefono FROM f_empresas ORDER BY id ASC LIMIT 10");
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
        $consulta_facturas = mysqli_query($link, "SELECT folio, fecha_emision, rfc_emisor, rfc_receptor, metodo_pago, importe_total FROM f_factura ORDER BY id ASC LIMIT 3");
        if ($error = mysqli_error($link)) {
          echo 'Error buscando los datos en la Base de Datos: '.$error;
          die();
        }
        $consulta_clientes = mysqli_query($link, "SELECT rfc, razon_social, email, telefono, estado, municipio FROM f_cliente ORDER BY id ASC LIMIT 3");
        if ($error = mysqli_error($link)) {
          echo 'Error buscando los datos en la Base de Datos: '.$error;
          die();
        }
        $consulta_empresas = mysqli_query($link, "SELECT rfc, razon_social, nombre_comercial, contacto, email, telefono FROM f_empresas ORDER BY id ASC LIMIT 3");
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
          printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%f</td></tr>', $datos[0], $datos[1], $datos[2], $datos[3], $datos[4], $datos[5]);
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
  </body>
</html>

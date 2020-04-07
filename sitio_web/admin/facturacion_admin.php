<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Facturacion-Admin</title>
    <script>
      function cancelarFactura(folio){
        var cancelar=window.confirm("¿Cancelar Folio: "+folio +"?");
        if (cancelar) {
          alert("Cancelado con Exito");

        } else {
          return 0;
        }
      }
    </script>
  </head>
  <body>
    <h1>Administra tus Facturas</h1>
    <a href="crearfactura.php">
      <img src="../img/agregar.png" alt="Agregar" width="5%" height="5%">
    </a>
    <a href="crearfactura.php">
      <img src="../img/inicio.png" alt="Inicio" width="5%" height="5%">
    </a>
    <br />

    <table align="center">
      <tr>
        <td>
          <input type="text" name="buscar" id="" placeholder="Buscar Factura" />
        </td>
      </tr>
    </table>
    <table align="center">
      <tr>
        <th colspan="6">
          <h3>
            Ultimas Facturas
          </h3>
        </th>
      </tr>
      <tr>
        <th>Fecha</th>
        <th>Folio</th>
        <th>Cliente RFC</th>
        <th>Emisor RFC</th>
        <th>Total</th>
      </tr>
<!-- Aqui comienza la parte dinamica de la tabla-->
      <?php
      include('../comun/conexion.php'); //conectarse.php ;para el servidor propio
      $link=Conectarse();
      $consulta=mysqli_query($link,"Select fecha_emision,folio,rfc_receptor,rfc_emisor,importe_total from f_factura");
      if($error = mysqli_error($link)){
        echo "Error buscando los datos en la base de datos: '$error'";
        ?>
        <br>
        <br>
        <?php
        die();
      }
      while ($row = mysqli_fetch_array($consulta)) {
        printf('<tr>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%d</td>
        <td>
          <input type="button" value="Ver">
          <input type="button" value="Cancelar" onclick="cancelarFactura(%s)">
        </td>
        </tr>',$row[0], $row[1], $row[2], $row[3], $row[4],$row[1]);
      }
      ?>
<!-- Aqui la parte dinamica de la tabla-->
    </table>
  </body>
</html>

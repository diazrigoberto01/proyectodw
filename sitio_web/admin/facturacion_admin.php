<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Facturacion-Admin</title>
    <script>
      function cancelarFactura(folio){
        var cancelar=window.confirm("¿Cancelar Folio: "+ folio +"?");
        if (cancelar) {
          alert("Cancelado con Exito");

        } else {
          return 0;
        }
      }
      function verFactura(folio){
        var cancelar=window.confirm("¿Ver Folio: "+ folio +"?");
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
    <a href="crearfactura.html">Generar Nueva Factura</a>
    <br />

    <form name="busqueda" action="facturacion_admin.php" method="post">
      <table align="center">
        <tr>
          <td>
            <input type="text" name="dato" placeholder="Buscar Factura" />
            <input type="submit" name="enviar" value="Buscar">
          </td>
        </tr>
      </table>
    </form>
    <br><br>
    <table align="center" border="1">
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
      include('../comun/conexion.php');
      $link=Conectarse();
      if ($_POST) {
        $folio = $_POST['dato'];
        echo "<script>console.log('Data: ".$folio."')"; // Debugging
        $consulta = mysqli_query($link,"SELECT fecha_emision,folio,rfc_receptor,rfc_emisor,importe_total FROM f_factura WHERE folio LIKE '$folio%' OR rfc_emisor LIKE '$folio%' OR rfc_emisor LIKE '$folio%'");
      } else {
        $consulta=mysqli_query($link,"SELECT fecha_emision,folio,rfc_receptor,rfc_emisor,importe_total FROM f_factura");
      }
      if($error = mysqli_error($link)){
        echo "Error buscando los datos en la base de datos: '$error'";
        die();
      }
      while ($row = mysqli_fetch_array($consulta)) {
        printf('<tr>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%.2f</td>
        <td>
          <input type="button" value="Ver" onclick="verFactura(%s)">
          <input type="button" value="Cancelar" onclick="cancelarFactura(%s)">
        </td>
        </tr>',$row[0], $row[1], $row[2], $row[3], $row[4],$row[1],$row[1]);
      }
      ?>
<!-- Aqui la parte dinamica de la tabla-->
    </table>
    <a href="crearfactura.html">Inicio</a>
  </body>
</html>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Empresas-Aux</title>
    <script>
        function confirmarEliminar() {
        var contraseña = prompt("Ingresa tu contraseña");
        if (contraseña) {
          var eliminar = window.confirm("Eliminar?");
          if (modificar) {
            alert("Eliminado con exito");
          } else {
            return 0;
          }
        } else {
          alert("Contraseña Equivocada");
          return 0;
        }
      }

    </script>
  </head>
  <body>
    <h1>Administra tus empresas aux</h1>
    <a href="agregarempaux.html" target="principal">
      <img src="../img/agregar.png" alt="Agregar" width="5%" height="5%">
    </a>
    <a href="generar_facturaaux.html">
      <img src="../img/inicio.png" alt="Inicio" width="5%" height="5%">
    </a>

    <br />
    <br />
    <br />

    <table align="center" border="1">
      <tr>
        <th>Logo</th>
        <th>Nombre Empresa</th>
        <th>Contacto</th>
        <th>RFC</th>
        <th>Direccion</th>
      </tr>
      <?php
      include '../comun/conexion.php';
      $link = Conectarse();
      $consulta = mysqli_query($link, "SELECT nombre_comercial, contacto, rfc, telefono FROM f_empresas");
      if ($error = mysqli_error($link)) {
        echo 'Error buscando los datos en la Base de Datos: '.$error;
        ?>
        <br>
        <br>
        <?php
        die();
      }
      // Éxito
      while ($row = mysqli_fetch_array($consulta)) {
        printf('<tr><td>Imagen</td><td> %s </td><td> %s </td><td> %s </td><td> %s </td><td><a href="modificaremp_Admin.html" target="principal">
            <input type="button" value="Modificar">
          </a><input type="button" value="Eliminar" onclick="confirmarEliminar()"></td></tr>', $row[0], $row[1], $row[2], $row[3]);
      }
      ?>
    </table>
  </body>
</html>

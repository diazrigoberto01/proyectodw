<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Facturacion-Admin</title>
    <script>
      function confirmarEliminar() {
        var confirmar = window.confirm(
          "Seguro que desea eliminar este registro?"
        );
        if (confirmar) {
          alert("Eliminado con exito");
        } else {
          return 0;
        }
      }
    </script>
  </head>
  <body>
    <h1>Administra los usuarios</h1>
    <a href="agregar_usuarios.html">Agregar Usuario</a>
    <table align="center" border=1>
      <tr>
        <td colspan="6">
          <center>
            <h3>Usuarios</h3>
          </center>
        </td>
      </tr>
      <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>RFC</th>
        <th>Celular</th>
      </tr>

      <!-- Aqui comienza la parte dinamica de la tabla-->
<?php
      include('../comun/conexion.php'); // ;para el servidor propio
      $link=Conectarse();
      $consulta=mysqli_query($link,"Select concat(nombre,concat(' ',apellidos)),email,rfc,celular from f_usuario");
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
        <td>Imagen</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>
          <input type="button" value="Modificar">
          <input type="button" value="Eliminar" onclick="confirmarEliminar()">
        </td>
        </tr>',$row[0], $row[1], $row[2],$row[3]);
      }

      
      ?>

<!-- Aqui la parte dinamica de la tabla-->
    </table>
    <a href="crearfactura.html">Inicio</a>
  </body>
</html>

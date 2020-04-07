<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Facturacion-Admin</title>
    <script>
      function confirmarEliminar(id) {
        var confirmar = window.confirm(
          "Seguro que desea eliminar este registro"+id+"?"
        );
        if (confirmar) {
          location.href='eliminarUsuario.php?id='+id;
        } else {
          return 0;
        }
      }
    </script>
  </head>
  <body>
    <h1>Administra los usuarios</h1>
    <a href="agregar_usuarios.html">
      <img src="../img/agregar.png" alt="Agregar" width="5%" height="5%">
    </a>
    <a href="crearfactura.php">
      <img src="../img/inicio.png" alt="Inicio" width="5%" height="5%">
    </a>
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
      $consulta=mysqli_query($link,"Select concat(nombre,concat(' ',apellidos)),email,rfc,celular,id from f_usuario");
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
        <a href="modificar_Usuario.php?id='.$row[4].'" target="principal">
        <input type="button" value="Modificar">
      </a>
          <input type="button" value="Eliminar" onclick="confirmarEliminar(%s)">
        </td>
        </tr>',$row[0], $row[1], $row[2],$row[3],$row[4]);
      }
      ?>
<!-- Aqui la parte dinamica de la tabla-->
    </table>
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Empresas-Admin</title>
    <script>
      function confirmarEliminar(){
        var confirmar=window.confirm("Seguro que desea eliminar este registro?");
        if(confirmar){
          alert("Eliminado con exito")
        }else{
          return 0;
        }
      }
    </script>
  </head>
  <body>
    <h1>Administra tus empresas</h1>
    <a href="agregar_empresas.html" target="principal">Agregar</a>
    <a href="crearfactura.html">Inicio</a>

    <br />
    <br />
    <br />

    <table align="center" border="1">
      <tr>
        <th>Logo</th>
        <th>Nombre Empresa</th>
        <th>Contacto</th>
        <th>RFC</th>
        <th>Teléfono</th>
      </tr>
      <?php
      include '../comun/conexion.php';
      $link = Conectarse();
      $consulta = mysqli_query($link, "SELECT nombre_comercial, contacto, rfc, telefono,id FROM f_empresas");
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
        printf('<tr>
        <td>Imagen</td>
        <td> %s </td>
        <td> %s </td>
        <td> %s </td>
        <td> %s </td>
        <td>
        <a href="modificaremp_Admin.php?id='.$row[4].'" target="principal">
            <input type="button" value="Modificar">
          </a>
          <input type="button" value="Eliminar" onclick="confirmarEliminar()"></td></tr>', $row[0], $row[1], $row[2], $row[3]);
      }
      ?>
    </table>
  </body>
</html>
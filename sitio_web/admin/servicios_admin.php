<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Servicios-Admin</title>
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
    <h1>Administra tus Servicios</h1>
    <a href="agregar_servicio.html">
      <img src="../img/agregar.png" alt="Agregar" width="5%" height="5%">
    </a>
    <a href="crearfactura.html">
      <img src="../img/inicio.png" alt="Inicio" width="5%" height="5%">
    </a>

    <table align="center" border=1>
      <tr>
        <td colspan="5">
          <center>
            <h3>
              Servicios
            </h3>
          </center>
        </td>
      </tr>
      <tr>
        <th>Clave Producto/Servicio &nbsp;</th>
        <th>Nombre de Identificacion &nbsp;</th>
        <th>Descripcion &nbsp;</th>
        <th>Total &nbsp;</th>
      </tr>
<!-- Aqui comienza la parte dinamica de la tabla-->
<?php
      include('../comun/conexion.php'); //'conectarse.php' ;para el servidor propio
      $link=Conectarse();
      $consulta=mysqli_query($link,"Select clave,descripcion,unidad_medida,precio from f_concepto");
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
        <td>%.2f</td>
        <td>
          <input type="button" value="Modificar">
          <input type="button" value="Eliminar" onclick="confirmarEliminar()">
        </td>
        </tr>',$row[0], $row[1], $row[2],$row[3]);
      }


      ?>

<!-- Aqui la parte dinamica de la tabla-->
    </table>
  </body>
</html>

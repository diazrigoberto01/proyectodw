<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clientes-Admin</title>
    <script>
      function confirmarEliminar(id){
        var confirmar=window.confirm("¿Seguro que desea eliminar este registro?");
        if(confirmar){
          location.href='eliminarClientes.php?id='+id;
       
        }else{
          return 0;
        }
      }
    </script>
  </head>
  <body>
    <h1>Administra tus Clientes</h1>
<<<<<<< HEAD
    <a href="agregar_clientes.html">
      <img src="../img/agregar.png" alt="Agregar" width="5%" height="5%">
    </a>
    <a href="crearfactura.php">
      <img src="../img/inicio.png" alt="Inicio" width="5%" height="5%">
    </a>
=======
    <a href="agregar_clientes.html">Agregar</a>
    <a href="crearfactura.html">Inicio</a>
>>>>>>> Add files via upload
    <br />
    <br />
    <table align="center" border="1">
      <tr>
        <th>Logo</th>
        <th>Razon Social</th>
        <th>RFC</th>
        <th>Municipio</th>
        <th>Telefono</th>
      </tr>
      <?php
      include '../comun/conexion.php';
      $link = Conectarse();
      $consulta = mysqli_query($link, "SELECT razon_social, rfc, municipio, telefono,id FROM f_cliente");
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
        <a href="modificar_cliente.php?id='.$row[4].'">
        <input type="button" value="Modificar">
        </a>
        <input type="button" value="Eliminar" onclick=confirmarEliminar(%s)>
     
        
        <a href="generar_facturaaux.html"><input type="button" value="Generar Factura"></a></td></tr>', $row[0], $row[1], $row[2], $row[3],$row[4]);
      }
      ?>
    </table>
  </body>
</html>
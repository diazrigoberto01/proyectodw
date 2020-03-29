<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Empresa</title>

    <script>
      function modificar() {
        var modificar=window.confirm("¿Seguro que desea modificar?");
        if (modificar) {
          alert("Modificado con exito");
          history.go(-1);
        } else {
          return 0;
        }
      }
    </script>
  </head>
  <body>
    <?php
    include '../comun/conexion.php';
    $link = Conectarse();
    $id_empresa = $_POST['id'];
    $consulta = mysqli_query($link, "SELECT * FROM f_empresas WHERE id = '$id_empresa'");
    $datos_empresa = mysqli_fetch_array($consulta);
    $rfc_empresa = $datos_empresa['rfc'];
    $consulta_direccion = mysqli_query($link, "SELECT * FROM f_direccion_empresa WHERE empresa_rfc = '$rfc_empresa'");
    $datos_direccion = mysqli_fetch_array($consulta_direccion);
    ?>
    <h1>Modificar Empresa</h1>
    <form action="" method="POST">
      <table>
        <tr>
          <td>Nombre o Razon Social</td>
          <td colspan="2">
            <input
              type="text"
              name="razon_social"
              value="<?php echo $datos_empresa['razon_social']; ?>"
              size="43"
            />
          </td>
          <td></td>
        </tr>
        <tr>
          <td>Nombre Comercial</td>
          <td colspan="2">
            <input
              type="text"
              name="nombre_comercial"
              value="<?php echo $datos_empresa['nombre_comercial']; ?>"
              size="43"
            />
          </td>
        </tr>
        <tr>
          <td>Contacto Nombre Completo</td>
          <td>
            <input
              type="text"
              name="contacto_nombre"
              value="<?php echo $datos_empresa['contacto']; ?>"
            />
          </td>
        </tr>
        <tr>
          <td>Telefono:</td>
          <td colspan="2" >
            <input
              type="text"
              name="telefono"
              value="<?php echo $datos_empresa['telefono']; ?>"
            />
          </td>
        </tr>
        <tr>
          <td>Email:</td>
          <td><input type="text" name="email" value="<?php echo $datos_empresa['email']; ?>" /></td>
        </tr>
        <tr>
          <td>Pais</td>
          <td><input type="text" name="pais" value="<?php echo $datos_direccion['pais']; ?>" /></td>
        </tr>
        <tr>
          <td>Estado</td>
          <td>
            <input type="text" name="estado" value="<?php echo $datos_direccion['estado']; ?>" />
          </td>
        </tr>
        <tr>
          <td>Municipio</td>
          <td>
            <input type="text" name="municipio" value="<?php echo $datos_direccion['municipio']; ?>" />
          </td>
        </tr>
        <tr>
          <td>Localidad</td>
          <td>
            <input type="text" name="localidad" value="<?php echo $datos_direccion['localidad']; ?>" />
          </td>
        </tr>
        <tr>
          <td>Calle</td>
          <td><input type="text" name="calle" value="<?php echo $datos_direccion['calle']; ?>" /></td>
        </tr>
        <tr>
          <td>Nº Exterior</td>
          <td>
            <input type="text" name="n_ext" value="<?php echo $datos_direccion['n_exterior']; ?>" />
          </td>
        </tr>
        <tr>
          <td>Nº Interior</td>
          <td>
            <input type="text" name="n_int" value="<?php echo $datos_direccion['n_interior']; ?>" />
          </td>
        </tr>
        <tr>
          <td>CP</td>
          <td><input type="text" name="cp" value="<?php echo $datos_direccion['cp']; ?>" /></td>
        </tr>
        <tr>
          <td>Imagen:</td>
          <td colspan="2">
            <input type="file" name="imagen" placeholder="Sube aqui el logo" disabled>
          </td>
        </tr>
      <tr>
        <td colspan="2">
          <center>
            <br><br>
            <input type="submit" value="Actualizar" onclick="modificar()"/>
            <input type="button" value="Cancelar" onclick="history.go(-1)">
          </center>
        </td>
      </tr>
    </table>
  </form>
  </body>
</html>

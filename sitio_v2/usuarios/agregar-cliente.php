<?php
  session_start();
  if (!isset($_SESSION['tipo_usuario'])) {
    header("Location: no-autorizado.php");
    die();
  }
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <?php
      $nivel = 1;
      require "../comun/recursos.php"
    ?>
    <title>Factura Fácil</title>
  </head>
  <body>
    <?php
      require "../comun/navbar.php";
    ?>
    <div class="container-fluid">
      <div class="row">
        <?php
          include "sidebar.php";
        ?>
        <div class="col">
          <h1>Agregar Clientes</h1>
          <form name="cliente" action="../comun/add_cliente.php" method="post" onsubmit="return usuarioCreado()">
            <table>
              <tr>
                <td>RFC: (*)</td>
                <td>
                  <input type="text" name="rfcCliente" placeholder="RFC" />
                </td>
              </tr>
              <tr>
                <td>Razon Social: (*)</td>
                <td>
                  <input type="text" name="rSocial" placeholder="Razon Social" />
                </td>
              </tr>
              <tr>
                <td>Email: (*)</td>
                <td><input type="text" name="email" placeholder="Email" /></td>
              </tr>
              <tr>
                <td>Telefono: (*)</td>
                <td><input type="text" name="tel" placeholder="Telefono" /></td>
              </tr>
              <tr>
                <td colspan="2">
                  <center><h3>Direccion</h3></center>
                </td>
              </tr>
              <tr>
                <td>Calle: (*)</td>
                <td><input type="text" name="calle" placeholder="Calle" /></td>
              </tr>
              <tr>
                <td>Nº Exterior: (*)</td>
                <td>
                  <input type="text" name="n_ext" placeholder="Nº Exterior" />
                </td>
              </tr>
              <tr>
                <td>Localidad: (*)</td>
                <td>
                  <input type="text" name="localidad" placeholder="Localidad" />
                </td>
              </tr>
              <tr>
                <td>
                  Municipio: (*)
                </td>
                <td><input type="text" name="municipio" placeholder="Municipio"></td>
              </tr>
              <tr>
                <td>Estado: (*)</td>
                <td><input type="text" name="estado" placeholder="Estado"></td>
              </tr>
              <tr>
                <td>Código Postal: (*)</td>
                <td><input type="text" name="cp" placeholder="55110"></td>
              </tr>
              <tr>
                <td>
                  Imagen: (*)
                </td>
                <td>
                  <input type="file" name="imagen" placeholder="Sube aqui el logo" disabled>
                  <input type="hidden" name="tipo" value="admin">
                </td>
              </tr>

              <tr>
                  <td colspan="2" >
                      <br><br>
                      <center>
                          <input type="submit" value="Agregar">
                          <input type="button" value="Cancelar" onclick="history.go(-1)">
                      </center>
                  </td>
              </tr>
          </table>
        </div>
      </div>
    </div>
    <?php require "../comun/footer.php" ?>
  </body>
</html>

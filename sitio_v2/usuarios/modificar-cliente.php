<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  if (!isset($_SESSION['tipo_usuario'])) {
    header("Location: no-autorizado.php");
    die();
  }
  if ($_GET) {
    $operacion = $_GET["op"];
    $id = $_GET["id"];
  }
  $nivel = 1;
  require "../comun/recursos.php";
  require "../comun/lib-clientes.php";
  if ($operacion == 2) {
    eliminarCliente($id);
    header("Location: clientes.php");
  }
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <title>Factura Fácil</title>
  </head>
  <body>
    <?php
      require "../comun/navbar.php";
    ?>
    <div class="container-fluid">
      <div class="row">
        <?php
          if ($_POST) {
            modificarCliente();
          }
          include "sidebar.php";
          $link = conectarse();
          $consulta = mysqli_query($link, "SELECT * FROM f_cliente where id='$id'");
          if ($error = mysqli_error($link)) {
            echo "Error al conseguir el cliente de ID <samp>$id</samp>.";
            die();
          }
          $row = mysqli_fetch_array($consulta);
        ?>
        <div class="col">
          <div class="row">
            <div class="col align-self-center mb-3 mt-3">
              <h2>Modificar Cliente</h2>
            </div>
          </div>
          <div class="row">
            <div class="col align-self-center">
              <form class="needs-validation" name="cliente" action="modificar-cliente.php" method="post" novalidate>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="rfcCliente">RFC</label>
                    <input type="text" class="form-control" name="rfcCliente" id="rfcCliente" placeholder="RFC" pattern="[A-Z0-9]{10,20}" value="<?php echo $row[1]?>" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="rSocial">Razón Social</label>
                    <input type="text" class="form-control" name="rSocial" id="rSocial" placeholder="Razón Social" pattern="[a-zA-Z ]{3,50}" value="<?php echo $row[2]?>" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="email">Correo</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="nombre@correo.com" pattern="[a-zA-Z0-9]{2,60}@[a-zA-Z0-9]{2,60}\.[a-z]{2,3}.*" value="<?php echo $row[8]?>" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un correo válido.
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="tel">Teléfono</label>
                    <input type="text" class="form-control" name="tel" id="tel" placeholder="555-1234567"  pattern="[0-9]{10}" value="<?php echo $row[9]?>" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un teléfono válido a 10 dígitos. Sólo números.
                    </div>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row mb-3">
                  <h4>Dirección</h4>
                </div>
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <label for="calle">Calle</label>
                    <input type="text" class="form-control" name="calle" id="calle" placeholder="" pattern="[a-zA-Z0-9 ]{3,60}" value="<?php echo $row[3]?>" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="n_ext">Nº Exterior</label>
                    <input type="text" class="form-control" name="n_ext" id="n_ext" placeholder="1" pattern="[0-9]{1,5}" value="<?php echo $row[7]?>" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <label for="municipio">Municipio</label>
                    <input type="text" class="form-control" name="municipio" id="municipio" placeholder="" pattern="[a-zA-Z ]{3,60}" value="<?php echo $row[6]?>" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="estado">Estado</label>
                    <input type="text" class="form-control" name="estado" id="estado" placeholder="" pattern="[a-zA-Z ]{4,60}" value="<?php echo $row[5]?>" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="cp">Código Postal</label>
                    <input type="text" class="form-control" name="cp" id="cp" placeholder="10001" pattern="[0-9]{5}" value="<?php echo $row[4]?>" required>
                  </div>
                  <div class="invalid-feedback">
                    Por favor ingrese un valor válido.
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-8 mb-3">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control" name="logo" id="logo" placeholder="" required disabled>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                      Acepto los Términos y Condiciones
                    </label>
                    <div class="invalid-feedback">
                      Debe aceptar los términos antes de enviar los datos.
                    </div>
                  </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $id ?>" >
                <button class="btn btn-success" type="submit">Modificar</button>
                <button class="btn btn-danger" type="button" onclick="history.go(-1)">Cancelar</button>
                <button type="reset" class="btn btn-warning">Borrar</button>
              </form>
              <script>
              // Example starter JavaScript for disabling form submissions if there are invalid fields
              (function() {
                'use strict';
                window.addEventListener('load', function() {
                  // Fetch all the forms we want to apply custom Bootstrap validation styles to
                  var forms = document.getElementsByClassName('needs-validation');
                  // Loop over them and prevent submission.
                  var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                      if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                      }
                      form.classList.add('was-validated');
                    }, false);
                  });
                }, false);
              })();
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require "../comun/footer.php" ?>
  </body>
</html>

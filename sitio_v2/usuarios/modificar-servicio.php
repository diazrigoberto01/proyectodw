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
  require "../comun/lib-servicios.php";
  if ($operacion == 2) {
    eliminarServicio($id);
    header("Location: servicios.php");
  }
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <title>Modificar servicio - Factura Fácil</title>
  </head>
  <body>
    <?php
      require "../comun/navbar.php";
    ?>
    <div class="container-fluid">
      <div class="row">
        <?php
          if ($_POST) {
            modificarServicio();
          }
          include "sidebar.php";
          $link = conectarse();
          $consulta = mysqli_query($link, "SELECT clave,descripcion,unidad_medida,precio FROM f_concepto where id='$id'");
          if ($error = mysqli_error($link)) {
            echo "Error al conseguir el servicio de ID <samp>$id</samp>.";
            die();
          }
          $row = mysqli_fetch_array($consulta);
        ?>
        <div class="col">
          <div class="row justify-content-end">
            <div class="col mb-3 mt-3 col-md-10 align-self-end">
              <h2>Modificar Servicio</h2>
            </div>
          </div>
          <div class="row">
            <div class="col align-self-center">
              <form class="needs-validation" name="servicio" action="modificar-servicio.php" method="post" novalidate>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-8 mb-3">
                    <label for="clave_producto">Clave del Producto o Servicio</label>
                    <input type="text" class="form-control" name="clave_producto" id="clave_producto" placeholder="SUK-123" pattern="[A-Z0-9 \-]{5,20}" value="<?php echo $row[0] ?>" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-8 mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="20" rows="5" pattern=".+" placeholder="Descripción" required><?php echo $row[1] ?></textarea>
                    <div class="invalid-feedback">
                      Por favor ingrese una descripción.
                    </div>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <label for="um">Unidad de medida</label>
                    <input type="text" class="form-control" name="um" id="um" placeholder="Kg" pattern="[a-zA-Z0-9]{1,10}" value="<?php echo $row[2] ?>" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="pu">Precio Unitario</label>
                    <input type="text" class="form-control" name="pu" id="pu" placeholder="1" pattern="[0-9]+(\.[0-9][0-9])?" value="<?php echo $row[3] ?>" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
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
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <button class="btn btn-success" type="submit">Agregar</button>
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

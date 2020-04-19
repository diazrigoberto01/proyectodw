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
      require "../comun/recursos.php";
      require "../comun/lib-servicios.php";
      if ($_POST) {
        agregarServicio();
      }
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
          <div class="row">
            <div class="col align-self-center mb-3 mt-3">
              <h2>Agregar Servicio</h2>
            </div>
          </div>
          <div class="row">
            <div class="col align-self-center">
              <form class="needs-validation" name="servicio" action="agregar-servicio.php" method="post" novalidate>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-8 mb-3">
                    <label for="clave_producto">Clave del Producto o Servicio</label>
                    <input type="text" class="form-control" name="clave_producto" id="clave_producto" placeholder="SUK-123" pattern="[A-Z0-9 \-]{5,20}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-8 mb-3">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="20" rows="5" pattern=".+" placeholder="Descripción" required></textarea>
                    <div class="invalid-feedback">
                      Por favor ingrese una descripción.
                    </div>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <label for="um">Unidad de medida</label>
                    <input type="text" class="form-control" name="um" id="um" placeholder="Kg" pattern="[a-zA-Z]{1,10}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="pu">Precio Unitario</label>
                    <input type="text" class="form-control" name="pu" id="pu" placeholder="1" pattern="[0-9]+(\.[0-9][0-9])?" required>
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
                  // Loop over them and prevent submission
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

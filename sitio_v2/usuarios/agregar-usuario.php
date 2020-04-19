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
      require "../comun/lib-usuarios.php";
      if ($_POST) {
        agregarUsuario();
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
              <h2>Agregar Usuario</h2>
            </div>
          </div>
          <div class="row">
            <div class="col align-self-center">
              <form class="needs-validation" name="usuario" action="agregar-usuario.php" method="post" novalidate>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="John" pattern="[a-zA-Z]{3,50}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="apellido">Apellidos</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Doe" pattern="[a-zA-Z ]{2,50}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="email">Correo</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="nombre@correo.com" pattern="[a-zA-Z0-9]{2,60}@[a-zA-Z0-9]{2,60}\.[a-z]{2,3}.*" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un correo válido.
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="tel">Teléfono</label>
                    <input type="text" class="form-control" name="tel" id="tel" placeholder="555-1234567"  pattern="[0-9]{10}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un teléfono válido a 10 dígitos. Sólo números.
                    </div>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="rfc">RFC</label>
                    <input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC" pattern="[A-Z0-9]{10,20}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="cold-md-46 mb-3">
                    <label for="tipo_usuario">Tipo de usuario</label>
                    <select name="tipo_usuario" id="usuario" pattern="[a-z]+">
                        <option value="0">Elegir</option>
                        <option value="admin">Administrador</option>
                        <option value="auxiliar">Auxiliar</option>
                    </select>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="" pattern=".{6,30}" required>
                    <div class="invalid-feedback">
                      La contraseña debe tener entre 6 y 30 caracteres.
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="password1">Confirmar contraseña</label>
                    <input type="password1" class="form-control" name="password1" id="password1" placeholder="" pattern=".{6,30}" required>
                    <div class="invalid-feedback">
                      Las contraseñas no coinciden.
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
                      if (document.getElementById("password").value != document.getElementById("password1").value) {
                        document.getElementById("password1").setCustomValidity("Las contraseñas no coinciden.");
                        event.preventDefault();
                        event.stopPropagation();
                      } else if (form.checkValidity() === false) {
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

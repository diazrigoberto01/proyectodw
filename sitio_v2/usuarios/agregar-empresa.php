<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
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
      require "../comun/lib-empresas.php";
      if ($_POST) {
        agregarEmpresa();
      }
    ?>
    <title>Factura Fácil</title>
  </head>
  <body>
    <?php
      require "../comun/navbar.php";
    ?>
    <div class="container-fluid">
      <div class="row justify-content-end">
        <?php
          include "sidebar.php";
        ?>
        <div class="col-md-10  align-self-end">
          <div class="row">
            <div class="col align-self-center mb-3 mt-3">
              <h2>Agregar Empresa</h2>
            </div>
          </div>
          <div class="row">
            <div class="col align-self-center">
              <form class="needs-validation" name="empresa" action="agregar-empresa.php" method="post" enctype="multipart/form-data" novalidate>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <label for="rfc">RFC</label>
                    <input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC" pattern="[A-Z0-9]{10,20}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="rSocial">Nombre o Razón Social</label>
                    <input type="text" class="form-control" name="rSocial" id="rSocial" placeholder="Razón Social" pattern="[a-zA-Z ]{3,50}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="nombre_comercial">Nombre comercial</label>
                    <input type="text" class="form-control" name="nombre_comercial" id="nombre_comercial" placeholder="Comercio S.A." pattern="[a-zA-Z0-9 ]{10,20}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row mb-3">
                  <h4>Datos de contacto</h4>
                </div>
                <div class="form-row">
                  <div class="col-md-3 mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="John" pattern="[a-zA-Z]{3,50}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="apellido">Apellidos</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Doe" pattern="[a-zA-Z ]{2,50}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="email">Correo</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="nombre@correo.com" pattern="[a-zA-Z0-9]{2,60}@[a-zA-Z0-9]{2,60}\.[a-z]{2,3}.*" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un correo válido.
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" id="tel" placeholder="555-1234567"  pattern="[0-9]{10}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un teléfono válido a 10 dígitos. Sólo números.
                    </div>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row mb-3">
                  <h4>Información SAT</h4>
                </div>
                <div class="form-row">
                  <div class="col-md-4 mb-3">
                    <label for="regimen">Regimen Fiscal</label>
                    <select name="regimen" pattern="[a-zA-Z]+">
                      <option value="0">Elegir</option>
                      <option value="Asalariados">Asalariados </option>
                      <option value="Honorarios">
                         Honorarios (servicios profesionales).
                      </option>
                      <option value="Arrendamiento de inmuebles">
                        Arrendamiento de inmuebles.
                      </option>
                      <option value="Actividades Empresariales">
                        Actividades empresariales.
                      </option>
                      <option value="RIF">
                        Incorporación fiscal.
                      </option>
                    </select>
                    <div class="invalid-feedback">
                      Por favor elija una opción válida.
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
                    <input type="text" class="form-control" name="calle" id="calle" placeholder="" pattern="[a-zA-Z0-9 ]{3,60}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="n_ext">Nº Exterior</label>
                    <input type="text" class="form-control" name="n_ext" id="n_ext" placeholder="1" pattern="[0-9]{1,5}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-4 mb-3">
                    <label for="localidad">Localidad/Colonia</label>
                    <input type="text" class="form-control" name="localidad" id="localidad" placeholder="Reforma" pattern="[a-zA-Z ]{3,60}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                </div>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-3 mb-3">
                    <label for="municipio">Municipio</label>
                    <input type="text" class="form-control" name="municipio" id="municipio" placeholder="" pattern="[a-zA-Z ]{3,60}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="estado">Estado</label>
                    <input type="text" class="form-control" name="estado" id="estado" placeholder="" pattern="[a-zA-Z ]{4,60}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="cp">Código Postal</label>
                    <input type="text" class="form-control" name="cp" id="cp" placeholder="10001" pattern="[0-9]{5}" required>
                    <div class="invalid-feedback">
                      Por favor ingrese un valor válido.
                    </div>
                  </div>
                <div class="col-md-3 mb-3">
                  <label for="pais">País</label>
                  <input type="text" class="form-control" name="pais" id="pais" value="México" readonly>
                  <div class="invalid-feedback">
                    Por favor ingrese un valor válido.
                  </div>
                </div>
              </div>
                <!-- Fila -->
                <div class="form-row">
                  <div class="col-md-8 mb-3">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control" name="logo" id="logo">
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

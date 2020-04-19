<?php
  session_start();

  function agregarEmpresa() {
    # Datos
    $rfc = $_POST['rfc'];
    $razon = $_POST['rSocial'];
    $nombre_comercial = $_POST['nombre_comercial'];
    $contacto = $_POST['nombre'].' '.$_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $regimen=$_POST['regimen'];
    $pais = $_POST['pais'];
    $estado = $_POST['estado'];
    $municipio = $_POST['municipio'];
    $localidad = $_POST['localidad'];
    $colonia=$_POST['colonia'];
    $calle = $_POST['calle'];
    $numero_exterior = $_POST['n_ext'];
    $cp = $_POST['cp'];
    $rfc_user=$_POST['rfc_usuario'];
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Insert
    $resultado = mysqli_query($link, "INSERT INTO f_empresas(rfc, razon_social, nombre_comercial, contacto, telefono, email,celular,status,usuario_rfc,regimen_fiscal) VALUES('$rfc', '$razon', '$nombre_comercial', '$contacto', '$telefono', '$email','$telefono','$status','$rfc_user','$regimen')");
    # Error
    if ($error = mysqli_error($link)) {
      errorAgregarEmpresa($rfc);
      return false;
    }
    # Éxito
    exitoAgregarEmpresa($rfc);
  }

    function errorAgregarEmpresa($rfc) {
      ?>
      <script type="text/javascript" src="../comun/global.js"></script>
      <div class="modal fade" id="errorAgregarEmpresaModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorAgregarEmpresaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Error creando la empresa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Ocurrió un error al tratar de crear la empresa con RFC  <samp><?php echo $rfc ?></samp>.</p>
              <p>Por favor verifique que todos los datos estén correctos y vuelva a intentarlo.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="irA('empresas.php')">Continuar</button>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function() {
          $("#errorAgregarEmpresaModal").modal('show');
        })
      </script>
      <?php
    }

    function exitoAgregarEmpresa($rfc) {
      ?>
      <script type="text/javascript" src="../comun/global.js"></script>
      <div class="modal fade" id="exitoAgregarEmpresaModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoAgregarEmpresaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Empresa creada con éxito</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>La empresa con RFC  <samp><?php echo $rfc ?></samp> ha sido agregada y está lista para usarse.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('empresas.php')">Continuar</button>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function() {
          $("#exitoAgregarEmpresaModal").modal('show');
        })
      </script>
      <?php
    }
  ?>

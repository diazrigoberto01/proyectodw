<?php
  session_start();

  function agregarCliente() {
    # Datos
    $rfc = $_POST['rfcCliente'];
    $razon = $_POST['rSocial'];
    $email = $_POST['email'];
    $telefono = $_POST['tel'];
    $calle = $_POST['calle'];
    $numero_exterior = $_POST['n_ext'];
    $localidad = $_POST['localidad'];
    $municipio = $_POST['municipio'];
    $cp = $_POST['cp'];
    $estado = $_POST['estado'];
    $user_rfc = $_POST['usuario_rfc'];
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Insert
    $resultado = mysqli_query($link, "INSERT INTO f_cliente(rfc, razon_social, email, telefono, calle, no_exterior, municipio, cp, estado,usuario_rfc) VALUES('$rfc', '$razon', '$email', '$telefono', '$calle', '$numero_exterior', '$municipio', '$cp', '$estado','$user_rfc')");
    # Error
    if ($error = mysqli_error($link)) {
      errorAgregarCliente($rfc);
      return false;
    }
    # Éxito
    exitoAgregarCliente($rfc);
  }

  function errorAgregarCliente($rfc) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorAgregarClienteModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorAgregarClienteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Error creando el cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ocurrió un error al tratar de crear el cliente con RFC  <samp><?php echo $rfc ?></samp>.</p>
            <p>Por favor verifique que todos los datos estén correctos y vuelva a intentarlo.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="irA('clientes.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#errorAgregarClienteModal").modal('show');
      })
    </script>
    <?php
  }

  function exitoAgregarCliente($rfc) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="exitoAgregarClienteModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoAgregarClienteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cliente creado con éxito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>El cliente con RFC  <samp><?php echo $rfc ?></samp> ha sido agregado y está listo para usarse.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('clientes.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#exitoAgregarClienteModal").modal('show');
      })
    </script>
    <?php
  }

?>

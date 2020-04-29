<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

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
    $status="1";
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Insert
    $resultado = mysqli_query($link, "INSERT INTO f_cliente(rfc, razon_social, email, telefono, calle, no_exterior, municipio, cp, estado,usuario_rfc,status) VALUES('$rfc', '$razon', '$email', '$telefono', '$calle', '$numero_exterior', '$municipio', '$cp', '$estado','$user_rfc','$status')");
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

  function eliminarCliente($id) {
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Delete
    $consulta = mysqli_query($link, "SELECT rfc FROM f_cliente WHERE id=$id");
    $row = mysqli_fetch_array($consulta);
    $rfc = $row["rfc"];
    //cambiar por udpate
    $resultado = mysqli_query($link, "UPDATE  f_cliente set status='0' WHERE id=$id");
    # Error
    if ($error = mysqli_error($link)) {
      errorEliminarCliente($rfc);
      return false;
    }
    # Éxito
    exitoEliminarCliente($rfc);
  }

  function errorEliminarCliente($rfc) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorEliminarClienteModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorEliminarClienteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Error eliminando el cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ocurrió un error al tratar de eliminar el cliente con RFC  <samp><?php echo $rfc ?></samp>.</p>
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
        $("#errorEliminarClienteModal").modal('show');
      })
    </script>
    <?php
  }

  function exitoEliminarCliente($rfc) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="exitoEliminarClienteModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoEliminarClienteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cliente eliminado con éxito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>El cliente con RFC  <samp><?php echo $rfc ?></samp> ha sido eliminado.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('clientes.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#exitoEliminarClienteModal").modal('show');
      })
    </script>
    <?php
  }

  function modificarCliente() {
    # Datos
    $id = $_POST['id'];
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
    $resultado = mysqli_query($link, "UPDATE f_cliente SET rfc='$rfc', razon_social='$razon', email='$email', telefono='$telefono', calle='$calle', municipio='$municipio', cp='$cp', estado='$estado' where id='$id'");
    # Error
    if ($error = mysqli_error($link)) {
      errorModificarCliente($rfc);
      return false;
    }
    # Éxito
    exitoModificarCliente($rfc);
  }

  function errorModificarCliente($rfc) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorModificarClienteModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorModificarClienteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Error modificando el cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ocurrió un error al tratar de modificar el cliente con RFC  <samp><?php echo $rfc ?></samp>.</p>
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
        $("#errorModificarClienteModal").modal('show');
      })
    </script>
    <?php
  }

  function exitoModificarCliente($rfc) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="exitoModificarClienteModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoModificarClienteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Cliente modificado con éxito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>El cliente con RFC  <samp><?php echo $rfc ?></samp> ha sido modificado y está listo para usarse.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('clientes.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#exitoModificarClienteModal").modal('show');
      })
    </script>
    <?php
  }
?>

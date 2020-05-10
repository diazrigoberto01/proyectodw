<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  /* FALTA AGREGAR FACTURA */

  function eliminarFactura($id) {
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Delete
    $consulta = mysqli_query($link, "SELECT folio FROM f_factura WHERE folio=$id");
    $row = mysqli_fetch_array($consulta);
    $folio = $row["folio"];
    //cambiar por update status
    $resultado = mysqli_query($link, "UPDATE f_factura SET status='0' WHERE folio=$id");
    # Error
    if ($error = mysqli_error($link)) {
      errorEliminarFactura($folio, $error);
      return false;
    }
    # Éxito
    exitoEliminarFactura($folio);
  }

  function errorEliminarFactura($folio, $error) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorEliminarFacturaModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorEliminarFacturaModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Error eliminando la factura</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ocurrió un error al tratar de eliminar la factura con folio  <samp><?php echo $folio ?></samp>.</p>
            <p>Por favor verifique que todos los datos estén correctos y vuelva a intentarlo.</p>
            <?php echo $error ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="irA('facturas.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#errorEliminarFacturaModal").modal('show');
      })
    </script>
    <?php
  }

  function exitoEliminarFactura($folio) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="exitoEliminarFacturaModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoEliminarFacturaModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Factura cancelada con éxito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>La factura con folio  <samp><?php echo $folio ?></samp> ha sido cancelada.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('facturas.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#exitoEliminarFacturaModal").modal('show');
      })
    </script>
    <?php
  }

  function modificarFactura() {
    # Datos
    $rfc = $_POST['rfcFactura'];
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
      errorModificarFactura($rfc);
      return false;
    }
    # Éxito
    exitoModificarFactura($rfc);
  }

  function errorModificarFactura($rfc) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorModificarFacturaModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorModificarFacturaModalLabel" aria-hidden="true">
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
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="irA('facturas.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#errorModificarFacturaModal").modal('show');
      })
    </script>
    <?php
  }

  function exitoModificarFactura($rfc) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="exitoModificarFacturaModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoModificarFacturaModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Factura modificado con éxito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>El cliente con RFC  <samp><?php echo $rfc ?></samp> ha sido modificado y está listo para usarse.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('facturas.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#exitoModificarFacturaModal").modal('show');
      })
    </script>
    <?php
  }
  ?>

<?php
  session_start();

  function agregarServicio() {
    # Datos
    $clave=$_POST['clave_producto'];
    $descripcion=$_POST['descripcion'];
    $um=$_POST['um'];
    $pu=$_POST['pu'];
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Insert
    $resultado = mysqli_query($link, "INSERT INTO f_concepto(clave,descripcion,unidad_medida,precio)
     VALUES('$clave', '$descripcion', '$um', '$pu')");
    # Error
    if ($error = mysqli_error($link)) {
      errorAgregarServicio($clave);
      return false;
    }
    # Éxito
    exitoAgregarServicio($clave);
  }

  function errorAgregarServicio($clave) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorAgregarServicioModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorAgregarServicioModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Error creando el servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ocurrió un error al tratar de crear el servicio con clave <samp><?php echo $clave ?></samp>.</p>
            <p>Por favor verifique que todos los datos estén correctos y vuelva a intentarlo.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="irA('servicios.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#errorAgregarServicioModal").modal('show');
      })
    </script>
    <?php
  }

  function exitoAgregarServicio($clave) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="exitoAgregarServicioModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoAgregarServicioModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Servicio creado con éxito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>El servicio con clave <samp><?php echo $clave ?></samp> ha sido agregado y está listo para usarse.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('servicios.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#exitoAgregarServicioModal").modal('show');
      })
    </script>
    <?php
  }
?>

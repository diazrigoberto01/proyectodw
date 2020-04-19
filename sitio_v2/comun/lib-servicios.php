<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

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

  function eliminarServicio($id) {
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Delete
    $consulta = mysqli_query($link, "SELECT clave FROM f_concepto WHERE id=$id");
    $row = mysqli_fetch_array($consulta);
    $clave = $row["clave"];
    $resultado = mysqli_query($link, "DELETE FROM f_concepto WHERE id=$id");
    # Error
    if ($error = mysqli_error($link)) {
      errorAgregarServicio($clave);
      return false;
    }
    # Éxito
    exitoAgregarServicio($clave);
  }

  function errorEliminarrServicio($clave) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorEliminarrServicioModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorEliminarrServicioModalLabel" aria-hidden="true">
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
        $("#errorEliminarrServicioModal").modal('show');
      })
    </script>
    <?php
  }

  function exitoEliminarrServicio($clave) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="exitoEliminarrServicioModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoEliminarrServicioModalLabel" aria-hidden="true">
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
        $("#exitoEliminarrServicioModal").modal('show');
      })
    </script>
    <?php
  }

  function modificarServicio() {
    # Datos
    $clave=$_POST['clave_producto'];
    $descripcion=$_POST['descripcion'];
    $um=$_POST['um'];
    $pu=$_POST['pu'];
    $id=$_POST['id'];
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Insert
    $resultado = mysqli_query($link, "UPDATE f_concepto SET clave='$clave',descripcion='$descripcion',unidad_medida='$um',precio='$pu' where id='$id'");;
    # Error
    if ($error = mysqli_error($link)) {
      errorModificarServicio($clave);
      return false;
    }
    # Éxito
    exitoModificarServicio($clave);
  }

  function errorModificarServicio($clave) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorModificarServicioModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorModificarServicioModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Error modificando el servicio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ocurrió un error al tratar de modificar el servicio con clave <samp><?php echo $clave ?></samp>.</p>
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
        $("#errorModificarServicioModal").modal('show');
      })
    </script>
    <?php
  }

  function exitoModificarServicio($clave) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="exitoModificarServicioModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoModificarServicioModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Servicio modificado con éxito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>El servicio con clave <samp><?php echo $clave ?></samp> ha sido modificado y está listo para usarse.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('servicios.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#exitoModificarServicioModal").modal('show');
      })
    </script>
    <?php
  }
?>

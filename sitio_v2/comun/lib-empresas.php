<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

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
    if ($logo = subirImagen()) {
      return false;
    }
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Insert
    $resultado = mysqli_query($link, "INSERT INTO f_empresas(rfc, razon_social, nombre_comercial, contacto, telefono, email,celular,status,usuario_rfc,regimen_fiscal, logo) VALUES('$rfc', '$razon', '$nombre_comercial', '$contacto', '$telefono', '$email','$telefono','$status','$rfc_user','$regimen','$logo')");
    $resultado1=mysqli_query($link,"INSERT INTO f_direccion_empresa(calle,localidad,colonia,municipio,estado,pais,n_exterior,cp,empresa_rfc,empresa_usuario_rfc)
  values ('$calle','$localidad','$colonia','$municipio','$estado','$pais','$numero_exterior','$cp','$rfc','$rfc_user')");
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

    function eliminarEmpresa($id) {
      # Conexión a la DB
      $link = conectarse();
      echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
      # DB Delete
      $consulta = mysqli_query($link, "SELECT rfc FROM f_empresas WHERE id=$id");
      $row = mysqli_fetch_array($consulta);
      $rfc = $row["rfc"];
      $resultado = mysqli_query($link, "DELETE FROM f_empresas WHERE id=$id");
      # Error
      if ($error = mysqli_error($link)) {
        errorEliminarEmpresa($rfc);
        return false;
      }
      # Éxito
      exitoEliminarEmpresa($rfc);
    }

    function errorEliminarEmpresa($rfc) {
      ?>
      <script type="text/javascript" src="../comun/global.js"></script>
      <div class="modal fade" id="errorEliminarEmpresaModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorEliminarEmpresaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Error eliminando la empresa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Ocurrió un error al tratar de eliminar la empresa con RFC  <samp><?php echo $rfc ?></samp>.</p>
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
          $("#errorEliminarEmpresaModal").modal('show');
        })
      </script>
      <?php
    }

    function exitoEliminarEmpresa($rfc) {
      ?>
      <script type="text/javascript" src="../comun/global.js"></script>
      <div class="modal fade" id="exitoEliminarEmpresaModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoEliminarEmpresaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Empresa eliminada con éxito</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>La empresa con RFC  <samp><?php echo $rfc ?></samp> ha sido eliminada.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('empresas.php')">Continuar</button>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function() {
          $("#exitoEliminarEmpresaModal").modal('show');
        })
      </script>
      <?php
    }

    function modificarEmpresa() {
      # Datos
      $id= $_POST['id'];
      $rfc = $_POST['rfc'];
      $nombre_comercial = $_POST['nombre_comercial'];
      $contacto = $_POST['nombre'];
      $telefono = $_POST['telefono'];
      $email = $_POST['email'];
      $regimen=$_POST['regimen'];
      $pais = $_POST['pais'];
      $estado = $_POST['estado'];
      $municipio = $_POST['municipio'];
      $localidad = $_POST['localidad'];
      $calle = $_POST['calle'];
      $numero_exterior = $_POST['n_ext'];
      $cp = $_POST['cp'];
      $rfc_user=$_POST['rfc_usuario'];
      if ($logo = subirImagen()) {
        return false;
      }
      # Conexión a la DB
      $link = conectarse();
      echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
      # DB Update
      $resultado = mysqli_query($link, "UPDATE f_empresas SET nombre_comercial='$nombre_comercial', contacto='$contacto', rfc='$rfc', telefono='$telefono', email='$email', logo='$logo' WHERE id='$id'");
      # Error
      if ($error = mysqli_error($link)) {
        errorModificarEmpresa($rfc, $error);
        return false;
      }
      $resultado_direccion = mysqli_query($link, "UPDATE f_direccion_empresa set empresa_rfc='$rfc',calle='$calle',colonia='$localidad',municipio='$municipio',estado='$estado',pais='$pais',n_exterior='$n_ext',cp=$cp,localidad='$localidad'  WHERE empresa_rfc='$row[2]'");
      # Error
      if ($error = mysqli_error($link)) {
        errorModificarEmpresa($rfc, $error);
        return false;
      }
      # Éxito
      exitoModificarEmpresa($rfc);
    }

    function errorModificarEmpresa($rfc, $error) {
      ?>
      <script type="text/javascript" src="../comun/global.js"></script>
      <div class="modal fade" id="errorModificarEmpresaModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorModificarEmpresaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Error modificando la empresa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Ocurrió un error al tratar de modificar la empresa con RFC  <samp><?php echo $rfc ?></samp>.</p>
              <p>Por favor verifique que todos los datos estén correctos y vuelva a intentarlo.</p>
              <p><?php echo $error ?></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="irA('empresas.php')">Continuar</button>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function() {
          $("#errorModificarEmpresaModal").modal('show');
        })
      </script>
      <?php
    }

    function exitoModificarEmpresa($rfc) {
      ?>
      <script type="text/javascript" src="../comun/global.js"></script>
      <div class="modal fade" id="exitoModificarEmpresaModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoModificarEmpresaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Empresa modificada con éxito</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>La empresa con RFC  <samp><?php echo $rfc ?></samp> ha sido modificada y está listo para usarse.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('empresas.php')">Continuar</button>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function() {
          $("#exitoModificarEmpresaModal").modal('show');
        })
      </script>
      <?php
    }

  function subirImagen() {
    $dir_objetivo = "../img/uploads/";
    $nombre_temporal = $_FILES["logo"]["tmp_name"];
    $archivo_objetivo = $dir_objetivo . basename($_FILES["logo"]["name"]);
    move_uploaded_file($nombre_temporal, $archivo_objetivo);
    if ($error == UPLOAD_ERR_OK) {
        return $archivo_objetivo;
    } else {
      $error = $_FILES['logo']['error'];
      echo "<script>console.log('Hubo un error al subir el archivo: $error.')</script>";
    }
  }

  function errorExtensionImagen() {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorExtensionImagenModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorExtensionImagenModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Extensión de imagen no válido.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>La extensión de la imagen que se trató de subir no es válida. Los formatos válidos son: <code>.jpg, .jpeg, .png, .gif</code>.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="irA('empresas.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#errorExtensionImagenModal").modal('show');
      })
    </script>
    <?php
  }

  function errorSubirImagen($imagen) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorSubirImagenModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorSubirImagenModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Error subiendo la imagen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ocurrió un error al tratar de subir la imagen <samp><?php echo $imagen ?></samp>.</p>
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
        $("#errorSubirImagenModal").modal('show');
      })
    </script>
    <?php
  }
?>

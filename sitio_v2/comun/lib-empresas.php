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
    $status="1";
    $ruta_logo = subirArchivo();
    if ($ruta_logo == 'falla') {
      errorSubirArchivo();
      return false;
    }
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Insert
    $resultado = mysqli_query($link, "INSERT INTO f_empresas(rfc, razon_social, nombre_comercial, contacto, telefono, email,celular,status,usuario_rfc,regimen_fiscal,logo) VALUES('$rfc', '$razon', '$nombre_comercial', '$contacto', '$telefono', '$email','$telefono','$status','$rfc_user','$regimen', $ruta_logo)");
    //obtener id de la ultima empresa añadida
    $obtenerid=mysqli_query($link,"SELECT id FROM f_empresas where rfc='$rfc'");
    $row=mysqli_fetch_array($obtenerid);
    $idE=$row[0];


    $resultado1=mysqli_query($link,"INSERT INTO f_direccion_empresa(calle,localidad,colonia,municipio,estado,pais,n_exterior,cp,empresa_rfc,empresa_usuario_rfc,f_empresas_id)
  values ('$calle','$localidad','$colonia','$municipio','$estado','$pais','$numero_exterior','$cp','$rfc','$rfc_user','$idE')");
    //falta agregar logo de empresa
    //$agregarLogo=mysqli_query($link,"INSERT INTO f_logo(nombre,imagen,fecha,empresa_rfc,f_empresas_id) values('$nombreLogo','$ubiImagen','$fecha','$rfc','$idE')")

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
              <p>La empresa con RFC  <samp><?php  echo $rfc; ?></samp> ha sido agregada y está lista para usarse.</p>
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
      //cambiar por update status
      $resultado = mysqli_query($link, "UPDATE  f_empresas set status='0' WHERE id=$id");
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
      $ruta_logo = subirArchivo();
      if ($ruta_logo == 'falla') {
        errorSubirArchivo();
        return false;
      }
      # Conexión a la DB
      $link = conectarse();
      echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
      # DB Update
      $resultado = mysqli_query($link, "UPDATE f_empresas SET nombre_comercial='$nombre_comercial', contacto='$contacto', rfc='$rfc', telefono='$telefono', email='$email', logo='$ruta_logo' where id='$id'");
      # Error
      if ($error = mysqli_error($link)) {
        errorModificarEmpresa($rfc, $error);
        return false;
      }
      $resultado_direccion = mysqli_query($link, "UPDATE f_direccion_empresa set empresa_rfc='$rfc',calle='$calle',colonia='$localidad',municipio='$municipio',estado='$estado',pais='$pais',n_exterior='$numero_exterior',cp=$cp,localidad='$localidad'  where empresa_rfc='$rfc'");
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

    function subirArchivo() {
      $directorio = "../img/uploads/";
      $archivo_destino = $directorio . basename($_FILES["logo"]["name"]);
      $extension_archivo = strtolower(pathinfo($archivo_destino,PATHINFO_EXTENSION));
      $revision = getimagesize($_FILES["logo"]["tmp_name"]);
      if ($revision !== false) {
        echo "<script>console.log('El archivo es una imagen.')</script>";
      } else {
        echo "<script>console.log('El archivo no es una imagen.')</script>";
        return 'falla';
      }
      if (move_uploaded_file($_FILES["logo"]["tmp_name"], $archivo_destino)) {
        echo "<script>console.log('El archivo se subió.')</script>";
        return $archivo_destino;
      } else {
        $error = $_FILES["logo"]["error"];
        echo "<script>console.log('Hubo un error subiendo el archivo. $error')</script>";
        return 'falla';
      }
    }

    function errorSubirArchivo() {
      ?>
      <script type="text/javascript" src="../comun/global.js"></script>
      <div class="modal fade" id="errorSubirArchivoModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorSubirArchivoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Error subiendo el logo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Ocurrió un error al tratar de subir el logo</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="irA('empresas.php')">Continuar</button>
            </div>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $(document).ready(function() {
          $("#errorSubirArchivoModal").modal('show');
        })
      </script>
      <?php
    }
  ?>

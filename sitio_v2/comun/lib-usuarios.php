<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  function agregarUsuario() {
    # Datos
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellido'];
    $email=$_POST['email'];
    $rfc=$_POST['rfc'];
    $celular=$_POST['tel'];
    $tipo=$_POST['tipo_usuario'];
    $contra=$_POST['password'];
    $cContra=$_POST['password1'];
    if(!$contra==$cContra){
      printf('<script>
      alert("No coinciden las contraseñas favor de verificar");
      </script>');
    }
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Insert
    $resultado = mysqli_query($link, "INSERT INTO f_usuario(rfc, nombre, apellidos, email, pass, celular, tel_fijo, tipo)
    VALUES ('$rfc', '$nombre', '$apellidos', '$email', '$contra', '$celular', '', '$tipo')");
    # Error
    if ($error = mysqli_error($link)) {
      errorAgregarUsuario($rfc);
      return false;
    }
    # Éxito
    exitoAgregarUsuario($rfc);
  }

  function errorAgregarUsuario($rfc) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorAgregarUsuarioModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorAgregarUsuarioModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Error creando el usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ocurrió un error al tratar de crear el usuario con RFC  <samp><?php echo $rfc ?></samp>.</p>
            <p>Por favor verifique que todos los datos estén correctos y vuelva a intentarlo.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="irA('usuarios.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#errorAgregarUsuarioModal").modal('show');
      })
    </script>
    <?php
  }

  function exitoAgregarUsuario($rfc) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="exitoAgregarUsuarioModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoAgregarUsuarioModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Usuario creado con éxito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>El usuario con RFC  <samp><?php echo $rfc ?></samp> ha sido agregado y está listo para usarse.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('usuarios.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#exitoAgregarUsuarioModal").modal('show');
      })
    </script>
    <?php
  }

  function eliminarUsuario($id) {
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Delete
    $consulta = mysqli_query($link, "SELECT email FROM f_usuario WHERE id=$id");
    $row = mysqli_fetch_array($consulta);
    $rfc = $row["email"];
    $resultado = mysqli_query($link, "DELETE FROM f_usuario WHERE id=$id");
    # Error
    if ($error = mysqli_error($link)) {
      errorEliminarUsuario($email);
      return false;
    }
    # Éxito
    exitoEliminarUsuario($email);
  }

  function errorEliminarUsuario($email) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorEliminarUsuarioModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorEliminarUsuarioModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Error eliminando el usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ocurrió un error al tratar de eliminar el usuario con correo  <samp><?php echo $email ?></samp>.</p>
            <p>Por favor verifique que todos los datos estén correctos y vuelva a intentarlo.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="irA('usuarios.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#errorEliminarUsuarioModal").modal('show');
      })
    </script>
    <?php
  }

  function exitoEliminarUsuario($email) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="exitoEliminarUsuarioModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoEliminarUsuarioModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Usuario eliminado con éxito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>El usuario con correo  <samp><?php echo $email ?></samp> ha sido eliminado.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('usuarios.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#exitoEliminarUsuarioModal").modal('show');
      })
    </script>
    <?php
  }

  function modificarUsuario() {
    # Datos
    $id=$_POST['id'];
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellido'];
    $email=$_POST['email'];
    $rfc=$_POST['rfc'];
    $celular=$_POST['tel'];
    $tipo=$_POST['tipo_usuario'];
    $contra=$_POST['password'];
    $cContra=$_POST['password1'];
    if(!$contra==$cContra){
      printf('<script>
      alert("No coinciden las contraseñas favor de verificar");
      </script>');
    }
    # Conexión a la DB
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    # DB Insert
    $resultado = mysqli_query($link, "UPDATE f_cliente SET rfc='$rfc', razon_social='$razon', email='$email', telefono='$telefono', calle='$calle', municipio='$municipio', cp='$cp', estado='$estado' where id='$id'");
    # Error
    if ($error = mysqli_error($link)) {
      errorModificarUsuario($email);
      return false;
    }
    # Éxito
    exitoModificarUsuario($email);
  }

  function errorModificarUsuario($email) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="errorModificarUsuarioModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorModificarUsuarioModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Error modificando el usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ocurrió un error al tratar de modficiar el usuario con correo  <samp><?php echo $email ?></samp>.</p>
            <p>Por favor verifique que todos los datos estén correctos y vuelva a intentarlo.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="irA('usuarios.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#errorModificarUsuarioModal").modal('show');
      })
    </script>
    <?php
  }

  function exitoModificarUsuario($email) {
    ?>
    <script type="text/javascript" src="../comun/global.js"></script>
    <div class="modal fade" id="exitoModificarUsuarioModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exitoModificarUsuarioModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Usuario modificado con éxito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>El usuario con correo  <samp><?php echo $email ?></samp> ha sido modificado y está listo para usarse.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="irA('usuarios.php')">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#exitoModificarUsuarioModal").modal('show');
      })
    </script>
    <?php
  }
?>

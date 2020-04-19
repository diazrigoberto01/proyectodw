<?php
  session_start();

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
?>

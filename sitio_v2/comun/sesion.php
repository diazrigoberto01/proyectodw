<?php
  session_start();

  function iniciarSesion($email, $clave) {
    $link = conectarse();
    echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
    $resultado = mysqli_query($link, "SELECT * FROM f_usuario WHERE email = '$email' AND pass = '$clave'");
    if ($error = mysqli_error($link)) {
      echo 'Error con la Base de Datos: '.$error;
      ?>
      <br>
      <br>
      <a href="../inicio.html">Regresar</a>
      <?php
      die();
    }
    $informacion = mysqli_fetch_array($resultado);
    $cantidad = mysqli_num_rows($resultado);
    if($cantidad == 1) {
      $_SESSION['usuario'] = $email;
      $_SESSION['nombre'] = $informacion['nombre'];
      $_SESSION['apellido'] = $informacion['apellidos'];
      $_SESSION['tipo_usuario'] = $informacion['tipo'];
      return true;
    } else {
      return false;
    }
  }

  function errorIniciandoSesion($usuario) {
    ?>
    <div class="modal fade" id="errorSesionModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="errorSesionModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Error iniciando sesión</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ocurrió un error al tratar de iniciar sesión con el usuario <samp><?php echo $usuario ?></samp>.</p>
            <p>Es posible que el usuario no exista o que haya habido algún error con la combinación entre el usuario y la contraseña.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#errorSesionModal").modal('show');
      })
    </script>
    <?php
  }

  function cerrarSesion() {
    session_unset();
    session_destroy();
    $path_index = $path_absoluto . "index.php";
    header("Location: $path_index");
  }
?>

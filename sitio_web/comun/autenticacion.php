<?php
  function Conectarse() {
    if (!($link = mysqli_connect("localhost", "proydweb_p2020", "Dw3bp@020", "proydweb_P2020"))) {
      die('Error conectando: ' . mysqli_connect_error());
      exit();
    }
    return $link;
  }
  $email = $_POST['email'];
  $clave = $_POST['clave'];
  $link = Conectarse();
  echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
  $resultado = mysqli_query($link, "SELECT * FROM f_usuario WHERE email = '$email' AND password = '$clave'");
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
    if ($informacion['tipo'] == 'admin') {
      $_SESSION['tipo_usuario'] = $informacion['tipo'];
      header("location: ../admin/principal.html");
    } else if ($informacion['tipo'] == 'auxiliar') {
      $_SESSION['tipo_usuario'] = $informacion['tipo'];
      header("location: ../auxiliar/principal.html");
    }
  } else {
    printf("<script>alert('Hubo un error iniciando sesión. No pudimos conseguir la combinación de usuario y contraseña.'); location.href = '../inicio-sesion.html';</script>");
  }
?>

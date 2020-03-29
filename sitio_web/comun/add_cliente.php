<?php
  include "conexion.php";
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
  // Conexión
  $link = Conectarse();
  echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
  $resultado = mysqli_query($link, "INSERT INTO f_cliente(rfc, razon_social, email, telefono, calle, no_exterior, municipio, cp, estado,usuario_rfc) VALUES('$rfc', '$razon', '$email', '$telefono', '$calle', '$numero_exterior', '$municipio', '$cp', '$estado','$user_rfc')");
  if ($error = mysqli_error($link)) {
    echo 'Error agregando los datos a la Base de Datos: '.$error;
    ?>
    <br>
    <br>
    <?php
    if ($_POST['tipo'] == 'admin') {
      printf('<a href="../admin/agregar_clientes.html">Regresar</a>');
    } else if ($_POST['tipo'] == 'auxiliar') {
      printf('<a href="../auxiliar/agregarClientesaux.html">Regresar</a>');
    }
    die();
  }
  // Éxito
  if ($_POST['tipo'] == 'admin') {
    $url = "../admin/clientes_admin.php";
  } else if ($_POST['tipo'] == 'auxiliar') {
    $url = "../auxiliar/clientes_aux.php";
  }
  printf("<script>alert('El cliente con el RFC: %s, ha sido creado.'); location.href = '%s';</script>", $rfc, $url);
?>

<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  if (!isset($_SESSION['tipo_usuario'])) {
    header("Location: no-autorizado.php");
    die();
  }
  if ($_GET["op"]) {
    $operacion = $_GET["op"];
    $id = $_GET["id"];
  } else {
    $operacion = 1;
  }
  $nivel = 1;
  require "../comun/recursos.php";
  require "../comun/lib-facturas.php";
  if ($operacion == 2) {
    echo "<script>console.log('Cancelando factura $id.')</script>";
    eliminarFactura($id);
  }
?>

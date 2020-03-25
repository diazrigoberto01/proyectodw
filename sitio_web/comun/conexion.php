<?php
  function Conectarse() {
    if (!($link = mysqli_connect("localhost", "proydweb_p2020", "Dw3bp@020", "proydweb_P2020"))) {
      die('Error conectando: ' . mysqli_connect_error());
      exit();
    }
    return $link;
  }
?>

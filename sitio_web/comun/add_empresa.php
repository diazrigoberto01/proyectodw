<?php
  include "conexion.php";
  //echo $_POST;
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
  
  $status=1;
  // Conexión
  $link = Conectarse();
  echo '<script>console.log("Conexión con la Base de Datos conseguida.")</script>'; // Debugging
  
  $resultado = mysqli_query($link, "INSERT INTO f_empresas(rfc, razon_social, nombre_comercial, contacto, telefono, email,celular,status,usuario_rfc,regimen_fiscal) VALUES('$rfc', '$razon', '$nombre_comercial', '$contacto', '$telefono', '$email','$telefono','$status','$rfc_user','$regimen')")
  or die(mysqli_error($link))
  ;
  $resultado1=mysqli_query($link,"INSERT INTO f_direccion_empresa(calle,localidad,colonia,municipio,estado,pais,n_exterior,cp,empresa_rfc,empresa_usuario_rfc)
values ('$calle','$localidad','$colonia','$municipio','$estado','$pais','$numero_exterior','$cp','$rfc','$rfc_user')")
or die(mysqli_error($link))
;
  
  if ($error = mysqli_error($link)) {
    echo 'Error agregando los datos a la Base de Datos: '.$error;
    ?>
    <br>
    <br>
    <?php
    if ($_POST['tipo'] == 'admin') {
      printf('<a href="../admin/agregar_empresas.html">Regresar</a>');
    } else if ($_POST['tipo'] == 'auxiliar') {
      printf('<a href="../auxiliar/agregarempsaux.html">Regresar</a>');
    }
    die();
  }
  // Éxito
  if ($_POST['tipo'] == 'admin') {
    $url = "../admin/empresas_admin.php";
  } else if ($_POST['tipo'] == 'auxiliar') {
    $url = "../auxiliar/empresas_aux.php";
  }
  printf("<script>alert('La empresa con el RFC: %s, ha sido creada.'); location.href ='%s';</script>", $rfc, $url);
?>
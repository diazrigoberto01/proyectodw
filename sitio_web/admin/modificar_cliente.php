<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Clientes</title>
    <script type="text/javascript">
    function valida() {
      if(verificarRfc(document.cliente.rfcCliente.value)){
        document.cliente.rfcCliente.focus();
        return false;
      };
      if(document.cliente.rSocial.value.length == 0){
        document.cliente.rSocial.focus();
        return false;
      };
      if(document.cliente.contacto.value.length == 0 ){
        document.cliente.contacto.focus();
        return false;
      };
      if(document.cliente.email.value.length == 0){
        document.cliente.email.focus();
        return false;

      };
      if(document.cliente.tel.value.length == 0){
        document.cliente.tel.focus();
        return false;
      };
      if(document.cliente.calle.value.length == 0){
        document.cliente.calle.focus();
        return false;

      };
      if(document.cliente.nExt.value.length == 0 ){
        document.cliente.nExt.focus();
        return false;

      };
      if(document.cliente.localidad.value.length == 0){
        document.cliente.localidad.focus();
        return false;

      };
      if(document.cliente.municipio.value.length == 0 ){
        document.cliente.municipio.focus();
        return false;
      };
      if(document.cliente.estado.value.length == 0){
        document.cliente.estado.focus();
        return false;

      };
      return true;
      }
    </script>
  </head>
  <body>
    <h1>Modificar Clientes</h1>
    <?php
    if($_GET["id"]){

      $id=$_GET["id"];
      include '../comun/conexion.php';//
      $link = Conectarse();
      $consulta = mysqli_query($link, "SELECT rfc, razon_social, email, telefono, calle, no_exterior, municipio, cp, estado FROM f_cliente where id='$id'");
      $row = mysqli_fetch_array($consulta);
      //echo $row[6];
    }else{
      header("Location: clientes_admin.php");
    }

    if($_POST){
      echo "voy";
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


        $imagen=$_POST["imagen"];

        $update1=mysqli_query($link, "UPDATE f_cliente SET rfc='$rfc', razon_social='$razon', email='$email', telefono='$telefono', calle='$calle', no_exterior='$numero_exterior', municipio='$municipio', cp='$cp', estado='$estado' where id='$id'");
        if($update1) {
          echo "<script>alert('Actualizacion correcta');
          location.href='clientes_admin.php';
          </script>";

        } else {
          echo "<script> alert('Algo salio mal')</script>";
        }
      }
    ?>

<form action="modificar_cliente.php" method="POST" onsubmit="return valida()">
    <table>
        <tr>
          <td>RFC:</td>
          <td>
            <input type="text" name="rfcCliente" id="" placeholder="RFC" value="<?php echo $row[0]?>"/>
          </td>
        </tr>
        <tr>
          <td>Razon Social:</td>
          <td>
            <input type="text" name="rSocial" placeholder="Razon Social" value="<?php echo $row[1]?>"/>
          </td>
        </tr>
        <tr>
          <td>Email:</td>
          <td><input type="text" name="email" id="" placeholder="Email" value="<?php echo $row[2]?>"/></td>
        </tr>
        <tr>
          <td>Telefono:</td>
          <td><input type="text" name="tel" id="" placeholder="Telefono" value="<?php echo $row[3]?>"/></td>
        </tr>
        <tr>
          <td colspan="2">
            <center><h3>Direccion</h3></center>
          </td>
        </tr>
        <tr>
          <td>Calle:</td>
          <td><input type="text" name="calle" id="" placeholder="Calle" value="<?php echo $row[4]?>"/></td>
        </tr>
        <tr>
          <td>Nº Exterior</td>
          <td>
            <input type="text" name="n_ext" id="" placeholder="Nº Exterior" value="<?php echo $row[5]?>"/>
          </td>
        </tr>
        <tr>
          <td>Localidad:</td>
          <td>
            <input type="text" name="localidad" id="" placeholder="Localidad" value="<?php echo $row[6]?>"/>
          </td>
        </tr>
        <tr>
          <td>
            Municipio:
          </td>
          <td><input type="text" name="municipio" id="" placeholder="Municipio" value="<?php echo $row[6]?>"></td>
        </tr>
        <tr>
          <td>Estado:</td>
          <td><input type="text" name="estado" id="" placeholder="Estado" value="<?php echo $row[8]?>"></td>
        </tr>
        <tr>
          <td>CP</td>
          <td><input type="text" name="cp" id="" placeholder="CP" value="<?php echo $row[7]?>"/></td>
        </tr>
        <tr>
            <td colspan="2" >
                <center>
                    <input type="submit" value="Actualizar">
                    <input type="button" value="Cancelar" onclick="history.go(-1)">
                </center>

            </td>
        </tr>
    </table>
  </form>
  </body>
</html>

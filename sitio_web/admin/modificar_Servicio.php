<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Servicio</title>
    <script>
      function modificar(){
        var modificar=window.confirm("¿Seguro que desea modificar?")
        if (modificar) {
<<<<<<< HEAD
          valida();
=======
          return valida();
>>>>>>> bddd171ac8cbd710ab919a332678a0a71e3add33
        } else {
          return 0;
        }
      }
      function valida() {
<<<<<<< HEAD
        if(document.servicio.clave.value.length == 0){
          document.servicio.clave.focus();
=======
        if(document.servicio.clave_producto.value.length == 0){
          document.servicio.clave_producto.focus();
>>>>>>> bddd171ac8cbd710ab919a332678a0a71e3add33
          return false;
        };
        if(document.servicio.um.value.length == 0){
          document.servicio.um.focus();
          return false;
        };
        if(document.servicio.descripcion.value.length == 0 ){
          document.servicio.descripcion.focus();
          return false;
        };
        if(document.servicio.pu.value.length == 0){
          document.servicio.pu.focus();
          return false;
        };
        return true;
      }
    </script>
  </head>
  <body>
    <h3>Modificar Servicio</h3>
    <?php
<<<<<<< HEAD
    if($_GET){
=======
    if($_GET["id"]){
>>>>>>> bddd171ac8cbd710ab919a332678a0a71e3add33
      $id=$_GET["id"];
      include '../comun/conexion.php';//
      $link = Conectarse();
      $consulta = mysqli_query($link, "SELECT clave,descripcion,unidad_medida,precio FROM f_concepto where id='$id'");
      $row = mysqli_fetch_array($consulta);
    }else{
      header("Location: servicios_admin.php");
    }

    if($_POST){
<<<<<<< HEAD
      echo "<script>
      alert('si entro');
      </script>";
      $nombre = $_POST['clave'];
=======
      $nombre = $_POST['clave_producto'];
>>>>>>> bddd171ac8cbd710ab919a332678a0a71e3add33
      $descripcion = $_POST['descripcion'];
      $unidadmedida = $_POST['um'];
      $pu = $_POST['pu'];
        $update1=mysqli_query($link, "UPDATE f_concepto SET clave='$nombre',descripcion='$descripcion',unidad_medida='$unidadmedida',precio='$pu' where id='$id'");
        if($update1){
          echo "<script>alert('Actualizacion correcta');
          location.href='servicios_admin.php';
          </script>";
        }else{
          echo "<script> alert('Algo salio mal')</script>";
        }
      }
    ?>
<<<<<<< HEAD
      <form action="" method="POST" onsubmit="return modificar()" name="servicio">
=======
      <form action="modificar_Servicio.php" method="POST" onsubmit="return modificar()">
>>>>>>> bddd171ac8cbd710ab919a332678a0a71e3add33
        <table>
        <tr>
            <td>Clave Producto Servicio</td>
            <td>
<<<<<<< HEAD
                <input type="text" name="clave" placeholder="Clave del producto" value="<?php echo $row[0]?>">
=======
                <input type="text" name="clave_producto" placeholder="Clave del producto" value="<?php echo $row[0]?>">
>>>>>>> bddd171ac8cbd710ab919a332678a0a71e3add33
            </td>
        </tr>
        <tr>
            <td>Descripcion:</td>
            <td><textarea name="descripcion" id="" cols="20" rows="5" noresize >

              <?php echo $row[1]?>

          </textarea></td>
        </tr>
        <tr>
            <td>Unidad de Medida</td>
            <td> <input type="text" name="um"  id="" placeholder="Precio Unitario" value="<?php echo $row[2]?>"></td>
        </tr>
        <tr>
        <tr>
            <td>Precio Unitario</td>
            <td> <input type="number" name="pu"  id="" placeholder="Precio Unitario" value="<?php echo $row[3]?>"></td>
        </tr>
        <tr>
            <td colspan="2">
                <center>
                     <input type="submit" value="Modificar">
                     <input type="button" value="Cancelar" onclick="history.go(-1)">
                </center>
            </td>
        </tr>
      </table>
      </form>
  </body>
</html>

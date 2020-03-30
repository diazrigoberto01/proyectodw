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
          
          
        } else {
          return 0;
          
        }
      }
    </script>
  </head>
  <body>
    <h3>Modificar Servicio</h3>
    <?php
    if($_GET["id"]){
      
      $id=$_GET["id"];
      include '../comun/conexion.php';//
      $link = Conectarse();
      $consulta = mysqli_query($link, "SELECT clave,descripcion,unidad_medida,precio FROM f_concepto where id='$id'");
      $row = mysqli_fetch_array($consulta);
      //echo $row[6];
    }else{
      header("Location: servicios_admin.php");
    }

    if($_POST){
      //echo "voy";
      $nombre = $_POST['clave_producto'];
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

    <table>
      <form action="" method="POST">
        <tr>
            <td>Clave Producto Servicio</td>
            <td>
                <input type="text" name="clave_producto" placeholder="Clave del producto" value="<?php echo $row[0]?>">
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
                     <input type="submit" value="Modificar" onclick="modificar()">
                     <input type="button" value="Cancelar" onclick="history.go(-1)">
                </center>
               
            </td>
        </tr>
      </form>
    </table>
    
  </body>
</html>
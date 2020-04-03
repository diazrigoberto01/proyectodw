<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Clientes</title>
    <script>
        function valida(){
           if( document.forms["cliente"]["rfc_cliente"].value.length==0){
                document.cliente.rfc_cliente.focus();
                return false;
            }else{
                return true;
            }
                
            }
        
            
        
    </script>
  </head>
  <body>
    <h1>Modificar Clientes</h1>
    <?php
    if(true){
      
      $id=1;//$_GET["id"];
      include '../comun/conexion.php';//
      $link = Conectarse();
      $consulta = mysqli_query($link, "SELECT rfc, razon_social, email, telefono, calle, municipio, cp, estado FROM f_cliente where id='$id'") or die(mysqli_error($link));
      $row = mysqli_fetch_array($consulta);
      //echo $row[6];
    }else{
      header("Location: clientes_admin.php");
    }

    if($_POST){
      //echo "voy";
      $rfc = $_POST['rfc_cliente'];
      $razon = $_POST['r_social'];
      $email = $_POST['email'];
      $telefono = $_POST['tel'];
      $calle = $_POST['calle'];
      $localidad = $_POST['localidad'];
      $municipio = $_POST['municipio'];
      $cp = $_POST['cp'];
      $estado = $_POST['estado'];
      //$imagen=$_POST["imagen"];

        $update1=mysqli_query($link, "UPDATE f_cliente SET rfc='$rfc', razon_social='$razon', email='$email', telefono='$telefono', calle='$calle', municipio='$municipio', cp='$cp', estado='$estado' where id='$id'") or die(mysqli_error($link));
        if($update1){
          echo "<script>alert('Actualizacion correcta');
          location.href='clientes_admin.php'
          
          </script>";
         
        }else{
          echo "<script> alert('Algo salio mal')</script>";
        }

      }
       


  
    ?>

<form action="" method="POST" name="cliente" onsubmit="return valida()">
    <table>
      
        <tr>
          <td>RFC:</td>
          <td>
            <input type="text" name="rfc_cliente" id="" placeholder="RFC" value="<?php echo $row[0]?>"/>
          </td>
        </tr>
        <tr>
          <td>Razon Social:</td>
          <td>
            <input type="text" name="r_social" placeholder="Razon Social" value="<?php echo $row[1]?>"/>
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
          <td>Localidad:</td>
          <td>
            <input type="text" name="localidad" id="" placeholder="Localidad" value="<?php echo $row[5]?>"/>
          </td>
        </tr>
        <tr>
          <td>
            Municipio:
          </td>
          <td><input type="text" name="municipio" id="" placeholder="Municipio" value="<?php echo $row[5]?>"></td>
        </tr>
        <tr>
          <td>Estado:</td>
          <td><input type="text" name="estado" id="" placeholder="Estado" value="<?php echo $row[7]?>"></td>
        </tr>
        <tr>
          <td>CP</td>
          <td><input type="text" name="cp" id="" placeholder="CP" value="<?php echo $row[6]?>"/></td>
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

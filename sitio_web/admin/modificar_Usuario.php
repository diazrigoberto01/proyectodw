<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Usuarios Admin</title>
    <script>
        function modificar() {
          var modificar=window.confirm("¿Seguro que desea modificar?");
          if (modificar) {
            
          } else {
            return 0;
          }
        }
      </script>
  </head>
  <body>
    <h3>Modificar Usuarios</h3>
    <?php
    if($_GET["id"]){
      
      $id=$_GET["id"];
      include '../comun/conexion.php';//
      $link = Conectarse();
      $consulta = mysqli_query($link, "SELECT nombre,apellidos,email,rfc,celular from f_usuario where id='$id'");
      $row = mysqli_fetch_array($consulta);
      //echo $row[6];
    }else{
      header("Location: usuarios_admin.php");
    }

    if($_POST){
      //echo "voy";
      $nombre = $_POST['nombre_cliente'];
      $apellido = $_POST['apellido_cliente'];
      $email = $_POST['email_usuario'];
      $rfc = $_POST['rfc_usuario'];
      $cel = $_POST['cel_usuario'];
    
        

        $update1=mysqli_query($link, "UPDATE f_usuario SET nombre='$nombre',apellidos='$apellido',email='$email',rfc='$rfc',celular='$cel' where id='$id'");
        if($update1){
          echo "<script>alert('Actualizacion correcta');
          location.href='usuarios_admin.php';
          </script>";
         
        }else{
          echo "<script> alert('Algo salio mal')</script>";
        }

      }
       


  
    ?>
    <form action="" method="POST">
      <table align="center">
        <tr>
          <th colspan="3">
            <h3>
              Modificar Usuario
            </h3>
          </th>
        </tr>
        <tr>
          <td>Nombre Completo</td>
          <td>
            <input
              type="text"
              name="nombre_cliente"
              id=""
              placeholder="Nombre"
              value="<?php echo $row[0]?>"
            />
          </td>
          <td>
            <input
              type="text"
              name="apellido_cliente"
              id=""
              placeholder="Apellidos"
              value="<?php echo $row[1]?>"
            />
          </td>
        </tr>
        <tr>
          <td>
            Correo
          </td>
          <td>
            <input
              type="email"
              name="email_usuario"
              id=""
              placeholder="algo@empresa.com"
              value="<?php echo $row[2]?>"
            />
          </td>
        </tr>
        <tr>
          <td>
            RFC
          </td>
          <td><input type="text" name="rfc_usuario" id="" placeholder="RFC" value="<?php echo $row[3]?>"></td>
        </tr>
        <tr>
            <td>
                Celular
            </td>
            <td>
                <input type="text" name="cel_usuario" id="" placeholder="Celular" value="<?php echo $row[4]?>">
            </td>
        </tr>
       
        <tr>
            <td colspan="3">
                <center>
                    <a href="">
                      <br><br>
                        <input type="submit" value="Modificar" onclick="modificar()">
                        <input type="button" value="Cancelar" onclick="history.go(-1)">
                    </a>
                </center>
            </td>
        </tr>
      </table>
    </form>
  </body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="../js/scriptVerificacion.js"></script>
    <title>Document</title>
    <script type="text/javascript">
      function usuarioCreado() {
        var bool = true;
        bool = bool && verificarApellido(document.nuevo.apellido.value);
        bool = bool && verificarRfc(document.nuevo.rfc.value);
        bool = bool && verificarCoincidenciaContrasena(document.nuevo.contra.value, document.nuevo.cContra.value);
        if (bool) {
          alert("El usuario ha sido creado con éxito.");
          history.go(-1);
        } else {
          alert("Hubo un error al crear el usuario.");
          return 0;
        }
      }
    </script>
  </head>
  <body>
    <h3>Agregar Usuarios</h3>
    <?php
 include'../comun/conexion.php';
    if($_POST){
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellido'];
<<<<<<< HEAD
    $email=$_POST['email'];
    $rfc=$_POST['rfc'];
    $celular=$_POST['tel'];
=======
    $email=$_POST['email_usuario'];
    $rfc=$_POST['rfc'];
    $celular=$_POST['cel_usuario'];
>>>>>>> bddd171ac8cbd710ab919a332678a0a71e3add33
    $tipo=$_POST['tipo_usuario'];
    $contra=$_POST['contra'];
    $cContra=$_POST['cContra'];

    if(!$contra==$cContra){
      printf('<script>
      alert("No coinciden las contraseñas favor de verificar");
      </script>');
    }
<<<<<<< HEAD

=======
    
>>>>>>> bddd171ac8cbd710ab919a332678a0a71e3add33


    $link=Conectarse();
    $resultado = mysqli_query($link, "INSERT INTO f_usuario(rfc, nombre, apellidos, email, pass, celular, tel_fijo, tipo)
    VALUES ('$rfc', '$nombre', '$apellidos', '$email', '$contra', '$celular', '', '$tipo')");
     //echo $resultado;
  if ($error = mysqli_error($link)) {
    echo 'Error agregando los datos a la Base de Datos: '.$error;
    ?>
    <br>
    <br>
    <?php
      printf("<script>alert('Algo salio mal')</script>");
<<<<<<< HEAD

=======
    
>>>>>>> bddd171ac8cbd710ab919a332678a0a71e3add33
    die();
  }
  if ($resultado) {
      printf("<script>alert('El servicio ha sido insertado'); location.href ='usuarios_admin.php';</script>");
}
<<<<<<< HEAD

=======
        
>>>>>>> bddd171ac8cbd710ab919a332678a0a71e3add33
    }

?>

    <form action="" name="nuevo" method="POST">
      <table align="center">
        <tr>
          <th colspan="3">
            <h3>
              Nuevo Usuario
            </h3>
          </th>
        </tr>
        <tr>
          <td>Nombre Completo</td>
          <td>
            <input
              type="text"
              name="nombre"
              placeholder="Nombre"
            required/>
          </td>
          <td>
            <input
              type="text"
              name="apellido"
              id=""
              placeholder="Apellidos"
            required/>
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
            required/>
          </td>
        </tr>
        <tr>
          <td>
            RFC
          </td>
          <td><input type="text" name="rfc" id="" placeholder="RFC" required></td>
        </tr>
        <tr>
            <td>
                Celular
            </td>
            <td>
                <input type="text" name="cel_usuario" id="" placeholder="Celular" required>
            </td>
        </tr>
        <tr>
            <td>Tipo</td>
            <td>
                <select name="tipo_usuario" id=_usuario"">
                    <option value="Elegir">Elegir</option>
                    <option value="Admin">Administrador</option>
                    <option value="Aux">Auxiliar</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Contraseña</td>
            <td>
                <input type="password" name="contra" required>
            </td>
        </tr>
        <tr>
            <td>Confirmar Contraseña</td>
            <td>
                <input type="password" name="cContra" required>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <center>
                  <br><br>
                  <input type="submit" value="Agregar">
                  <input type="button" value="Cancelar" onclick="history.go(-1)">
                </center>
            </td>
        </tr>
      </table>
    </form>
  </body>
</html>

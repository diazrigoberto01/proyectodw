<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Empresa</title>
  </head>
  <body>
    <h1>Modificar Empresa</h1>

    <?php
    if($_GET["id"]){
      
      $id=$_GET["id"];
      include '../comun/conexion.php';//
      $link = Conectarse();
      $consulta = mysqli_query($link, "SELECT e.nombre_comercial, e.contacto, e.rfc, e.telefono,e.email,de.calle,de.colonia,de.municipio,de.estado,de.pais,de.n_exterior,de.cp FROM f_empresas e inner join f_direccion_empresa de on (e.rfc=de.empresa_rfc)  where e.id='$id'");
      $row = mysqli_fetch_array($consulta);
      echo $row[6];
    }else{
      header("Location: empresas_admin.php");
    }
    if($_POST){
       $rfc=$_POST["razon_social"];
        $nombreComercial=$_POST["nombre_comercial"];
        $contacto=$_POST["contacto_nombre"];
        $telefono=$_POST["telefono"];
        $email=$_POST["email"];
        $pais=$_POST["pais"];
        $estado=$_POST["estado"];
        $municipio=$_POST["municipio"];
        $calle=$_POST["calle"];
        $n_ext=$_POST["n_ext"];
        $n_int=$_POST["n_int"];
        $localidad=$_POST["localidad"];
        $cp=$_POST["cp"];
        
        $imagen=$_POST["imagen"];

        $update1=mysqli_query($link, "UPDATE f_empresas SET nombre_comercial='$nombreComercial', contacto='$contacto', rfc='$rfc', telefono='$telefono',email='$email' where id='$id'");
        $update2=mysqli_query($link, "UPDATE f_direccion_empresa set calle='$calle',colonia='$localidad',municipio='$municipio',estado='$estado',pais='$pais',n_exterior='$n_ext',cp=$cp,localidad='$localidad'  where empresa_rfc='$row[2]'");
        if($update1 and $update2){
          echo "<script>alert('Actualizacion correcta');
          location.href=empresas_admin.php;
          </script>";
         
        }else{
          echo "<script> alert('Algo salio mal')</script>";
        }

      }
       


  
    ?>
    <form action="" method="POST">
      <table>
        <tr>
          <td>RFC</td>
          <td colspan="2">
            <input
              type="text"
              name="razon_social"
              id=""
              value="<?php echo $row[2]?>"
              placeholder="Ingresa la razon social"
              size="43"
            />
          </td>
          <td></td>
        </tr>
        <tr>
          <td>Nombre Comercial</td>
          <td colspan="2">
            <input
              type="text"
              name="nombre_comercial"
              value="<?php echo $row[0]?>"
              placeholder="Ingresa el nombre Comercial"
              size="43"
            />
          </td>
        </tr>
        <tr>
          <td>Contacto Nombre Completo</td>
          <td>
            <input
              type="text"
              name="contacto_nombre"
              value="<?php echo $row[1]?>"
              id=""
              placeholder="Nombre"
            />
          </td>
        </tr>
        <tr>
          <td>Telefono:</td>
          <td colspan="2" >
            <input
              type="text"
              name="telefono"
              id=""
              value="<?php echo $row[3]?>"
              placeholder="Telefono fijo"
            />
          </td>
        </tr>
        <tr>
          <td>Email:</td>
          <td><input type="text" name="email" id="" placeholder="Email" value="<?php echo $row[4]?>" /></td>
        </tr>
        <tr>
          <td>Pais</td>
          <td><input type="text" name="pais" id="" placeholder="Pais" value="<?php echo $row[9]?>"/></td>
        </tr>
        <tr>
          <td>Estado</td>
          <td>
            <input type="text" name="estado" id="" placeholder="Estado" value="<?php echo $row[8]?>"/>
          </td>
        </tr>
        <tr>
          <td>Municipio</td>
          <td>
            <input type="text" name="municipio" id="" placeholder="Municipio" value="<?php echo $row[7]?>"/>
          </td>
        </tr>
        <tr>
          <td>Calle</td>
          <td><input type="text" name="calle" id="" placeholder="Calle" value="<?php echo $row[5]?>"/></td>
        </tr>
        <tr>
          <td>Nº Exterior</td>
          <td>
            <input type="text" name="n_ext" id="" placeholder="Nº Exterior" value="<?php echo $row[10]?>"/>
          </td>
        </tr>
        <tr>
          <td>Nº Interior</td>
          <td>
            <input type="text" name="n_int" id="" placeholder="Nº Interior" />
          </td>
        </tr>
        <tr>
          <td>Localidad</td>
          <td>
            <input type="text" name="localidad" id="" placeholder="Localidad" value="<?php echo $row[6]?>"/>
          </td>
        </tr>
        <tr>
          <td>CP</td>
          <td><input type="text" name="cp" id="" placeholder="CP" value="<?php echo $row[11]?>"/></td>
        </tr>
        
        <tr>
          <td>Imagen:</td>
          <td colspan="2">
            <input type="file" name="imagen" id="" placeholder="Sube aqui el logo">
          </td>
        </tr>


      <tr>
        <td colspan="2">
          <center>
            <br><br>
            <input type="submit" value="Actualizar" onclick="modificar()"/>
            <input type="button" value="Cancelar" onclick="history.go(-1)">
          </center>
        </td>
      </tr>
    </table>
  </form>
  </body>
</html>
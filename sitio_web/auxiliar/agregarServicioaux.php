<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agregar Servicio</title>
    <script>
      function Agregar() {
        var contraseña = prompt("Ingresa tu contraseña");
        if (contraseña) {
          var val = valida();
          if (val) {
            var modificar = window.confirm("¿Agregar?");
            if (modificar) {
              alert("Agregado con exito");
              history.go(-1);
            } else {
              return 0;
            }
          } else {
            return 0;
          }
        } else {
          alert("Contraseña Equivocada");
          return 0;
        }
      }
      function valida() {
        if(document.servicio.clave_unidad.value.length == 0){
          document.servicio.clave_unidad.focus();
          return false;
        };
        if(document.servicio.clave_producto.value.length == 0){
          document.servicio.clave_producto.focus();
          return false;
        };
        if(document.servicio.identificador.value.length == 0){
          document.servicio.identificador.focus();
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
    <h3>Agregar Servicio</h3>
    <?php
    include include'../comun/conexion.php';
        if($_POST){
        $clave=$_POST['clave_producto'];
        $descripcion=$_POST['descripcion'];
        $um=$_POST['um'];
        $pu=$_POST['pu'];

        $link=Conectarse();
        $resultado = mysqli_query($link, "INSERT INTO f_concepto(clave,descripcion,unidad_medida,precio)
         VALUES('$clave', '$descripcion', '$um', '$pu')");
         //echo $resultado;
      if ($error = mysqli_error($link)) {
        echo 'Error agregando los datos a la Base de Datos: '.$error;
        ?>
        <br>
        <br>
        <?php
          printf("<script>alert('Algo salio mal')</script>");

        die();
      }
      if ($resultado) {
          printf("<script>alert('El servicio ha sido insertado'); location.href ='servicios_aux.php';</script>");
    }

        }
    ?>
    <form action="" method="POST" name="servicio">
    <table>
        <tr>
          <td>
            Clave Unidad SAT
          </td>
          <td>
            <input
              type="text"
              name="clave_unidad"
              placeholder="Clave Unidad SAT"
            required/>
          </td>
        </tr>
        <tr>
          <td>Clave Producto Servicio</td>
          <td>
            <input
              type="text"
              name="clave_producto"
              placeholder="Clave del producto"
            required/>
          </td>
        </tr>
        <tr>
          <td>Nombre de Identificacion:</td>
          <td>
            <input
              type="text"
              name="identificador"
              id=""
              placeholder="Nombre de Identificacion"
            required/>
          </td>
        </tr>
        <tr>
          <td>Descripcion:</td>
          <td>
            <textarea
              name="descripcion"
              id=""
              cols="20"
              rows="5"
              noresize
            ></textarea>
          </td>
        </tr>
        <tr>
          <td>Precio Unitario</td>
          <td>
            <input
              type="number"
              name="pu"
              id=""
              placeholder="Precio Unitario"
            required/>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <center>
              <br><br>
              <input type="button" value="Agregar" onclick="Agregar()"/>
              <input type="button" value="Regresar" onclick="history.go(-1)"/>
            </center>
          </td>
        </tr>
    </table>
  </form>
  <br><br><p>Los campos con (*) son obligatorios.</p>
  </body>
</html>

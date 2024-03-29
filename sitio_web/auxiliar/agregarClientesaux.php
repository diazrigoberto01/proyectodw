<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agregar Clientes</title>
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
    <h1>Agregar Clientes</h1>

    <form name="cliente" action="../comun/add_cliente.php" method="post" onsubmit="return Agregar()" target="_parent">
      <table>
        <tr>
          <td>RFC (*):</td>
          <td>
            <input type="text" name="rfcCliente" placeholder="RFC" required/>
          </td>
        </tr>
        <tr>
          <td>Razon Social (*):</td>
          <td>
            <input type="text" name="rSocial" placeholder="Razon Social" required/>
          </td>
        </tr>
        <tr>
          <td>Email (*):</td>
          <td><input type="email" name="email" placeholder="Email" required/></td>
        </tr>
        <tr>
          <td>Telefono (*):</td>
          <td><input type="tel" name="tel" placeholder="Telefono" required/></td>
        </tr>
        <tr>
          <td colspan="2">
            <center><h3>Direccion</h3></center>
          </td>
        </tr>
        <tr>
          <td>Calle (*):</td>
          <td><input type="text" name="calle" placeholder="Calle" required/></td>
        </tr>
        <tr>
          <td>Nº Exterior (*):</td>
          <td>
            <input type="number" name="nExt" placeholder="Nº Exterior" required/>
          </td>
        </tr>
        <tr>
          <td>Localidad (*):</td>
          <td>
            <input type="text" name="localidad" placeholder="Localidad" required/>
          </td>
        </tr>
        <tr>
          <td>
            Municipio (*):
          </td>
          <td><input type="text" name="municipio" placeholder="Municipio" required></td>
        </tr>
        <tr>
          <td>Estado (*):</td>
          <td><input type="text" name="estado" placeholder="Estado" required></td>
        </tr>
        <tr>
          <td>
            Imagen:
          </td>
          <td>
            <input type="file" name="imagen" placeholder="Sube aqui el logo" disabled>
            <input type="hidden" name="tipo" value="auxiliar">
          </td>
        </tr>

        <tr>
            <td colspan="2" >
              <br><br>
                <center>
                    <input type="button" value="Agregar" onclick="Agregar()">
                    <input type="button" value="Cancelar" onclick="history.go(-1)">
                </center>
            </td>
        </tr>
      </table>
    </form>
    <br><br><p>Los campos con (*) son obligatorios.</p>
  </body>
</html>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="js/scriptVerificacion.js"></script>
    <title>Agregar Empresa</title>
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
        if(document.empresa.razon_social.value.length == 0){
          document.empresa.razon_social.focus();
          return false;
        };
        if(document.empresa.nombre_comercial.value.length == 0){
          document.empresa.nombre_comercial.focus();
          return false;
        };
        if(document.empresa.contacto_nombre.value.length == 0){
          document.empresa.contacto_nombre.focus();
          return false;
        };
        if(document.empresa.telefono.value.length == 0 ){
          document.empresa.telefono.focus();
          return false;
        };
        if(document.empresa.email.value.length == 0){
          document.empresa.email.focus();
          return false;
        };
        if(document.empresa.pais.value.length == 0){
          document.empresa.pais.focus();
          return false;
        };
        if(document.empresa.estado.value.length == 0){
          document.empresa.estado.focus();
          return false;
        };
        if(document.empresa.municipio.value.length == 0){
          document.empresa.municipio.focus();
          return false;
        };
        if(document.empresa.localidad.value.length == 0){
          document.empresa.localidad.focus();
          return false;
        };
        if(document.empresa.calle.value.length == 0){
          document.empresa.calle.focus();
          return false;
        };
        if(document.empresa.n_ext.value.length == 0){
          document.empresa.n_ext.focus();
          return false;
        };
        if(verificarCp(document.empresa.cp.value)){
          document.empresa.cp.focus();
          return false;
        };
        if(document.empresa.referencia.value.length == 0){
          document.empresa.referencia.focus();
          return false;
        };

        return true;

      }

    </script>
  </head>
  <body>
    <h1>Agregar Empresa</h1>
    <form name="empresa" action="../comun/add_empresa.php" method="POST" onsubmit="return Agregar()">
      <table>
        <tr>
          <td>Nombre o Razon Social(*)</td>
          <td colspan="2">
            <input
              type="text"
              name="razon_social"
              placeholder="Ingresa la razon social"
              size="43"
            required/>
          </td>
          <td></td>
        </tr>
        <tr>
          <td>Nombre Comercial(*)</td>
          <td colspan="2">
            <input
              type="text"
              name="nombre_comercial"
              placeholder="Ingresa el nombre Comercial"
              size="43"
            required/>
          </td>
        </tr>
        <tr>
          <td>Contacto Nombre Completo(*)</td>
          <td>
            <input
              type="text"
              name="contacto_nombre"
              placeholder="Nombre"
            required/>
          </td>
          <td>
            <input
              type="text"
              name="contacto_apellido"
              placeholder="Apellido"
            required/>
          </td>
        </tr>
        <tr>
          <td>Telefono:(*)</td>
          <td colspan="2" >
            <input
              type="tel"
              name="telefono"
              placeholder="Telefono fijo"
            required/>
          </td>
        </tr>
        <tr>
          <td>Email:(*)</td>
          <td><input type="email" name="email" placeholder="Email" required/></td>
        </tr>
        <tr>
          <td>Pais(*)</td>
          <td><input type="text" name="pais" placeholder="Pais" required/></td>
        </tr>
        <tr>
          <td>Estado(*)</td>
          <td>
            <input type="text" name="estado" placeholder="Estado" required/>
          </td>
        </tr>
        <tr>
          <td>Municipio(*)</td>
          <td>
            <input type="text" name="municipio" placeholder="Municipio" required/>
          </td>
        </tr>
        <tr>
          <td>Localidad(*)</td>
          <td>
            <input type="text" name="localidad" placeholder="Localidad" required/>
          </td>
        </tr>
        <tr>
          <td>Calle(*)</td>
          <td><input type="text" name="calle" placeholder="Calle" required/></td>
        </tr>
        <tr>
          <td>Nº Exterior(*)</td>
          <td>
            <input type="number" name="n_ext" placeholder="Nº Exterior" required/>
          </td>
        </tr>
        <tr>
          <td>Nº Interior</td>
          <td>
            <input type="number" name="n_int" placeholder="Nº Interior"/>
          </td>
        </tr>
        <tr>
          <td>CP(*)</td>
          <td><input type="number" name="cp" placeholder="CP" required/></td>
        </tr>
        <tr>
          <td>Referencia(*)</td>
          <td colspan="2">
            <input
              type="text"
              name="referencia"
              placeholder="Entre que calle y que calle"
              size=42
            required/>
          </td>
        </tr>
        <tr>
          <td>Imagen:(*)</td>
          <td colspan="2">
            <input type="file" name="imagen" placeholder="Sube aqui el logo" disabled/>
            <input type="hidden" name="tipo" value="auxiliar">
          </td>
        </tr>
      <tr>
        <td colspan="2"><center>
            <input type="submit" value="Agregar"/>
            <input type="button" value="Cancelar" onclick="history.go(-1)"/>
        </center>
        </td>
      </tr>
    </table>
  </form>
  <p>Los campos con (*) son obligatorios.</p>
  </body>
</html>

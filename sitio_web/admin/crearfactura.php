<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <script>
      function agregar() {
        var contraseña = prompt("Ingresa tu contraseña");
        if (contraseña) {
          var val = valida();
          if (val) {
            var modificar = window.confirm("¿Generar?");
            if (modificar) {
              alert("Generada con exito");
              location.href = "factura_ver.html";
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
        if(document.factura.rfcEmisor.selectedIndex == 0){
          alert("Selecciona un RFC Emisor");
          document.factura.rfcEmisor.focus();
          return false;
        };
        if(document.factura.rfcCliente.selectedIndex == 0){
          alert("Selecciona un RFC Receptor");
          document.factura.rfcCliente.focus();
          return false;
        };
        if(document.factura.nombreCliente.value.length == 0){
          alert("Introduzca una persona de contacto.");
          document.factura.contactoNombre.focus();
          return false;
        };
        if(document.factura.fecha.value.length == 0 ){
          alert("Introduzca una fecha válida.")
          document.factura.fecha.focus();
          return false;
        };
        if(document.factura.lugar.value.length == 0){
          alert("Introduzca un lugar.")
          document.factura.lugar.focus();
          return false;
        };
        if(document.factura.claveProducto.selectedIndex == 0){
          alert("Selecciona una clave")
          document.factura.claveProducto.focus();
          return false;
        };
        if(document.factura.cantidad1.value.length == 0){
          alert("Introduzca una cantidad");
          document.factura.cantidad1.focus();
          return false;
        };
        if(document.factura.unidad1.value.length == 0){
          alert("Introduzca una unidad.")
          document.factura.unidad1.focus();
          return false;
        };
        if(document.factura.descripcion1.value.length == 0){
          alert("Introduzca una descipción")
          document.factura.descripcion1.focus();
          return false;
        };
        if(document.factura.monto1.value.length == 0){
          alert("Introduzca un monto de pago");
          document.factura.monto1.focus();
          return false;
        };
        if(document.factura.tipoPagos.selectedIndex == 0){
          alert("Selecciona un metodo de pago")
          document.factura.tipoPagos.focus();
          return false;
        };
        alert("Factura generada con exito");
        return location.href = "factura_ver.html";
      }
    </script>
    <title>Equipo 1</title>
  </head>
  <body align="center">
    <?php
    include'../comun/conexion.php';
    $link=Conectarse();
    ?>
    <form action="" method="POST" name="factura" onsubmit="valida()">
      <table align="center">
        <tr>
          <th colspan="6">
            <center>
              <h3>
                Crea tu Factura
              </h3>
            </center>  
          </th>
        </tr>

        <tr>
          <td><p>RFC de la empresa:</p></td>
          <td>
            <select name="rfcEmisor">
            <option value="Elegir">Elegir</option>
            <?php
            $result = mysqli_query($link, "SELECT rfc FROM f_empresas");
            while ($row = mysqli_fetch_array($result)) {
              echo '"<option value="'.$row[0].'">'.$row[0].'</option>"';
            }
          ?>
            </select>
          </td>
          <td>
          <input type="submit" name="rfc" action="" value="Buscar" />
          </td>
          <td><p>Nombre Empresa:</p></td>
          <td><input type="text" name="nombre" /></td>
          <td><p>Régimen fiscal:</p></td>
          <td><input type="text" name="regimen-fiscal" /></td>
        </tr>
        <tr>
          <td><p>RFC del cliente:</p></td>
          <td>
            <select name="rfcCliente">
              <option value="Elegir">Elegir</option>
              <option value="GBDP2012758FJ">GBDP2012758FJ</option>
              <option value="JPA45692GT9">JPA45692GT9</option>
              <option value="ARLO457689SL6">ARLO457689SL6</option>
            </select>
          </td>
          <td>Nombre Cliente</td>
          <td><input type="text" name="nombreCliente" /></td>
          <td>Uso de CFDI</td>
          <td>
            <input type="text" name="cfdi" placeholder="CFDI" />
          </td>
        </tr>
        <tr>
          <td><p>Fecha:</p></td>
          <td><input type="date" name="fecha"/></td>
          <td><p>Lugar:</p></td>
          <td><input type="text" name="lugar"/></td>
        </tr>
      </table>

      <br /><br />
      <table align="center">
        <tr>
          <td>Clave Producto</td>
          <td>Cantidad</td>
          <td>Unidad de medida</td>
          <td>Descripción</td>
          <td>Valor unitario</td>
        </tr>
        <tr>
          <td>
            <select name="claveProducto">
              <option value="Elegir">Elegir</option>
              <option value="72151302">72151302</option>
              <option value="721523">721523</option>
              <option value="5648293">5648293</option>
            </select>
          </td>
          <td><input type="number" name="cantidad1" /></td>
          <td><input type="text" name="unidad1" /></td>
          <td><textarea name="descripcion1" rows="1" cols="30"></textarea></td>
          <td><input type="number" name="monto1" value="0.0" /></td>
        </tr>
        <tr>
          <td>
            <select name="claveProducto">
              <option value="72151302">72151302</option>
              <option value="721523">721523</option>
              <option value="5648293">5648293</option>
            </select>
          </td>
          <td><input type="number" name="cantidad2" /></td>
          <td><input type="text" name="unidad2" /></td>
          <td><textarea name="descripcion2" rows="1" cols="30"></textarea></td>
          <td><input type="number" name="monto2" value="0.0" /></td>
        </tr>
        <tr>
          <td>
            <select name="claveProducto">
              <option value="72151302">72151302</option>
              <option value="721523">721523</option>
              <option value="5648293">5648293</option>
            </select>
          </td>
          <td><input type="number" name="cantidad3" /></td>
          <td><input type="text" name="unidad3" /></td>
          <td><textarea name="descripcion3" rows="1" cols="30"></textarea></td>
          <td><input type="number" name="monto3" value="0.0" /></td>
        </tr>
      </table>

      <p>Método de pago:</p>
      <input type="radio" name="tipoPagos" /> Efectivo
      <input type="radio" name="tipoPagos" checked/> Débito
      <input type="radio" name="tipoPagos" /> Crédito <br />
      <p>Condición de pago:</p>
      <select name="cantidadPagos">
        <option value="una">Una exhibición</option>
        <option value="varias">Varias exhibiciones</option>
        <option value="msi">Meses sin intereses</option>
      </select>
      <br /><br />
      <input type="submit" value="Crear Factura" />
      <input type="reset" value="Reiniciar" />
    </form>
  </body>
</html>

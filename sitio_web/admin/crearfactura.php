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

      function validarRFC(){

        if(document.factura.rfcEmisor.value==0){
          alert('Selecciona un Emisor valido');
          document.factura.rfcEmisor.focus();
          return false;
        }

        if(document.factura.rfcCliente.value == 0){
          alert('Selecciona un Cliente  valido');
          document.factura.rfcCliente.focus();
          return false;
        }
        return true;
      }
      var index = 1;
      function agregarProducto(){
        try {
          if(document.factura.rfcEmp.value==0){
         alert('Ingresa un rfc  Emisor valido');
         document.factura.rfcEmp.focus();
          return false;

       }
        } catch (error) {
          alert('Ingresa un rfc  Emisor valido');
          return false;
          
        }
       
        var table=document.getElementById("productos");
        var clave=document.getElementById("clave").value;
        var desc=document.getElementById("desc").value;
        var um=document.getElementById("um").value;
        var cantidad=document.getElementById("cantidad").value;

            var row=table.insertRow(table.rows.length);
            //insertar clave
            var cell1=row.insertCell(0);
            var t1=document.createElement("input");
                //t1.id = "clave"+index;
                t1.name="clave"+index;
                t1.value=clave;
                cell1.appendChild(t1);
            //inserta descripcion
            var cell2=row.insertCell(1);
            var t2=document.createElement("input");
                t2.id = "descripcion"+index;
                t2.value=desc;
                t2.size=50;
                cell2.appendChild(t2);
            //inserta unidad de medida
            var cell3=row.insertCell(2);
            var t3=document.createElement("input");
                t3.id = "um"+index;
                t3.value=um;
                cell3.appendChild(t3);
            //inserta cantidad
            var cell4=row.insertCell(3);
            var t4=document.createElement("input");
                t4.id = "cantidad"+index;
                t4.value=cantidad;
                cell4.appendChild(t4);
            //inserta valor unitario
            /*
            var cell5=row.insertCell(4);
            var t5=document.createElement("input");
                t5.id = "clave"+index;
                t5.value=clave;
                cell5.appendChild(t4);
            //inserta total    
            var cell6=row.insertCell(5);
            var t6=document.createElement("input");
                t6.id = "clave"+index;
                t6.value=clave;
                cell6.appendChild(t4);
                */
        index++;

      }
    </script>
    <title>Equipo 1</title>
  </head>
  <body align="center">
    <?php
    include'../comun/conexion.php';
    $link=Conectarse();
    ?>
    <form action="" method="POST" name="factura" onsubmit="">
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
            <option value="0" >Elegir</option>
            <?php
            $result = mysqli_query($link, "SELECT rfc FROM f_empresas");
            while ($row = mysqli_fetch_array($result)) {
              echo '"<option value="'.$row[0].'">'.$row[0].'</option>"';
            }
          ?>
            </select>


          </td>
          <td><p>RFC del cliente:</p></td>
          <td>
            <select name="rfcCliente">
              <option value="0">Elegir</option>
              <?php
              $result = mysqli_query($link, "SELECT rfc FROM f_cliente");
              while ($row = mysqli_fetch_array($result)) {
                echo '"<option value="'.$row[0].'">'.$row[0].'</option>"';
              }
              
              ?>
            </select>
            </td>
          <td>
          <input type="submit" name="Buscar"  value="Buscar" onclick=" return validarRFC()" />
          </td>
            </tr>
            <?php
            if($_POST['Buscar']){
              $rfcEmisor=$_POST["rfcEmisor"];
              $rfcCliente=$_POST["rfcCliente"];
              printf("
              <tr>
               <td >Rfc Emisor</td>
               <td><input type='text' name='rfcEmp' value='%s'></td>
               <td >Rfc Receptor</td>
               <td><input name='rfcReceptor'value='%s' ></td>
             </tr> 
              ",$rfcEmisor,$rfcCliente);
            }
            ?>
              


            <tr>
          <td><p>Nombre Empresa:</p></td>
          <?php
          if($_POST['Buscar']){
           $rfcEmisor= $_POST["rfcEmisor"];
           $getinfo=mysqli_query($link,"Select razon_social,regimen_fiscal from f_empresas where rfc='$rfcEmisor'") or die(mysqli_error($link));
           $infoEmisor=mysqli_fetch_array($getinfo);
              printf(
            "<td><input type='text' name='nombre' value='$infoEmisor[0]'/></td>
            <td><p>Régimen fiscal:</p></td>
            <td><input type='text' name='regimen_fiscal'  value='$infoEmisor[1]'/></td>
            "
          );
          }else{
            printf(
              "<td><input type='text' name='nombre'/></td>
              <td><p>Régimen fiscal:</p></td>
              <td><input type='tex' name='regimen_fiscal' /></td>
              "
            );

          }
          ?>
         
        </tr>
        <tr>
          <td>Nombre Cliente</td>
          <?php
          if($_POST["Buscar"]){
             $rfcCliente=$_POST["rfcCliente"];
          $getCliente=mysqli_query($link,"SELECT razon_social,concat(calle,concat(' ',concat(no_exterior,concat(', ',concat(municipio,concat(', ',concat(estado,concat(', ',cp)))))))) as Direccion FROM f_cliente where rfc='$rfcCliente'") or die(mysqli_error($link));
          $infoCliente=mysqli_fetch_array($getCliente);
          printf("
           <td><input type='text' name='nombreCliente' value='$infoCliente[0]' /></td>
           <td>Direccion:</td>
           <td><input type='text' name='dir_cliente' placeholder='Direccion Receptor' size=80 value='$infoCliente[1]'></td>
           "
          );
          }else{
            printf(
              "
              <td><input type='text' name='nombreCliente' /></td>
              <td>Direccion:</td>
              <td><input type='text' name='dir_cliente' placeholder='Direccion Receptor'></td>
              "
            );
            
          }
         
          ?>
         
          
        </tr>
        <tr>
        <td>Uso de CFDI</td>
          <td>
            <select name="cfdi" id="">
            <?php
              $result = mysqli_query($link, "SELECT clave,descripcion FROM f_usoscfdi");
              while ($usos = mysqli_fetch_array($result)) {
                $uso=$usos[0].'-'.$usos[1];
                echo '"<option value="'.$usos[0].'">'.$uso.'</option>"';
              }
              
              ?>
            
            </select>
          </td>
          <td><p>Fecha:</p></td>
          <td><input type="date" name="fecha"/></td>
          <td><p>Lugar:</p></td>
          <td><input type="text" name="lugar"/></td>
        </tr>
      </table>

      <br /><br />
      <table align="center" id="productos">
        <tr>
          <td>
            <select name="claveProducto" id="clave">
              <option value="Elegir">Elegir</option>
              <?php
              $result = mysqli_query($link, "SELECT clave FROM f_concepto");
              while ($claves = mysqli_fetch_array($result)) {
                echo '"<option value="'.$claves[0].'">'.$claves[0].'</option>"';
              }
              
              ?>
            </select>
          </td>
          <td>
            <select name="desc_producto" id="desc">
              <option value="Elegir">Elegir</option>
              <?php
              $result = mysqli_query($link, "SELECT clave,descripcion FROM f_concepto");
              while ($descripcion = mysqli_fetch_array($result)) {
                $desc=$descripcion[0].'-'.$descripcion[1];
                echo '"<option value="'.$descripcion[1].'">'.$desc.'</option>"';
              }
              
              ?>

            </select>
          </td>
          <td>
            <select name="um" id="um">
              <option value="Elegir">Elegir</option>
              <option value="m">Mts</option>
              <option value="m2">M2</option>
              <option value="m3">M3</option>
              <option value="cm">cm</option>
              <option value="cm2">cm2</option>
              <option value="lts">lts</option>
              <option value="ton">ton</option>
              <option value="kg">kg</option>
            </select>
          </td>
          <td><input type="number" name="cantidad1" id="cantidad" size=5 placeholder="Cantidad"/></td>
          <td><input type="number" name="pu" id="pu" size=5 placeholder="Precio Unitario"/></td>
          <td><input type="button" name="agregar" value="Agregar" onclick="agregarProducto()"/></td>
        </tr>
        <tr>
          <td>Clave Producto</td>
          <td>Descripción</td>
          <td>Unidad de medida</td>
          <td>Cantidad</td>
          <td>Precio Unitario</td>
          <td>Total</td>
        </tr>
       
      </table>

      <p>Método de pago:</p>
      <input type="radio" name="tipoPagos" /> Transferencia
      <input type="radio" name="tipoPagos" checked/> Débito
      <input type="radio" name="tipoPagos" /> Crédito <br />
      <p>Condición de pago:</p>
      <select name="cantidadPagos">
        <option value="una">Una exhibición</option>
        <option value="varias">Varias exhibiciones</option>
        <option value="msi">Meses sin intereses</option>
      </select>
      <br /><br />
      <input type="button" value="Crear Factura" onclick="valida()"/>
      <input type="reset" value="Reiniciar" />
    </form>
  </body>
</html>




	

	


	
	
 










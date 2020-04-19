<?php
  session_start();
  if (!isset($_SESSION['tipo_usuario'])) {
    header("Location: no-autorizado.php");
    die();
  }
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <?php
      $nivel = 1;
      require "../comun/recursos.php";
      require "../comun/lib-facturas.php";
    ?>
    <title>Nueva factura - Factura Fácil</title>
  </head>
  <body>
    <?php
      require "../comun/navbar.php";
    ?>
    <div class="container-fluid">
      <div class="row">
        <?php
          include "sidebar.php";
        ?>
        <div class="col">
          <div class="row">
            <div class="col align-self-center mb-3 mt-3">
              <h2>Nueva Factura</h2>
            </div>
          </div>
          <div class="row">
            <div class="col align-self-center">
              <!-- Código viejo, deprecar -->
              <?php
              $link=conectarse();
              ?>
              <script>
                function agregar() {
                  var contraseña = prompt("Ingresa tu contraseña");
                  if (contraseña) {
                    var val = valida();
                    if (val) {
                      var modificar = window.confirm("¿Generar?");
                      if (modificar) {
                        alert("Generada con exito");
                        location.href = "ver-factura.php";
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
                  //valida rfc emisor
                  try {
                    if(document.factura.rfcEmp.value==0){
                   alert('Ingresa un rfc  Emisor valido');
                   document.factura.rfcEmp.focus();
                    return false;

                 }
                  } catch (error) {
                    alert('Ingresa un rfc  Emisor valido');
                    document.factura.rfcEmisor.focus();
                    return false;

                  }
                  //valida rfc receptor
                  try {
                    if(document.factura.rfcReceptor.value==0){
                   alert('Ingresa un rfc  Receptor valido');
                   document.factura.rfcEmp.focus();
                    return false;

                 }
                  } catch (error) {
                    alert('Ingresa un rfc  Emisor valido');
                    document.factura.rfcEmisor.focus();
                    return false;

                  }



                  if(document.factura.nombreCliente.value.length == 0){
                    alert("Introduzca una persona de contacto.");
                    document.factura.contactoNombre.focus();
                    return false;
                  };
                  if(document.factura.lugar.value.length == 0){
                    alert("Introduzca un lugar.")
                    document.factura.lugar.focus();
                    return false;
                  };
                  if(document.productos.tipoPago.value == "Tarjeta" ){
                    if(document.productos.cantidadPagos.selectedIndex == 0){
                    alert("Selecciona un metodo de pago")
                    document.factura.tipoPagos.focus();
                    return false;
                  };
                  };


                  var facturaCompleta=document.getElementById("facturacompleta");
                  //agregar datos faltantes
                  var rfcEmisor=document.createElement("input");
                  rfcEmisor.name="rfcEmp";
                  rfcEmisor.value=document.getElementById('emisor').value;
                  rfcEmisor.type="hidden";
                  var rfcReceptor=document.createElement("input");
                  rfcReceptor.name="rfcRec";
                  rfcReceptor.value=document.getElementById('receptor').value;
                  rfcReceptor.type="hidden";
                  var nombreEmpresa=document.createElement('input');
                  nombreEmpresa.name="nomEmp";
                  nombreEmpresa.value=document.getElementById('nomEmp').value;
                  nombreEmpresa.type="hidden";
                  var regimen=document.createElement("input");
                  regimen.name="regimen";
                  regimen.value=document.getElementById('regFis').value;
                  regimen.type="hidden";
                  var nombreCliente=document.createElement('input');
                  nombreCliente.name="nombreCliente";
                  nombreCliente.value=document.getElementById('nombreCliente').value;
                  nombreCliente.type="hidden";
                  var direccionCliente=document.createElement('input');
                  direccionCliente.name="direccionCliente";
                  direccionCliente.value=document.getElementById('direccionCliente').value;
                  direccionCliente.type="hidden";
                  var cfdi=document.createElement('input');
                  cfdi.name="cfdi";
                  cfdi.value=document.getElementById('cfdi').value;
                  cfdi.type="hidden";
                  var lugar=document.createElement('input');
                  lugar.name="lugar";
                  lugar.value=document.getElementById('lugar').value;
                  lugar.type="hidden";




                  //agregar datos al post
                  facturaCompleta.appendChild(rfcEmisor);
                  facturaCompleta.appendChild(rfcReceptor);
                  facturaCompleta.appendChild(nombreEmpresa);
                  facturaCompleta.appendChild(regimen);
                  facturaCompleta.appendChild(nombreCliente);
                  facturaCompleta.appendChild(direccionCliente);
                  facturaCompleta.appendChild(cfdi);
                  facturaCompleta.appendChild(lugar);
                  document.productos.submit()
                  //alert("Factura generada con exito");
                  //return location.href = "ver-factura.php";
                  //return true;

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
                    document.factura.rfcEmisor.focus();
                    return false;

                  }


                  var table=document.getElementById("productos");
                  var desc=document.getElementById("desc").value;
                  if(desc=="Elegir"){
                    alert("Selecciona un servicio");
                    document.productos.desc_producto.focus()
                    return 0;
                  }
                  var dividir=desc.split("-")
                  var clave=dividir[0];
                  desc=dividir[1];
                  var um=document.getElementById("um").value;
                  if(um=="Elegir"){
                    alert("Selecciona la unidad de medida");
                    document.productos.um.focus()
                    return 0;
                  }
                  //cantidad por servicio
                  var cantidad=document.getElementById("cantidad").value;
                  if(cantidad==0){
                    alert("Ingresa la cantidad");
                    document.productos.cantidad.focus()
                    return 0;
                  }
                  var pu=document.getElementById("pu").value;
                  if(pu==0){
                    alert("Ingresa el Precio Unitario");
                    document.productos.pu.focus()
                    return 0;
                  }
                  //numero total de servicios
                  var can_productos=document.getElementById("c_productos");

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
                          t2.name = "descripcion"+index;
                          t2.value=desc;
                          t2.size=50;
                          cell2.appendChild(t2);
                      //inserta unidad de medida
                      var cell3=row.insertCell(2);
                      var t3=document.createElement("input");
                          t3.name = "um"+index;
                          t3.value=um;
                          cell3.appendChild(t3);
                      //inserta cantidad
                      var cell4=row.insertCell(3);
                      var t4=document.createElement("input");
                          t4.name = "cantidad"+index;
                          t4.value=cantidad;
                          cell4.appendChild(t4);
                      //inserta valor unitario

                      var cell5=row.insertCell(4);
                      var t5=document.createElement("input");
                          t5.name = "pu"+index;
                          t5.value=pu;
                          cell5.appendChild(t5);

                      //inserta total
                      var cell6=row.insertCell(5);
                      var t6=document.createElement("input");
                          t6.name = "total"+index;
                          t6.value=pu*cantidad;
                          cell6.appendChild(t6);

                  index++;
                  can_productos.value=index-1;

                }
                function eliminarUltimo(){
                  if(index==1){
                    return false;
                  }
                  var can_productos=document.getElementById("c_productos");

                  document.getElementById("productos").deleteRow(index);
                  can_productos.value--;
                  index--;


                }
                function Muestra(type) {
          	    	document.getElementById("meses").style.display = "block"  // Despliega div dias

                        }
                function oculta(){
                          document.getElementById("meses").style.display = "none"
                        }
              </script>
              <form action="#" method="POST" name="factura" onsubmit="">
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
                         <td><input type='text' name='rfcEmp' id='emisor' value='%s'></td>
                         <td >Rfc Receptor</td>
                         <td><input name='rfcReceptor' id='receptor' value='%s' ></td>
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
                      "<td><input type='text' name='nombre' id='nomEmp' value='$infoEmisor[0]'/></td>
                      <td><p>Régimen fiscal:</p></td>
                      <td><input type='text' name='regimen_fiscal' id='regFis' value='$infoEmisor[1]'/></td>
                      "
                    );
                    }else{
                      printf(
                        "<td><input type='text' name='nombre'/></td>
                        <td><p>Régimen fiscal:</p></td>
                        <td><input type='text' name='regimen_fiscal' /></td>
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
                     <td><input type='text' name='nombreCliente' id='nombreCliente' value='$infoCliente[0]' /></td>
                     <td>Direccion:</td>
                     <td><input type='text' name='direccionCliente' id='direccionCliente' placeholder='Direccion Receptor' size=80 value='$infoCliente[1]'></td>
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
                      <select name="cfdi" id="cfdi">
                      <?php
                        $result = mysqli_query($link, "SELECT clave,descripcion FROM f_usoscfdi");
                        while ($usos = mysqli_fetch_array($result)) {
                          $uso=$usos[0].'-'.$usos[1];
                          echo '"<option value="'.$usos[1].'">'.$uso.'</option>"';
                        }

                        ?>

                      </select>
                    </td>
                    <td><p>Lugar:</p></td>
                    <td><input type="text" name="lugar" id="lugar"/></td>
                  </tr>
                </table>
              </form>

              <form action="factura_ver.php" name="productos" method="POST" id="facturacompleta">

                <br /><br />
                <table align="center" id="productos" width="70%">
                  <tr>
                  <td>Cantidad Servicios: <input type="number" name="cproductos" id="c_productos" size="4" value="0" readonly></td>
                    <td>
                      Servicios:
                      <select name="desc_producto" id="desc">
                        <option value="Elegir">Elegir</option>
                        <?php
                        $result = mysqli_query($link, "SELECT clave,descripcion FROM f_concepto");
                        while ($descripcion = mysqli_fetch_array($result)) {
                          $desc=$descripcion[0].'-'.$descripcion[1];
                          echo '"<option value="'.$desc.'">'.$desc.'</option>"';
                        }

                        ?>

                      </select>
                    </td>
                    <td>
                      Unidad
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

                    <td>Cantidad:<input type="number" name="cantidad" id="cantidad" size=5 placeholder="Cantidad" value="0"/></td>
                    <td>Pu:<input type="number" name="pu" id="pu" id="pu" size=5 value="0" placeholder="Precio Unitario"/></td>
                    <td><input type="button" name="agregar" value="Agregar" onclick="agregarProducto()"/></td>
                    <td>Elimina Ultimo <input type="button" name="elimina" id="elimina" value="Elimina Ultimo" onclick="eliminarUltimo()"></td>
                  </tr>

                  <tr>

                    <td>Producto</td>
                    <td>Descripción</td>
                    <td>Unidad de medida</td>
                    <td>Cantidad</td>
                    <td>Precio Unitario</td>
                    <td>Total</td>

                  </tr>

                </table>

                <p>Método de pago:</p>
                <input type="radio" name="tipoPago" onClick="oculta()" checked value="Transferencia"/> Transferencia
                <input type="radio" name="tipoPago"  onClick="Muestra('meses')" value="Tarjeta"/> Tarjeta Credito/Debito
                <input type="radio" name="tipoPago" onClick="oculta()" value="Efectivo"/> Efectivo

                <span id="meses" style="display:none">
                  <p>Condición de pago:</p>
                <select name="cantidadPagos">
                <option value="0">Elegir</option>
                <option value="1">Pago Unico</option>
                  <option value="2">1 mes</option>
                  <option value="3">3 meses</option>
                  <option value="4">6 meses</option>
                </select>
                </span>

                <br /><br />
                <input type="button" value="Crear Factura" onclick="valida()"/>
                <input type="reset" value="Reiniciar" />
              </form>
              <!-- Código viejo, deprecar -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require "../comun/footer.php" ?>
  </body>
</html>

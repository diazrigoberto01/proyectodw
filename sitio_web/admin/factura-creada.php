<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Equipo 1</title>
    <script>
      function descargar(){
        alert("Su descarga comenzara en unos segundos")
      }
    </script>
  </head>
  <body>
    <?php
    $id=$_GET["id"];
    include('./comun/recursos.php'); //conectarse.php ;para el servidor propio
      $link=conectarse();
      $consulta=mysqli_query($link,"Select fecha_emision,folio,lugar_expedicion,rfc_receptor,
      rfc_emisor,importe_total,direccion_emisor,metodo_pago,cantidadPagos,uso_cfdi,subtotal,iva from f_factura where id='$id' ") or die(mysqli_error($link));
      $row = mysqli_fetch_array($consulta);
      $emisorC=mysqli_query($link,"Select razon_social,regimen_fiscal from f_empresas where rfc='$row[4]' ") or die(mysqli_error($link));
      $razonSocial = mysqli_fetch_array($emisorC);
      $cliente=mysqli_query($link,"Select razon_social,concat(calle,concat(no_exterior,concat(municipio,concat(estado,'.')))) from f_cliente where rfc='$row[3]' ") or die(mysqli_error($link));
      $info = mysqli_fetch_array($cliente);

    ?>
   <form name="factura" action="generarpdf.php" method="POST"> 
    <table align="center">
      <td><img  name="logo" src="../img/emp1.png" alt="" value="../img/emp1.png" />
        <input type="hidden" name="ubiImagen" value="../img/emp1.png">
      </td>

      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td>
        <table align="right">
          <tr>
            <td>
              Folio Fiscal:
            </td>
          </tr>
          <tr>
            <td>
              45CA32E5-BD3B-46EA-B660-D1D322416C56
            </td>
          </tr>
          <tr>
            <td>No. de Serie del Certificado del CSD:</td>
          </tr>
          <tr>
            <td>
              00001000000409461271
            </td>
          </tr>
          <tr>
            <td>Serie:A</td>
            <td>Folio:
              <?php
              echo $row[1];
              echo"<input type='hidden' name='folio' value='$row[1]' readonly>";
              ?>
                            </td>
          </tr>
          <tr>
            <td>Fecha y Hora de Emision:</td>
            <td>
              Lugar de Emision
            </td>
          </tr>

          <tr>
            <td>
            <?php
              echo $row[0];
              echo"<input type='hidden' name='fecha' value='$$row[0]' readonly>";
            ?>
            </td>
            <td>
            <?php
              echo"
               <input type='text' name='lugar' value='$row[2]' readonly>
              ";
            ?>
            </td>
          </tr>
        </table>
      </td>
    </table>

    <table align="left">
      <tr>
        <td colspan="3">
          <?php
          echo"
          <input type='text' name='emisorRFC' value='$row[4]' readonly>
          ";
          ?>
        </td>
      </tr>
      <tr>
        <td>
          Emisor:
          <?php
            echo "
            <input type='text' name='nombreEmisor' value='$razonSocial[0]' readonly>
            ";
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          Direccion:
        <?php
          echo"
          <input type='text' name='dirEmisor' size='70' value='$row[6]' readonly>
          ";
          ?>
          </td>
      </tr>

      <tr>
        <th>Metodo de Pago:</th>
        <td>
        <?php
          switch($row[7]){
            case "Tarjeta": echo"
            <input type='text' name='tipoPago' value='$row[7]' readonly>
            ";
          break;
          case "Transferencia": echo"
            <input type='text' name='tipoPago' value='$row[7]' readonly>
            ";
          break;
          case "Efectivo": echo"
            <input type='text' name='tipoPago' value='$row[7]' readonly>
            ";
          break;


          }
          
          ?>




        </td>
        <th>
          Forma de Pago:
        </th>
        <td>
        <?php
          echo"
          <input type='text' name='formaPago' value='$row[7]' readonly>
          ";
          ?>
        </td>
        <th>Moneda:</th>
        <td>Peso Mexicano MXN</td>
      </tr>
      <tr>
        <th>Condicion de Pago:</th>
        <td>
          <?php
            switch($row[8]){
              case "Pago Unico": echo"
                <input type='text' name='cantidadPagos' value='Pago unico' readonly>
                ";
                break;

              case "Pago Unico": echo"
              <input type='text' name='cantidadPagos' value='Pago unico' readonly>
              ";
              break;
              case "1 mes": echo"
              <input type='text' name='cantidadPagos' value='1 mes' readonly>
              ";
              break;
              case "3 meses": echo"
                <input type='text' name='cantidadPagos' value='3 meses' readonly>
              ";
              break;
              case "6 meses": echo"
              <input type='text' name='cantidadPagos' value='6 meses' readonly>
              ";
              break;
              }
            ?>
        </td>
        <th>Regimen Fiscal:</th>
        <td> <?php
          echo"
          <input type='text' name='regimen' value='$razonSocial[1]' readonly>
          ";
          ?></td>
      </tr>
      <tr>
        <td colspan="6">
          --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        </td>
      </tr>
    </table>

    <table>
      <tr>
        <td colspan="4">Facturado a (receptor):
        <?php
          echo"
          <input type='text' name='receptorRFC' value='$row[3]' readonly>
          ";
          ?>
           </td>
      </tr>
      <tr>
        <td colspan="4">
        <?php
          echo"
          <input type='text' name='nombreCliente' size='35' value='$info[0]' readonly>
          ";
          ?>
          
        </td>
      </tr>
      <tr>
        <td colspan="4">
          Residencia Fiscal: 
        <?php
          echo"
          <input type='text' name='dirCliente'  size='75' value='$info[1]' readonly>
          ";
          ?>
        </td>
      </tr>
      <tr>
        <th>Uso de CFDI:</th>
        <td>
        <?php
          echo"
          <input type='text' name='cfdi' size='70' value='$row[9]' readonly>
          ";
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        </td>
      </tr>
      
    </table>
    
  <table align="center">
      <tr>
        <th>Clave &nbsp;</th>
        <th>Descripcion &nbsp;</th>
        <th>Unidad &nbsp;</th>
        <th>Precio Unitario &nbsp;</th>
        <th>Cantidad &nbsp;</th>
        <th>Importe</th>
      </tr>
    <!-- PARTE dinamica -->

        <?php
       $servicios=mysqli_query($link,"Select concepto_clave,concepto_descripcion,concepto_um,concepto_pu,
       concepto_cantidad,concepto_subtotal from f_concepto_facturado where factura_folio='$row[1]'") or die(mysqli_error($link));
       while ($servicio = mysqli_fetch_array($servicios)) {
        printf('<tr>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%d</td>
        <td>%d</td>
        <td>%d</td

        </tr>',$servicio[0], $servicio[1], $servicio[2], $servicio[3], $servicio[4],$servicio[5]);
      }
          
        ?>
        <tr></tr>
        <tr></tr>
        <tr>
        <td colspan="6">
        <table align="right">
            <tr>
              <td>
                Subtotal:
              </td>
              <td>
              <?php
          echo"
          <input type='text' name='subtotal' size=10 value='$row[10]' readonly>
          ";
          ?>
              </td>

            </tr>
            <tr>
              <td>
                +IVA(16%):
              </td>
              <td>
              <?php
              
          echo"
          <input type='text' name='iva' size=10 value='$row[11]' readonly>
          ";
          ?>
              </td>
            </tr>
            <tr>
              <td>Total:</td>
              <td>
              <?php
                echo "
                <input type='text' name='totalmasiva' size=10 value='$row[5]' readonly>
                ";
              ?>
              </td>
            </tr>
        
        <tr>
          <td>
            <input type="hidden" name="totalproductos" value="<?php  echo $totalProductos ?>">
            <input type="button" value="Descargar" onclick="descargar()" >
          </td>
          <td>
          <input type="button" value="Regresar" onclick="history.go(-1)">
          </td>
        </tr>

          </table>
        </td>

        </tr>
  </table>
         
        
  </form>
   <?php
   mysqli_close($link);
   ?>
    
  </body>
</html>
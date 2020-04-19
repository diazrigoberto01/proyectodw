<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Ver-Factura</title>

    <script>
      function descargar(){
        alert("Su descarga comenzara en unos segundos")
      }
    </script>
  </head>
  <body>
    <?php
    include "../comun/conexion.php";
    $link=Conectarse();

   
    //datos de la factura

      //datos del emisor
      $rfcEmisor=$_POST["rfcEmp"];
      $rfcReceptor=$_POST["rfcRec"];
      $nombreEmpresa=$_POST["nomEmp"];
      $regimen=$_POST["regimen"];
      $nombreCliente=$_POST["nombreCliente"];
      $direccionCliente=$_POST["direccionCliente"];
      $cfdi=$_POST["cfdi"];
      $fecha=date("Y-m-d H:i:s");
      $lugar=$_POST["lugar"];
      $totalProductos=$_POST["cproductos"];
      $tipoPago=$_POST["tipoPago"];
      $cantidadPagos=$_POST["cantidadPagos"];
      $dire=mysqli_query($link,"SELECT calle FROM f_direccion_empresa where empresa_rfc='$rfcEmisor' ") or die(mysqli_error($link));
      $info=mysqli_fetch_array($dire);
      
  
      
      //datos del receptor


    //Para imprimir tabla de productos
    /*
     
      echo "$totalProductos";
      
      
      
      */
      
    
    
    ?>
    <table align="center">
      <td><img src="../img/emp1.png" alt="" /></td>

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
            <td>Folio:345</td>
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
          echo" $fecha";
          ?>
            </td>
            <td>
            <?php
          echo"
          <input type='text' name='fecha' value='$lugar' readonly>
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
          <input type='text' name='emisoRFC' value='$rfcEmisor' readonly>
          ";
          ?>
        </td>
      </tr>
      <tr>
        <td>
          Emisor:
        <?php
          echo"
          <input type='text' name='nombreEmisor' value='$nombreEmpresa' readonly>
          ";
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="6">
        <?php
          echo"
          <input type='text' name='nombreEmisor' size='70' value='$info[0]' readonly>
          ";
          ?>
          </td>
      </tr>
      <tr>
        <th>Metodo de Pago:</th>
        <td>
        <?php
          switch($tipoPago){
            case "Tarjeta": echo"
            <input type='text' name='fecha' value='$tipoPago' readonly>
            ";
          break;
          case "Tranferencia": echo"
            <input type='text' name='fecha' value='$tipoPago' readonly>
            ";
          break;
          case "Efectivo": echo"
            <input type='text' name='fecha' value='$tipoPago' readonly>
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
          <input type='text' name='fecha' value='$tipoPago' readonly>
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
  switch($cantidadPagos){
    case 1: echo"
      <input type='text' name='nombreEmisor' value='Pago unico' readonly>
      ";
      break;
    case 2: echo"
      <input type='text' name='nombreEmisor' value='1 mes' readonly>
      ";
    break;
    case 3: echo"
    <input type='text' name='nombreEmisor' value='3 meses' readonly>
    ";
    break;
    case 4: echo"
    <input type='text' name='nombreEmisor' value='6 meses' readonly>
    ";
  break;
  }
?>
        </td>
        <th>Regimen Fiscal:</th>
        <td> <?php
          echo"
          <input type='text' name='regimen' value='$regimen' readonly>
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
          <input type='text' name='receptorRFC' value='$rfcReceptor' readonly>
          ";
          ?>
           </td>
      </tr>
      <tr>
        <td colspan="4">
        <?php
          echo"
          <input type='text' name='receptorRFC' size='35' value='$nombreCliente' readonly>
          ";
          ?>
          
        </td>
      </tr>
      <tr>
        <td colspan="4">
          Residencia Fiscal: 
        <?php
          echo"
          <input type='text' name='receptorRFC'  size='75' value='$direccionCliente' readonly>
          ";
          ?>
        </td>
      </tr>
      <tr>
        <th>Uso de CFDI:</th>
        <td>
        <?php
          echo"
          <input type='text' name='fecha'size='70' value='$cfdi' readonly>
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
      for($i=1; $i<=$totalProductos; $i++){
          $num=strval($i);
          $clave="clave".$num;
          $desc="descripcion".$num;
          $clave=$_POST[$clave];
          $des=$_POST[$desc];
          $um="um".$num;
          $cantidad="cantidad".$num;
          $pu="pu".$num;
          $total="total".$num;
          $um=$_POST[$um];
          $cantidad=$_POST[$cantidad];
          $pu=$_POST[$pu];
          $total=$_POST[$total];

          printf("<tr>
          <td>%s</td>
          <td>%s</td>
          <td>%s</td>
          <td>%s</td>
          <td>%s</td>
          <td>$total</td>
  
          </tr>
   
          ",$clave,$des,$um,$pu,$cantidad);
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
                $30,000
              </td>

            </tr>
            <tr>
              <td>
                Subtotal Neto:
              </td>
              <td>
                $30,000
              </td>
            </tr>
            <tr>
              <td>
                +IVA(16%):
              </td>
              <td>
                $4,800
              </td>
            </tr>
            <tr>
              <td>Total:</td>
              <td>$34,800</td>
            </tr>
        <tr>
        <td>Treinta y cuatro mil ochocientos pesos MXN</td>
        </tr>
        <tr>
          <td>
            <input type="button" value="Descargar" onclick="descargar()">
          </td>
          <td>
          <input type="button" value="Regresar" onclick="history.go(-1)">
          </td>
        </tr>

          </table>
        </td>

        </tr>
  </table>
         
        

   <?php
   mysqli_close($link);
   ?>
    
  </body>
</html>

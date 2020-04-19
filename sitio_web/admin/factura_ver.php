<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Ver-Factura</title>

    <script>
      function descargar(){
        alert("Su descarga comenzara en unos segundos")
        document.factura.submit();
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
      $fecha=date("Y-m-d");
      $lugar=$_POST["lugar"];
      $totalProductos=$_POST["cproductos"];
      $tipoPago=$_POST["tipoPago"];
      $cantidadPagos=$_POST["cantidadPagos"];
      $dire=mysqli_query($link,"SELECT calle FROM f_direccion_empresa where empresa_rfc='$rfcEmisor' ") or die(mysqli_error($link));
      $info=mysqli_fetch_array($dire);
      $subtotal=0;
      
  
      
      //datos del receptor


    //Para imprimir tabla de productos
    /*
     
      echo "$totalProductos";
      
      
      
      */
      
    
    
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
              echo $fecha;
              echo"<input type='hidden' name='fecha' value='$fecha' readonly>";
            ?>
            </td>
            <td>
            <?php
              echo"
               <input type='text' name='lugar' value='$lugar' readonly>
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
          <input type='text' name='emisorRFC' value='$rfcEmisor' readonly>
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
          Direccion:
        <?php
          echo"
          <input type='text' name='dirEmisor' size='70' value='$info[0]' readonly>
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
            <input type='text' name='tipoPago' value='$tipoPago' readonly>
            ";
          break;
          case "Transferencia": echo"
            <input type='text' name='tipoPago' value='$tipoPago' readonly>
            ";
          break;
          case "Efectivo": echo"
            <input type='text' name='tipoPago' value='$tipoPago' readonly>
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
          <input type='text' name='formaPago' value='$tipoPago' readonly>
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
              case 0: echo"
                <input type='text' name='cantidadPagos' value='Pago unico' readonly>
                ";
                break;

              case 1: echo"
              <input type='text' name='cantidadPagos' value='Pago unico' readonly>
              ";
              break;
              case 2: echo"
              <input type='text' name='cantidadPagos' value='1 mes' readonly>
              ";
              break;
              case 3: echo"
                <input type='text' name='cantidadPagos' value='3 meses' readonly>
              ";
              break;
              case 4: echo"
              <input type='text' name='cantidadPagos' value='6 meses' readonly>
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
          <input type='text' name='nombreCliente' size='35' value='$nombreCliente' readonly>
          ";
          ?>
          
        </td>
      </tr>
      <tr>
        <td colspan="4">
          Residencia Fiscal: 
        <?php
          echo"
          <input type='text' name='dirCliente'  size='75' value='$direccionCliente' readonly>
          ";
          ?>
        </td>
      </tr>
      <tr>
        <th>Uso de CFDI:</th>
        <td>
        <?php
          echo"
          <input type='text' name='cfdi' size='70' value='$cfdi' readonly>
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
          $claven="clave".$num;
          $descn="descripcion".$num;
          $clave=$_POST[$claven];
          $des=$_POST[$descn];
          $umn="um".$num;
          $cantidadn="cantidad".$num;
          $pun="pu".$num;
          $totaln="total".$num;
          $um=$_POST[$umn];
          $cantidad=$_POST[$cantidadn];
          $pu=$_POST[$pun];
          $total=$_POST[$totaln];

          printf("<tr>
          <td><input name='$claven' value='$clave' readonly></td>
          <td><input name='$descn' value='$des' size=60 reandonly></td>
          <td><input name='$umn' value='$um' reandonly></td>
          <td><input name='$pun' value='$pu' reandonly></td>
          <td><input name='$cantidadn' value='$cantidad' reandonly></td>
          <td><input name='$totaln' value='$total' reandonly></td>
  
          </tr>
   
          ");
          $subtotal=$subtotal+$total;
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
          <input type='text' name='subtotal' size=10 value='$subtotal' readonly>
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
              $ivapc=$subtotal*0.16;
          echo"
          <input type='text' name='iva' size=10 value='$ivapc' readonly>
          ";
          ?>
              </td>
            </tr>
            <tr>
              <td>Total:</td>
              <td>
              <?php
              $totalmasiva=$subtotal+$ivapc;
          echo"
          <input type='text' name='totalmasiva' size=10 value='$totalmasiva' readonly>
          ";
          ?>
              </td>
            </tr>
        
        <tr>
          <td>
            <input type="hidden" name="totalproductos" value="<?php  echo $totalProductos ?>">
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
         
        
  </form>
   <?php
   mysqli_close($link);
   ?>
    
  </body>
</html>

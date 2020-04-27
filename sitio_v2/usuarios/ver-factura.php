<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  if (!isset($_SESSION['tipo_usuario'])) {
    header("Location: no-autorizado.php");
    die();
  }
?>
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
    include "../comun/recursos.php";
    $link=conectarse();

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
      $buscarfolio=mysqli_query($link,"Select folio from f_factura order by folio desc limit 1") or die(mysqli_error($link));
      $folio=mysqli_fetch_array($buscarfolio);
      $folio[0]=$folio[0]+1;
      $subtotal=0;


    ?>
    <form name="factura" action="generarpdf.php" method="POST">
<div class="container-fluid mt-8">


    <!--Encabezado Factura-->
    <div class="col-md-12 row justify-content-center ">
      <div class=col-md-5>
        <img  name="logo" src="../img/mezclas.png" alt="" value="../img/mezclas.png" width="40%" heigth="auto" />
        <input type="hidden" name="ubiImagen" value="../img/mezclas.png">
      </div>
      <div class="col-md-5">
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
              echo $folio[0];
              echo"<input type='hidden'  name='folio' value='$folio[0]' readonly>";
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
              echo $fecha;
              echo"<input type='hidden' name='fecha' value='$fecha' readonly>";
            ?>
            </td>
            <td>
            <?php
              echo"
               <input type='text' class='form-control' name='lugar' value='$lugar' readonly>
              ";
            ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  <!--Encabezado Emisor-->
  <div class="container-fluid">
    <div class="col-md-12 row">
      <div class="col-md-4">
          <?php
          echo"
          <input type='text' class='form-control' name='emisorRFC' value='$rfcEmisor' readonly>
          ";
          ?>
      </div>
    </div>

      <div class="col-md-12 row ">
        <div class="col-md-4">
          Emisor:
          <?php
            echo"
            <input type='text' name='nombreEmisor' class='form-control' value='$nombreEmpresa' readonly>
            ";
          ?>
        </div>
      </div>

      <div class="col-md-12 row">
        <div class="col-md-6">
          Direccion:
        <?php
          echo"
          <input type='text'  class='form-control' name='dirEmisor' size='70' value='$info[0]' readonly>
          ";
          ?>
          </div>
      </div>

      <div class="col-md-12 row mt-2">
        <div class="col-md-2">Metodo de Pago:</div>
        <div class="col-md-2">
        <?php
          switch($tipoPago){
            case "Tarjeta": echo"
            <input type='text' name='tipoPago' class='form-control'  value='$tipoPago' readonly>";
            break;
            case "Transferencia": echo"
            <input type='text' name='tipoPago' class='form-control' value='$tipoPago' readonly>";
            break;
            case "Efectivo": echo"
            <input type='text' name='tipoPago' class='form-control' value='$tipoPago' readonly>";
            break;
            }

          ?>
        </div>
        <div class="col-md-2">
          Forma de Pago:
        </div>
        <div class="col-md-2">
        <?php
          echo"
          <input type='text' name='formaPago' class='form-control' value='$tipoPago' readonly>";
          ?>
        </div>
        <div class="col-md-2">Moneda:</div>
        <div class="col-md-2">Peso Mexicano MXN</div>
      </div>

      <div class="col-md-12 row mt-2">
        <div class="col-md-2">Condicion de Pago:</div>
        <div class="col-md-4">
          <?php
            switch($cantidadPagos){
              case 0: echo"
                <input type='text'  class='form-control' name='cantidadPagos' value='Pago unico' readonly>
                ";
                break;

              case 1: echo"
              <input type='text'  class='form-control' name='cantidadPagos' value='Pago unico' readonly>
              ";
              break;
              case 2: echo"
              <input type='text' class='form-control' name='cantidadPagos' value='1 mes' readonly>
              ";
              break;
              case 3: echo"
                <input type='text' class='form-control' name='cantidadPagos' value='3 meses' readonly>
              ";
              break;
              case 4: echo"
              <input type='text' class='form-control' name='cantidadPagos' value='6 meses' readonly>
              ";
              break;
              }
            ?>
        </div>
        <div class="col-md-2">Regimen Fiscal:</div>
        <div class="col-md-4">
          <?php
          echo "<input type='text' class='form-control' name='regimen' value='$regimen' readonly>";
          ?>
        </div>
      </div>

      <div class="col-md-12 row">
            <hr width="100%" style="color: #000">
      </div>
  </div>

  <!--Encabezado Receptor-->
  <div class="container-fluid">

      <div class="col-md-12 row">
        <div class="col-md-4">Facturado a (receptor):
          <?php
          echo"<input type='text' class='form-control' name='receptorRFC' value='$rfcReceptor' readonly>";
          ?>
        </div>
      </div>

      <div class="col-md-12 row">
        <div class="col-md-4 ">
          Facturado a:
          <?php
          echo "<input type='text' class='form-control' name='nombreCliente' size='35' value='$nombreCliente' readonly>";
          ?>

        </div>
      </div>

      <div class="col-md-12 row">
        <div  class="col-md-4">
          Residencia Fiscal:
          <?php echo "<input type='text'  class='form-control' name='dirCliente'  size='75' value='$direccionCliente' readonly>";
          ?>
        </div>
      </div>

      <div class="col-md-12 row">
        <div class="col-md-4">Uso de CFDI:</div>
        <div class="col-md-8">
          <?php
            echo "<input type='text'  class='form-control' name='cfdi' size='70' value='$cfdi' readonly>";?>
        </div>
      </div>

      <div class="col-md-12 row">
            <hr width="100%" style="color: #000">
      </div>
  </div>


    <div class="container-fluid">
      <div class="col-md-12 row justify-content-center">
        <div class="col-md-1">Clave &nbsp;</div>
        <div class="col-md-4">Descripcion &nbsp;</div>
        <div class="col-md-1">Unidad &nbsp;</div>
        <div class="col-md-2">Precio Unitario &nbsp;</div>
        <div class="col-md-2">Cantidad &nbsp;</div>
        <div class="col-md-2">Importe</div>
      </div>
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

          printf("
          <div class='col-md-12 row'>
            <div class='col-md-1 form-control'><input type='hidden' name='$claven' value='$clave' readonly>$clave</div>
            <div class='col-md-4 form-control'><input type='hidden' name='$descn' value='$des' readonly>$des</div>
            <div class='col-md-1 form-control'><input type='hidden' name='$umn' value='$um' reandonly>$um</div>
            <div class='col-md-2 form-control'><input type='hidden' name='$pun' value='$pu' reandonly>$pu</div>
            <div class='col-md-2 form-control'><input type='hidden' name='$cantidadn' value='$cantidad' reandonly>$cantidad</div>
            <div class='col-md-2 form-control'><input type='hidden' name='$totaln' value='$total' reandonly>$total</div>

          </div>

          ");
          $subtotal=$subtotal+$total;
          }
        ?>
        <div class='col-md-12 row'></div>
        <div class='col-md-12 row'></div>
        <div class="col-md-12 row justify-content-end ">
          <div class="col-md-6" >
            <!--Parte final Factura-->
            <div class="container-fluid  mt-4" >

              <div class="col-md-12 row justify-content-end mt-2" >
                <div class="col-md-3">
                  Subtotal:
                </div>
                <div class="col-md-3">
                  <?php
                    echo"
                    <input type='text' class='form-control' name='subtotal' size=10 value='$subtotal' readonly>";
                  ?>
                </div>
              </div>


              <div class="col-md-12 row justify-content-end mt-2">
                <div class="col-md-3">
                  +IVA(16%):
                </div>
                <div class="col-md-3">
                  <?php
                    $ivapc=$subtotal*0.16;
                    echo"<input type='text'  class='form-control' name='iva' size=10 value='$ivapc' readonly>";
                    ?>
                </div>
              </div>


              <div class="col-md-12 row justify-content-end mt-2">
                <div class="col-md-3">Total:</div>
                <div class="col-md-3">
                  <?php
                    $totalmasiva=$subtotal+$ivapc;
                  echo"<input type='text'  class='form-control' name='totalmasiva' size=10 value='$totalmasiva' readonly>";
                  ?>
                </div>
              </div>

            <div class="col-md-12 row justify-content-end mt-2">
              <div class="col-md-3">
                <input type="hidden" name="totalproductos" value="<?php  echo $totalProductos ?>">
                <input type="hidden" name="nueva" value="si">
                <input type="button" class="btn btn-success" value="Descargar" onclick="descargar()" >
              </div>
              <div class="col-md-3">
                  <input type="button" value="Regresar" class="btn btn-warning" onclick="history.go(-1)">
              </div>
          </div>




        </div>

        </div>
      </div>



    </div>
</div>

    </form>
    <?php
    mysqli_close($link);
    ?>

  </body>
</html>

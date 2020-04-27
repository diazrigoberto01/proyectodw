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
    <title>Equipo 1</title>
    <script>
      function descargar(){
        alert("Su descarga comenzara en unos segundos")
      }
    </script>
  </head>
  <body>
    <?php
      $nivel = 1;
      require "../comun/recursos.php";
      $id=$_GET["id"];
      $link=conectarse();
      $consulta=mysqli_query($link,"Select fecha_emision,folio,lugar_expedicion,rfc_receptor,
      rfc_emisor,importe_total,direccion_emisor,metodo_pago,cantidadPagos,uso_cfdi,subtotal,iva from f_factura where folio='$id' ") or die(mysqli_error($link));
      $row = mysqli_fetch_array($consulta);
      //echo $row[4];
      $emisorC=mysqli_query($link,"Select razon_social,regimen_fiscal from f_empresas where rfc='$row[4]' ") or die(mysqli_error($link));
      $razonSocial = mysqli_fetch_array($emisorC);
      $cliente=mysqli_query($link,"Select razon_social,concat(calle,concat(',',concat(no_exterior,concat(municipio,concat(estado,'.'))))) from f_cliente where rfc='$row[3]' ") or die(mysqli_error($link));
      $info = mysqli_fetch_array($cliente);

    ?>
    <div class="container-fluid">
    <form name="factura" action="generarpdf.php" method="POST">
            <!-- Encabezado factura-->
            <div class="col-md-10 row justify-content-center">
                <div class="col-md-5">
                    <img  name="logo" src="../img/mezclas.png" alt="" value="../img/mezclas.png" width="40%" heigth="auto"/>
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
                                    echo $row[1];
                                    echo "<input type='hidden' name='folio' value='$row[1]' readonly>";
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
                            <input type='text' class='form-control' name='lugar' value='$row[2]' readonly>";
                            ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        <!-- Encabezado Emisor-->
    <div class="container-fluid">

        <div class="col-md-12 row">
            <div class="col-md-4">
                <?php
                echo"<input type='text' class='form-control' name='emisorRFC' value='$row[4]' readonly>";
                ?>
            </div>
        </div>
        <div class="col-md-12 row">
            <div class="col-md-4">
                Emisor:
                <?php
                    echo "
                    <input type='text' class='form-control' name='nombreEmisor' value='$razonSocial[0]' readonly>
                    ";
                ?>
            </div>
        </div>
        <div class="col-md-12 row">
            <div class="col-md-6">
                Direccion:
                <?php
                echo"
                <input type='text' class='form-control' name='dirEmisor' size='70' value='$row[6]' readonly>";
                ?>
            </div>
        </div>

        <div class="col-md-12 row mt-2">
            <div class="col-md-2 ">Metodo de Pago:</div>
                <div class="col-md-2 ">
                    <?php
                    switch($row[7]){
                    case "Tarjeta": echo"
                     <input type='text' class='form-control' name='tipoPago' value='$row[7]' readonly>";
                         break;
                    case "Transferencia": echo"
                        <input type='text' class='form-control' name='tipoPago' value='$row[7]' readonly>";
                     break;
                    case "Efectivo": echo"
                     <input type='text' class='form-control' name='tipoPago' value='$row[7]' readonly>";
                       break;
                    }
                    ?>
                </div>
             <div class="col-md-2 ">
                Forma de Pago:
                </div>
            <div class="col-md-2 ">
                <?php
                    echo"
                    <input type='text' class='form-control' name='formaPago' value='$row[7]' readonly> ";
                ?>
            </div>
            <div class="col-md-2 ">
                Moneda:</div>
            <div class="col-md-2 ">Peso Mexicano MXN</div>
        </div>
        <div class="col-md-12 row mt-2">
                <div class="col-md-2">Condicion de Pago:</div>
                <div class="col-md-4">
                    <?php
                    switch($row[8]){
                    case "Pago Unico": echo"
                        <input type='text' name='cantidadPagos' class='form-control' value='Pago unico' readonly>";
                        break;
                    case "Pago Unico": echo"
                        <input type='text' name='cantidadPagos' class='form-control'  value='Pago unico' readonly>";
                        break;
                    case "1 mes": echo"
                        <input type='text' name='cantidadPagos' class='form-control' value='1 mes' readonly>";
                        break;
                    case "3 meses": echo"
                        <input type='text' name='cantidadPagos' class='form-control' value='3 meses' readonly>";
                        break;
                    case "6 meses": echo"
                        <input type='text' name='cantidadPagos' class='form-control' value='6 meses' readonly>";
                        break;
                        }
                        ?>
                </div>
                <div class="col-md-6">Regimen Fiscal:
                <?php
                    echo"<input type='text' class='form-control' name='regimen' value='$razonSocial[1]' readonly>";
                    ?>
                </div>

        </div>
        <div class="col-md-12 row">
            <hr width="100%" style="color: #000">
        </div>
    </div>

<!-- Encabezado Receptor-->
<div class="container-fluid">
    <div class="col-md-12 row">
        <div class="col-md-4">Facturado a (receptor):
            <?php
                echo"
                <input type='text' class='form-control' name='receptorRFC' value='$row[3]' readonly>";
            ?>
        </div>
    </div>

      <div class="col-md-12 row">
        <div class="col-md-4">
            Facturado a:
        <?php
          echo"
          <input type='text'  class='form-control' name='nombreCliente' size='35' value='$info[0]' readonly>
          ";
          ?>

        </div>
    </div>
      <div class="col-md-12 row">
        <div class="col-md-6">
          Residencia Fiscal:
        <?php
          echo"
          <input type='text' name='dirCliente' class='form-control' size='75' value='$info[1]' readonly>
          ";
          ?>
        </div>
    </div>
      <div class="col-md-12 row">
        <div class="col-md-6">
        Uso de CFDI:
        <?php
          echo"
          <input type='text'  class='form-control' name='cfdi' size='70' value='$row[9]' readonly>
          ";
          ?>
        </div>
    </div>
    <div class="col-md-12 row">
      <hr width="100%" style="color: #000">
    </div>

</div>

    <div class=" container-fluid " >
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
       $servicios=mysqli_query($link,"Select concepto_clave,concepto_descripcion,concepto_um,concepto_pu,
       concepto_cantidad,concepto_subtotal from f_concepto_facturado where factura_folio='$row[1]'") or die(mysqli_error($link));
       while ($servicio = mysqli_fetch_array($servicios)) {
        printf('<div class="col-md-12 row">
        <div class="col-md-1 form-control">%s</div>
        <div class="col-md-4 form-control">%s</div>
        <div class="col-md-1 form-control">%s</div>
        <div class="col-md-2 form-control">%d</div>
        <div class="col-md-2 form-control">%d</div>
        <div class="col-md-2 form-control">$%d</div>

        </div>',$servicio[0], $servicio[1], $servicio[2], $servicio[3], $servicio[4],$servicio[5]);
      }

        ?>
        <div class="col-md-12"></div>
        <div class="col-md-12"></div>
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
                            <input type='text' class='form-control' name='subtotal' size=10 value='$row[10]' readonly>
                        ";
                        ?>
                    </div>
                    </div>

                    <div class="col-md-12 row justify-content-end mt-2">
                    <div class="col-md-3">
                        +IVA(16%):
                    </div>
                    <div class="col-md-3">
                        <?php

                        echo"
                        <input type='text' class='form-control' name='iva' size=10 value='$row[11]' readonly>
                        ";
                        ?>
                    </div>
                    </div>

                    <div class="col-md-12 row justify-content-end mt-2">
                    <div class="col-md-3">Total:</div>
                    <div class="col-md-3">
              <?php
                echo "
                <input type='text' name='totalmasiva' class='form-control' size=10 value='$row[5]' readonly>
                ";
              ?>
              </div>
    </div>

    <div class="col-md-12 row justify-content-end mt-2">
    <div class="col-md-3">
            <input type="hidden" name="totalproductos" value="<?php  echo $row[5] ?>">
            <input type="button" class='btn-success' value="Descargar" onclick="descargar()" >
    </div>
    <div class="col-md-3">
                    <input type="button" class='btn-warning' value="Regresar" onclick="history.go(-1)">
    </div>
    </div>


    </div>

    </div>
    </div>


    </form>
</div>

   <?php
   mysqli_close($link);
   ?>

  </body>
</html>

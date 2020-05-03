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
    $nivel = 1;
    include "../comun/recursos.php";
    $link=conectarse();

    //datos de la factura
    //identificar si es post(nuevafactura) o get(factura anterior)
      if(!isset($_GET['id'])){
        //echo "POST";
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
        $buscarfolio=mysqli_query($link,"SELECT folio FROM f_factura order by folio desc limit 1") or die(mysqli_error($link));
        $folio=mysqli_fetch_array($buscarfolio);
        $folio[0]=$folio[0]+1;
        $subtotal=0;
      }
      if(isset($_GET['id'])){
        //echo "GET";
        $nivel = 1;
        $id=$_GET["id"];
        $consulta=mysqli_query($link,"SELECT fecha_emision,folio,lugar_expedicion,rfc_receptor,
        rfc_emisor,importe_total,direccion_emisor,metodo_pago,cantidadPagos,uso_cfdi,subtotal,iva,status FROM f_factura where folio='$id' ") or die(mysqli_error($link));
        $row = mysqli_fetch_array($consulta);
        //echo $row[4];
        $emisorC=mysqli_query($link,"SELECT razon_social,regimen_fiscal,logo FROM f_empresas where rfc='$row[4]' ") or die(mysqli_error($link));
        $razonSocial = mysqli_fetch_array($emisorC);
        $cliente=mysqli_query($link,"SELECT razon_social,concat(calle,concat(',',concat(no_exterior,concat(municipio,concat(estado,'.'))))) FROM f_cliente where rfc='$row[3]' ") or die(mysqli_error($link));
        $info = mysqli_fetch_array($cliente);
      }




    ?>
    <form name="factura" action="generarpdf.php" method="POST">
<div class="container-fluid mt-8">


    <!--Encabezado Factura-->
    <div class="col-md-12 row justify-content-center ">
      <div class=col-md-5>
        <img  name="logo" src="<? echo $razonSocial['logo'] ?>" alt="Logo <?php echo $razonSocial['razon_social'] ?>" width="60px" heigth="auto" />
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
              if(!isset($_GET['id'])){
                echo $folio[0];
                echo"<input type='hidden'  name='folio' value='$folio[0]' readonly>";
              }elseif(isset($_GET)){
                echo $row[1];
                echo "<input type='hidden' name='folio' value='$row[1]' readonly>";

              }

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
            if(!isset($_GET['id'])){
              echo $fecha;
              echo"<input type='hidden' name='fecha' value='$fecha' readonly>";

            }elseif(isset($_GET)){
              echo $row[0];
              echo"<input type='hidden' name='fecha' value='$row[0]' readonly>";
            }

            ?>
            </td>
            <td>
            <?php
            if(!isset($_GET['id'])){
              echo"
               <input type='text' class='form-control' name='lugar' value='$lugar' readonly>
              ";
            }elseif(isset($_GET)){
              echo"
              <input type='text' class='form-control' name='lugar' value='$row[2]' readonly>";

            }

            ?>
            </td>
            <?php
              if(isset($_GET['id'])){
                if($row[12]== 0){
                  printf("<td>

                  <button type='button' class='btn btn-danger' disable>Cancelada</button>
                  </td>");
                }
              }

              ?>
          </tr>
        </table>
      </div>
    </div>
  <!--Encabezado Emisor-->
  <div class="container-fluid">
    <div class="col-md-12 row">
      <div class="col-md-4">
          <?php
          if(!isset($_GET['id'])){
            echo"
          <input type='text' class='form-control' name='emisorRFC' value='$rfcEmisor' readonly>
          ";
          }elseif(isset($_GET)){
            echo"<input type='text' class='form-control' name='emisorRFC' value='$row[4]' readonly>";
          }

          ?>
      </div>
    </div>

      <div class="col-md-12 row ">
        <div class="col-md-4">
          Emisor:
          <?php
          if(!isset($_GET['id'])){
            echo"
            <input type='text' name='nombreEmisor' class='form-control' value='$nombreEmpresa' readonly>
            ";

          }elseif(isset($_GET)){
            echo "
            <input type='text' class='form-control' name='nombreEmisor' value='$razonSocial[0]' readonly>
            ";
          }

          ?>
        </div>
      </div>

      <div class="col-md-12 row">
        <div class="col-md-6">
          Direccion:
        <?php
        if(!isset($_GET['id'])){
          echo"
          <input type='text'  class='form-control' name='dirEmisor' size='70' value='$info[0]' readonly>
          ";

        }elseif(isset($_GET)){
          echo"
          <input type='text' class='form-control' name='dirEmisor' size='70' value='$row[6]' readonly>";
        }

          ?>
          </div>
      </div>

      <div class="col-md-12 row mt-2">
        <div class="col-md-2">Metodo de Pago:</div>
        <div class="col-md-2">
        <?php
        if(!isset($_GET['id'])){
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

        }elseif(isset($_GET)){
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
        }


          ?>
        </div>
        <div class="col-md-2">
          Forma de Pago:
        </div>
        <div class="col-md-2">
        <?php
        if(!isset($_GET['id'])){
          echo"
          <input type='text' name='formaPago' class='form-control' value='$tipoPago' readonly>";

        }elseif(isset($_GET)){

          echo "<input type='text' class='form-control' name='formaPago' value='$row[7]' readonly> ";
        }

          ?>
        </div>
        <div class="col-md-2">Moneda:</div>
        <div class="col-md-2">Peso Mexicano MXN</div>
      </div>

      <div class="col-md-12 row mt-2">
        <div class="col-md-2">Condicion de Pago:</div>
        <div class="col-md-4">
          <?php
          if(!isset($_GET['id'])){
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
              default:
              echo"<input type='text' name='cantidadPagos' class='form-control' value='Pago unico' readonly>";
              }

          }elseif(isset($_GET)){
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
              default:
              echo"<input type='text' name='cantidadPagos' class='form-control' value='Pago unico' readonly>";
                  }

          }

            ?>
        </div>
        <div class="col-md-2">Regimen Fiscal:</div>
        <div class="col-md-4">
          <?php
          if(!isset($_GET['id'])){
            echo "<input type='text' class='form-control' name='regimen' value='$regimen' readonly>";
          }elseif(isset($_GET)){
            echo"<input type='text' class='form-control' name='regimen' value='$razonSocial[1]' readonly>";
          }

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
          if(!isset($_GET['id'])){
            echo"<input type='text' class='form-control' name='receptorRFC' value='$rfcReceptor' readonly>";
          }elseif(isset($_GET)){
            echo"
            <input type='text' class='form-control' name='receptorRFC' value='$row[3]' readonly>";

          }

          ?>
        </div>
      </div>

      <div class="col-md-12 row">
        <div class="col-md-4 ">
          Facturado a:
          <?php
          if(!isset($_GET['id'])){
            echo "<input type='text' class='form-control' name='nombreCliente' size='35' value='$nombreCliente' readonly>";

          }elseif(isset($_GET)){
            echo"
            <input type='text'  class='form-control' name='nombreCliente' size='35' value='$info[0]' readonly>
            ";
          }

          ?>

        </div>
      </div>

      <div class="col-md-12 row">
        <div  class="col-md-4">
          Residencia Fiscal:
          <?php
          if(!isset($_GET['id'])){
            echo "<input type='text'  class='form-control' name='dirCliente'  size='75' value='$direccionCliente' readonly>";
          }elseif(isset($_GET)){
            echo"
          <input type='text' name='dirCliente' class='form-control' size='75' value='$info[1]' readonly>
          ";
          }

          ?>
        </div>
      </div>

      <div class="col-md-12 row">
        <div class="col-md-4">Uso de CFDI:</div>
        <div class="col-md-8">
          <?php
          if(!isset($_GET['id'])){
            echo "<input type='text'  class='form-control' name='cfdi' size='70' value='$cfdi' readonly>";

          }elseif(isset($_GET)){
            echo"
            <input type='text'  class='form-control' name='cfdi' size='70' value='$row[9]' readonly>
            ";
          }
            ?>
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
      if(!isset($_GET['id'])){
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

      }elseif(isset($_GET)){
        $servicios=mysqli_query($link,"Select concepto_clave,concepto_descripcion,concepto_um,concepto_pu,
        concepto_cantidad,concepto_subtotal from f_concepto_facturado where factura_folio='$row[1]'") or die(mysqli_error($link));
        $totalProductos=mysqli_num_rows($servicios);
        $i=1;
        while ($servicio = mysqli_fetch_array($servicios)) {


            $claven="clave".strval($i);
            $descn="descripcion".strval($i);
            $umn="um".strval($i);
            $pun="pu".strval($i);
            $cantidadn="cantidad".strval($i);
            $totaln="total".strval($i);




         printf("<div class='col-md-12 row'>
         <div class='col-md-1 form-control'><input type='hidden' name='$claven' value='$servicio[0]' readonly>%s</div>
         <div class='col-md-4 form-control'><input type='hidden' name='$descn' value='$servicio[1]' readonly>%s</div>
         <div class='col-md-1 form-control'><input type='hidden' name='$umn' value='$servicio[2]' reandonly>%s</div>
         <div class='col-md-2 form-control'><input type='hidden' name='$pun' value='$servicio[3]' reandonly>%d</div>
         <div class='col-md-2 form-control'><input type='hidden' name='$cantidadn' value='$servicio[4]' reandonly>%d</div>
         <div class='col-md-2 form-control'><input type='hidden' name='$totaln' value='$servicio[5]' reandonly>$%d</div>
         </div>",$servicio[0], $servicio[1], $servicio[2], $servicio[3], $servicio[4],$servicio[5]);
       $i++;
     }


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
                  if(!isset($_GET['id'])){
                    echo"
                    <input type='text' class='form-control' name='subtotal' size=10 value='$subtotal' readonly>";
                  }elseif(isset($_GET)){
                    echo"
                            <input type='text' class='form-control' name='subtotal' size=10 value='$row[10]' readonly>
                        ";

                  }

                  ?>
                </div>
              </div>


              <div class="col-md-12 row justify-content-end mt-2">
                <div class="col-md-3">
                  +IVA(16%):
                </div>
                <div class="col-md-3">
                  <?php
                  if(!isset($_GET['id'])){
                    $ivapc=$subtotal*0.16;
                    echo"<input type='text'  class='form-control' name='iva' size=10 value='$ivapc' readonly>";
                  }elseif(isset($_GET)){
                    echo"
                        <input type='text' class='form-control' name='iva' size=10 value='$row[11]' readonly>
                        ";
                  }

                    ?>
                </div>
              </div>


              <div class="col-md-12 row justify-content-end mt-2">
                <div class="col-md-3">Total:</div>
                <div class="col-md-3">
                  <?php
                  if(!isset($_GET['id'])){
                    $totalmasiva=$subtotal+$ivapc;
                  echo"<input type='text'  class='form-control' name='totalmasiva' size=10 value='$totalmasiva' readonly>";

                  }elseif(isset($_GET)){
                    echo "
                <input type='text' name='totalmasiva' class='form-control' size=10 value='$row[5]' readonly>
                ";
                  }

                  ?>
                </div>
              </div>

            <div class="col-md-12 row justify-content-end mt-2">
              <div class="col-md-3">
                <input type="hidden" name="totalproductos" value="<?php
                echo $totalProductos
                 ?>">
                 <!--Diferenciar nuevas facturas de las anteriores para generar pdf-->
                <?php
                if(!isset($_GET['id'])){
                  echo "<input type='hidden' name='nueva' value='si'>";
                }
                ?>

                <input type="button" class="btn-success" value="Descargar" onclick="descargar()" >
              </div>
              <div class="col-md-3">
                  <input type="button" value="Regresar" class="btn-warning" onclick="history.go(-1)">
              </div>
              <div class="col-md-3">
              <a href="facturas.php"><input type="button" class='btn btn-primary' value="Ir a Facturas"></a>
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

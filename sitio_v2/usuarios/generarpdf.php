<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['tipo_usuario'])) {
  header("Location: no-autorizado.php");
  die();
}
include "../comun/recursos.php";
//require_once '../vendor/autoload.php';
$link=conectarse();


$imagen=$_POST["ubiImagen"];
$fecha=$_POST["fecha"];
$lugar=$_POST["lugar"];
$rfcEmisor=$_POST["emisorRFC"];
$nombreEmisor=$_POST["nombreEmisor"];
$dirEmisor=$_POST["dirEmisor"];
$tipoPago=$_POST["tipoPago"];
$formaPago=$_POST["formaPago"];
$cantidadPagos=$_POST["cantidadPagos"];
$regimen=$_POST["regimen"];
$receptorRFC=$_POST["receptorRFC"];
$nombreCliente=$_POST["nombreCliente"];
$dirCliente=$_POST["dirCliente"];
$cfdi=$_POST["cfdi"];
$totalProductos=$_POST["totalproductos"];
$subtotal=$_POST["subtotal"];
$iva=$_POST["iva"];
$totalmasiva=$_POST["totalmasiva"];
$folio=$_POST["folio"];


if(isset($_POST["nueva"])){
  $status="1";
  //obtener id de empresa
  $obtenerIdE=mysqli_query($link,"SELECT id FROM f_empresas where rfc='$rfcEmisor'") or die(mysqli_error($link));
  $idE=mysqli_fetch_array($obtenerIdE);
  //echo "obtener idE $idE[0]";
  //obtener id de cliente
  $obtenerIdC=mysqli_query($link,"SELECT id FROM f_cliente  where rfc='$receptorRFC'")or die(mysqli_error($link));
  $idC=mysqli_fetch_array($obtenerIdC);
  //echo "obtenr idC $idC[0]";
  //hacer insert de factura
  $insertaFactura=mysqli_query($link,"insert into f_factura(folio,rfc_emisor,direccion_emisor,lugar_expedicion,fecha_emision,
  rfc_receptor,metodo_pago,importe_total,empresa_usuario_rfc,iva,subtotal,uso_cfdi,cantidadPagos,status,f_empresas_id,f_cliente_id) 
  values('$folio','$rfcEmisor','$dirEmisor','$lugar','$fecha','$receptorRFC','$tipoPago','
  $totalmasiva','123asd','$iva','$subtotal','$cfdi','$cantidadPagos','$status','$idE[0]','$idC[0]')") or die(mysqli_error($link));
  
  //obtenr id del ultimo folio creado
  $obtenerFolio=mysqli_query($link,"SELECT id from f_factura WHERE folio='$folio'") or die(mysqli_error($link));
  $idF=mysqli_fetch_array($obtenerFolio);
  //echo "idF $idF[0]";
  
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
      $ivaP=$total*0.16;
      $tmi=$total+$ivaP;
      //obtenr id de cada concepto
      $obtenerIdConcepto=mysqli_query($link,"SELECT id from f_concepto where clave='$clave'") or die(mysqli_error($link));
      $idCon=mysqli_fetch_array($obtenerIdConcepto);
      //echo "idCon $idCon[0]";
      //echo $des;
      $insertaConcepto=mysqli_query($link,"insert into f_concepto_facturado(factura_folio,factura_empresa_rfc,
      fecha,concepto_clave,concepto_descripcion,
      concepto_um,concepto_cantidad,concepto_pu,concepto_subtotal,concepto_iva,concepto_total,f_concepto_id,f_factura_id) 
          values('$folio','$rfcEmisor','$fecha','$clave','$des','
      $um','$cantidad','$pu','$total','$iva','$tmi','$idCon[0]','$idF[0]')") or die(mysqli_error($link));
  
  }
}
//añadir info a f_factura




$encabezado="
<table align='left'> 

    <td>
    <img src='$imagen' width='250px' heigth='250px'>
    </td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>
        <table align='right'>
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
            <td>Folio:$folio</td>
          </tr>
          <tr>
            <td>Fecha y Hora de Emision:</td>
            <td>
              Lugar de Emision
            </td>
          </tr>

          <tr>
            <td>
            $fecha
            </td>
            <td>
           $lugar
            </td>
          </tr>
        </table>
    </td>

</table>";

$emisor="
<table align='left'>
    <tr>
         <td colspan='3'>
        $rfcEmisor
        </td>
        </tr>
    <tr>
        <td>
            Emisor:
            $nombreEmisor
        </td>
    </tr>
    <tr>
        <td colspan='6'>
            Direccion:
            $dirEmisor
        </td>
    </tr>

    <tr>
        <th>Metodo de Pago:</th>
        <td>
            $tipoPago
        </td>
        <th>
            Forma de Pago:
        </th>
        <td>
            $tipoPago
        </td>
        <th>Moneda:</th>
        <td>Peso Mexicano MXN</td>
    </tr>
    <tr>
        <th>Condicion de Pago:</th>
        <td>
            $cantidadPagos
        </td>
        <th>Regimen Fiscal:</th>
        <td> 
        $regimen
        </td>
    </tr>
    <tr>
        <td colspan='6'>
        ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        </td>
    </tr>
</table>
";
$receptor="
<table align='left'>
      <tr>
        <td colspan='4'>Facturado a (receptor):
        $receptorRFC
           </td>
      </tr>
      <tr>
        <td colspan='4'>
        Cliente: $nombreCliente
          
        </td>
      </tr>
      <tr>
        <td colspan='4'>
          Residencia Fiscal: 
            $dirCliente
        </td>
      </tr>
      <tr>
        <th>Uso de CFDI:</th>
        <td>
        $cfdi
        </td>
      </tr>
      <tr>
        <td colspan='6'>
          --------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        </td>
      </tr>
      
</table>
";

function tabla($totalProductos,$subtotal,$iva,$totalmasiva){
  $tabla="<table align='left'>
    <tr>
        <th>Clave &nbsp;</th>
        <th>Descripcion &nbsp;</th>
        <th>Unidad &nbsp;</th>
        <th>Precio Unitario &nbsp;</th>
        <th>Cantidad &nbsp;</th>
        <th>Importe</th>
    </tr>
    ";
    //echo $totalProductos;
  //añadir productos
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
    $ivaP=$total*0.16;
    $tmi=$total+$ivaP;
    //echo $clave;
    //añadir info a f_concepto_facturado

    $tabla .="<tr>
    <td>$clave</td>
    <td>$des</td>
    <td>$um</td>
    <td>$$pu</td>
    <td>$cantidad</td>
    <td>$$total</td>

    </tr>

    ";
  }
  $tabla.="
        <tr><br><br><br><br></tr>
        <tr><br><br><br><br></tr>
        <tr>
            <td colspan='6'>
                <table align='right'>
                    <tr>
                        <td>
                        Subtotal:
                        </td>
                        <td>
                        $$subtotal
                        </td>
                    </tr>
                    <tr>
                        <td>
                        +IVA(16%):
                        </td>
                        <td>$
                        $iva
                        </td>
                    </tr>
                    <tr>
                        <td>Total:</td>
                        <td>$
                        $totalmasiva
                        </td>
                    </tr>
                </table>
            </td>
         </tr>
    </table>";

return $tabla;

}



    $factura="<center>";
    $factura.=$encabezado;
    $factura.=$emisor;
    $factura.=$receptor;
    $factura.=tabla($totalProductos,$subtotal,$iva,$totalmasiva);
    $factura.="</center>";
/*

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($factura);
$nombreF="factura".$folio."pdf";
$mpdf->Output($nombreF,"D");

/*


echo "

<script>
location.href='facturas.php'
</script>"
*/
echo $factura;
echo "<a href='facturas.php'><input type='button' class='btn btn-primary' value='Ir a Facturas'></a>";
?>
<?php
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

$encabezado="<table>
<tr>
<td>
<img source='$imagen'>
</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>";


$tabla="<table>";

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

    $tabla.="<tr>
    <td>$clave</td>
    <td>$des</td>
    <td>$um</td>
    <td>$pu</td>
    <td>$cantidad</td>
    <td>$total</td>

    </tr>

    ";
    }
    $tabla.="</table>";

echo $encabezado;
echo $imagen;
echo $tabla;
?>
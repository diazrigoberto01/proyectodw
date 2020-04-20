<?php
//include "../comun/conexion.php";
require_once '../vendor/autoload.php';
//$link=Conectarse();
$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML('<h1>Hello world!</h1>');
$nombreF="factura".$folio."pdf";
$mpdf->Output($nombreF,"D");

?>
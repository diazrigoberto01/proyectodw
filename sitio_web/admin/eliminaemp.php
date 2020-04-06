<?php
$id=$_GET['id'];
//echo $id;
include '../comun/conexion.php';
$link=Conectarse();
$dire=mysqli_query($link,"Select rfc from f_empresas where id=$id");
$row=mysqli_fetch_array($dire);
echo $row[0];

$borraEmp=mysqli_query($link,"delete from f_empresas where  id ='$id'") or die(mysqli_error($link));
$borraDir=mysqli_query($link,"delete from f_direccion_empresa where empresa_rfc='$row[0]'") or die(mysqli_error($link));
if($borraEmp and $borraDir){
    echo "<script>alert('Exito')</script>";
    printf("<script>
    location.href='empresas_admin.php'
    </script>");
}else{
   echo "<script>alert('Algo salio mal')
   </script>";
}




?>
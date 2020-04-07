<?php
$id=$_GET['id'];
//echo $id;
include '../comun/conexion.php';
$link=Conectarse();
$borraClie=mysqli_query($link,"delete from f_concepto where  id ='$id'") or die(mysqli_error($link));
if($borraClie){
    echo "<script>alert('Exito')</script>";
    printf("<script>
    location.href='servicios_admin.php'
    </script>");
}else{
   echo "<script>alert('Algo salio mal')
   </script>";
}
?>
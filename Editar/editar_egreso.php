<?php
include "../php/conexion.php";
session_start();
$tip_usu=$_SESSION['tipo_usu'];
date_default_timezone_set('America/Lima');
$cn=new conexion();
$con=$cn->conectar();

$des=$_POST['descripcion'];
$monto=$_POST['monto'];
$id=$_POST['idegre'];
$resultado=mysqli_query($con,"update egreso set descripcion='$des',monto='$monto' where id_egreso='$id' ") or die(mysqli_error());

if($resultado){
        if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../reporteEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../reporteAdmin.php");}
        
                  }else{echo "<h3 align='center'>Error¡¡ </h3>";}


?>
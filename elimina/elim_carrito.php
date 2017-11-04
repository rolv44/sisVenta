<?php
include "../php/conexion.php";
session_start();
$c=new conexion();
$con=$c->conectar();
$idcarro=$_GET['idcarro'];
$idprod=$_GET['idprod'];
$cant=$_GET['cant'];
$codigo=$_GET['codstock'];
$tip_usu=$_SESSION['tipo_usu'];


    $result=mysqli_query($con,"call restore_stock($idprod,$cant)") or die(mysqli_error() );
    $result1=mysqli_query($con,"delete from carrito where idcarrito='$idcarro'and id_pro='$idprod' and cantidad='$cant'") or die(mysqli_error());
    if($result && $result1){ 
        if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../ventaEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../indexAdmin.php");}
    }
    


?>
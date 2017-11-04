<?php
include "../php/conexion.php";
session_start();
$tip_usu=$_SESSION['tipo_usu'];
date_default_timezone_set('America/Lima');
$cn=new conexion();
$con=$cn->conectar();
$rs=mysqli_query($con,"select trae_id_egre() as egreso") or die(mysqli_error());
$fila=mysqli_fetch_array($rs);
$idegreso=$fila['egreso'];
$descripcion=$_POST['descr'];
$monto=$_POST['mon'];
$fecha=date('Y-m-d');
$resultado=mysqli_query($con,"insert into egreso values('$idegreso','$descripcion','$monto','$fecha');")or die(mysqli_error());

 if($resultado){
        if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../reporteEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../reporteAdmin.php");}
        
                  }else{echo "<h3 align='center'>Error¡¡ </h3>";}

?>
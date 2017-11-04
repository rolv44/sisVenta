<?php
include "../php/conexion.php";
session_start();
$tip_usu=$_SESSION['tipo_usu'];
$cn=new conexion();
$con=$cn->conectar();
$codigo=$_POST['codventa'];
$idcliente=$_POST['idclie'];
$nombre=$_POST['cliente'];
$pago_ant=$_POST['pagado'];
$monto=$_POST['monto_total'];
$pago=$_POST['pago_deuda'];
$pago_act=$pago+$pago_ant;

if(isset($_POST['OK'])){
if($pago_act<$monto){
    $resu=mysqli_query($con,"update venta set pago='$pago_act' where id_venta='$codigo' and nom_clie='$nombre' ") or die(mysqli_error());
    if($resu){
        if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../reporteEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../reporteAdmin.php");}
        
                  }else{echo "<h3 align='center'>Error¡¡ </h3>";}
    
}elseif($pago_act==$monto){
    $resu1=mysqli_query($con,"update venta set pago='$pago_act',estado='CANCELADO' where id_venta='$codigo' and nom_clie='$nombre' ") or die(mysqli_error());
    if($resu1){
        if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../reporteEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../reporteAdmin.php");}
        
                  }else{echo "<h3 align='center'>Error¡¡ </h3>";}
    
}elseif($pago_act>$monto){
    $vuelto=$pago_act-$monto;
     $resu2=mysqli_query($con,"update venta set pago='$pago_act',estado='CANCELADO',vuelto='$vuelto' where id_venta='$codigo' and nom_clie='$nombre' ") or die(mysqli_error());
    if($resu2){
        if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../reporteEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../reporteAdmin.php");}
        
                  }else{echo "<h3 align='center'>Error¡¡ </h3>";}
}
}elseif(isset($_POST['abort'])){
    
    $resu11=mysqli_query($con,"update venta set total='0' ,estado='ANULADO' where id_venta='$codigo' and nom_clie='$nombre' ") or die(mysqli_error());
    
    $resull=mysqli_query($con,"select id_carrito as car from venta where id_venta='$codigo' ") or die(mysqli_error());
    $arre=mysqli_fetch_array($resull);
    $idcar=$arre['car'];
    $resultado=mysqli_query($con,"select id_pro,cantidad from carrito where idcarrito='$idcar' ") or die(mysqli_error());
    
    while($row = mysqli_fetch_array($resultado)){
    $ress=mysqli_query($con,"select stock_pro as st from producto where id_pro='$row[0]' ") or die(mysqli_error());
    $rr=mysqli_fetch_array($ress);
    $cca=$rr['st'];
    $cca=$cca+$row[1];
    $resu1=mysqli_query($con,"update producto set stock_pro='$cca' where id_pro='$row[0]' ") or die(mysqli_error());
}
    if($resultado && $resu11){
        if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../reporteEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../reporteAdmin.php");}
        
                  }else{echo "<h3 align='center'>Error¡¡ </h3>";}
}


?>

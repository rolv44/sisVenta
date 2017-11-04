<?php
include "conexion.php";
session_start();
date_default_timezone_set('America/Lima');
$idcarro=$_SESSION['idcarrito'];
$idcliente=$_POST["idcliente"];
$nomclie=$_POST['cnom'];
$usu=$_SESSION['usuario'];
$tipo=$_POST["dtlist"];
$vendedor=$_POST["venlist"];
$serie=$_POST['serie'];
$numero_comprobante=$_POST['nCompr'];
$c=new conexion();
$con=$c->conectar();
$_SESSION['idventa']=$serie.$numero_comprobante; 
$vvvv=$serie."-".$numero_comprobante; 

if(isset($_POST['pago'])){
  $pag=$_POST['pago'];  
}else{$pag="CONTADO";}

$rs=mysqli_query($con,"select trae_id_venta() as id");
$arre=mysqli_fetch_array($rs);
$idventa=$arre['id'];

$rs4=mysqli_query($con,"select trae_id_comp('$tipo') as id");  
$arre4=mysqli_fetch_array($rs4);
$id_comp=$arre4['id'];

$resultado=mysqli_query($con,"select cantidad, pre_uni from carrito where idcarrito='$idcarro' ") or die(mysqli_error());
$total=0;
$subtotal=0;
while($row = mysqli_fetch_array($resultado)){
    $subtotal=$row[0]*$row[1];
    $total=$total+$subtotal;
}
// $ds=($total*$descuento)/100;
//$mf=$total-$ds;
//$total=$mf;
if(strcmp($pag,"CONTADO")==0){
    $pago=$total;
}elseif(strcmp($pag,"CREDITO")==0){ $pago=0; }
$fecha=date('Y-m-d');


if($pago==0){
    $resu=mysqli_query($con,"insert into venta values('$vvvv','$idcliente','$usu','$nomclie','$idcarro','$tipo','PENDIENTE','0','0','$total','$fecha','','$id_comp','$vendedor');") or die( mysqli_error('Error'));
       if($resu==true){  
    $_SESSION['idcarrito']="0";
    echo "<script type='text/javascript'>window.open('imprimir.php?carro=$idcarro&venta=$vvvv&cliente=$idcliente','IMPRIMIR','width=500,height=700,scrollbars=SI');</script>";
    echo "<script type='text/javascript'>window.location='../indexAdmin.php'; </script>";   
    //header("Location:imprimir.php?carro=$idcarro&venta=$idventa&cliente=$idcliente");
           }else{ header("Location:../indexAdmin.php");}
}elseif($pago<$total){
     $resu=mysqli_query($con,"insert into venta values('$vvvv','$idcliente','$usu','$nomclie','$idcarro','$tipo','PENDIENTE','$pago','0','$total','$fecha','','$id_comp','$vendedor');") or die( mysqli_error('Error'));
       if($resu==true){
    $_SESSION['idcarrito']="0";
    echo "<script type='text/javascript'>window.open('imprimir.php?carro=$idcarro&venta=$vvvv&cliente=$idcliente','IMPRIMIR','width=500,height=700,scrollbars=SI');</script>";
    echo "<script type='text/javascript'>window.location='../indexAdmin.php'; </script>"; 
   // header("Location:imprimir.php?carro=$idcarro&venta=$idventa&cliente=$idcliente");
                    }else{ header("Location:../indexAdmin.php");}
}elseif($pago==$total){
    $resu=mysqli_query($con,"insert into venta values('$vvvv','$idcliente','$usu','$nomclie','$idcarro','$tipo','CANCELADO','$pago','0','$total','$fecha','','$id_comp','$vendedor');") or die( mysqli_error('Error'));
       if($resu==true){
    $_SESSION['idcarrito']="0";
    echo "<script type='text/javascript'>window.open('imprimir.php?carro=$idcarro&venta=$vvvv&cliente=$idcliente','IMPRIMIR','width=500,height=700,scrollbars=SI');</script>";
    echo "<script type='text/javascript'>window.location='../indexAdmin.php'; </script>";
    //header("Location:imprimir.php?carro=$idcarro&venta=$idventa&cliente=$idcliente");
          // header("Location:../indexAdmin.php");
                    }else{ header("Location:../indexAdmin.php");}
}elseif($pago>$total){
    $vuelto=$pago-$total;
    $resu=mysqli_query($con,"insert into venta values('$vvvv','$idcliente','$usu','$nomclie','$idcarro','$tipo','CANCELADO','$pago','$vuelto','$total','$fecha','','$id_comp','$vendedor');") or die( mysqli_error('Error'));
       if($resu==true){
    $_SESSION['idcarrito']="0";
    echo "<script type='text/javascript'>window.open('imprimir.php?carro=$idcarro&venta=$vvvv&cliente=$idcliente','IMPRIMIR','width=500,height=700,scrollbars=SI');</script>";
    echo "<script type='text/javascript'>window.location='../indexAdmin.php'; </script>"; 
   // header("Location:imprimir.php?carro=$idcarro&venta=$idventa&cliente=$idcliente");
                    }else{ header("Location:../indexAdmin.php");}
}
/*
<scrip type="text/javascript">
    function redirigir(dir){
    
}
    
</scrip>
*/
?>





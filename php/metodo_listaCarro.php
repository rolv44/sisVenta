<?php
include "conexion.php";
session_start();
$c=new conexion();
$con=$c->conectar();
$varsession=$_SESSION['idcarrito'];
$tipodeusuario=$_SESSION['tipo_usu'];
if(strcmp($varsession,"0")==0){
       
      $cn=new conexion();
      $con=$cn->conectar();
       $rs=mysqli_query($con,"SELECT trae_id_carrito() as opcion");
    $f=mysqli_fetch_array($rs);
    $r=$f['opcion'];
    $_SESSION['idcarrito']=$r;
   }

$producto=$_POST["pnom"];
$cant=$_POST['numberprod'];
$idp=$_POST['idpr'];
$des=$_POST['descripcion'];
$puni=$_POST['preuni'];
$stk=$_POST['prostock'];
$guia=$_POST['guiarem'];
$proveedor=$_POST['nomproveedor'];
$fechareg=$_POST['fechareg'];
$nuecant=$stk-$cant;
$vs=$_SESSION['idcarrito'];
 $result=mysqli_query($con,"insert into carrito values('$vs','$idp','$producto','$cant','$des','$puni','$guia','$proveedor','$fechareg');") or die (mysqli_error());
 $resul=mysqli_query($con,"update producto set stock_pro='$nuecant' where id_pro='$idp'") or die(mysqli_error());
  if($result && $resul){
      if(strcmp($tipodeusuario,"ADMINISTRADOR")==0){
          header("Location:../indexAdmin.php");
      }elseif(strcmp($tipodeusuario,"EMPLEADO")==0 || strcmp($tipodeusuario,"VENDEDOR")==0){
           header("Location:../ventaEmp.php");
      }
  }else{echo "<h2>ERROR</h2>";} 
    
    
    
/*
if(strcmp($tipo,"ESPECIAL")==0){
$idcarrito=$_SESSION['idcarrito'];
$cant=$_POST["tps"];
$ipd=$_POST["idpr"];
$cd=$_POST["codpr"];
$pu=$_POST['punitario'];
$pb=$_POST['pbloque'];
$tam_actual=$_POST['tamAct'];
$cant_act_stock=$_POST['canti_stock'];
$guiarem=$_POST['guia'];
$proveedor=$_POST['nombre_prov'];
$fecreg=$_POST['fecharegis'];    
$ncs=$cant_act_stock-1;
$resul=mysqli_query($con,"select des_pro as descripcion from producto where id_pro='$ipd'") or die(mysqli_error());
$rr=mysqli_fetch_array($resul);
    
$descri_prod=$rr['descripcion'];
$resu=mysqli_query($con,"select nom_pro as nombre from producto where id_pro='$ipd'") or die(mysqli_error());
$rs=mysqli_fetch_array($resu);
$nombre_prod=$rs['nombre']; 
$tre=$tam_actual-$cant;

$res=mysqli_query($con,"call ingresar_carrito('$idcarrito','$ipd','$nombre_prod',1,'$cd','$tipo','$cant','$descri_prod','$pu','$pb','$guiarem','$proveedor','$fecreg');") or die (mysqli_error());

    if(strcmp($cant,$tam_actual)==0){
        mysqli_query($con,"delete from almacen_especial where cod_stock='$cd' ")or die(mysqli_error());
        mysqli_query($con,"update producto set stock_pro=$ncs where id_pro='$ipd' ")or die(mysqli_error());
    }elseif($tam_actual>$cant){
       mysqli_query($con,"update almacen_especial set tam_pro='$tre' where cod_stock='$cd' ")or die(mysqli_error()); 
    }

    
if($res){
      if(strcmp($tipodeusuario,"ADMINISTRADOR")==0){
          header("Location:../indexAdmin.php");
      }elseif(strcmp($tipodeusuario,"EMPLEADO")==0){
           header("Location:../ventaEmp.php");
      }
  }else{echo "<h2>ERROR</h2>";}  

}

if(strcmp($tipo,"SERVICIO")==0){
    $ica=$_SESSION['idcarrito'];
    $descripcion=$_POST['descripcion'];
    $monto=$_POST['monto'];
    $da=date('Y-m-d');
    $r=mysqli_query($con,"call ingresar_carrito('$ica','0','servicio',1,'0','SERVICIO','0','$descripcion','$monto','0','0','0','$da');") or die (mysqli_error());
    if($r){
      if(strcmp($tipodeusuario,"ADMINISTRADOR")==0){
          header("Location:../indexAdmin.php");
      }elseif(strcmp($tipodeusuario,"EMPLEADO")==0){
           header("Location:../ventaEmp.php");
      }
  }else{echo "<h2>ERROR</h2>";}  
    
}else{echo "<script>alert('error¡¡¡¡');</script>";}






echo"<script>alert($varsession);</script>";
 $q=$_SESSION['idcarrito'];
    echo"<script>alert('hol.$q');</script>";


*/

?>

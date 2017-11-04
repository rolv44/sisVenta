<?php
include "../php/conexion.php";
date_default_timezone_set('America/Lima');
$cn=new conexion();
$con=$cn->conectar();
session_start();
$id_producto=$_POST['id_producto'];
$nombre=$_POST['n_producto'];
$descripcion=$_POST['d_producto'];
$marca=$_POST['m_producto'];
$guia=$_POST['g_producto'];
$proveedor=$_POST['np_producto'];
$tip_usu=$_SESSION['tipo_usu'];


    $resultado=mysqli_query($con,"update producto set nom_pro='$nombre', des_pro='$descripcion', mar_pro='$marca', guia_rem='$guia', nom_provee='$proveedor' where id_pro='$id_producto' ") or die(mysqli_error());
    if($resultado){
        if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../productoEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../productoAdmin.php");}
        
                  }else{echo "<h3 align='center'>Error¡¡ </h3>";}


/*
elseif(strcmp($tipo,"ESPECIAL")==0){
    $result=mysqli_query($con,"update producto set nom_pro='$nombre', des_pro='$descripcion', mar_pro='$marca', stock_pro='$stock', guia_rem='$guia', nom_provee='$proveedor' where id_pro='$id_producto' ") or die(mysqli_error());
    $rs=mysqli_query($con,"update almacen_especial set guia_rem='$guia', nom_provee='$proveedor' where id_pro='$id_producto' ") or die(mysqli_error());
    if($result && $rs){ 
       if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../productoEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../productoAdmin.php");}
    
}
}*/




?>
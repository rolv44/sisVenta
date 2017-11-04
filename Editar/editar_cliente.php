<?php
include "../php/conexion.php";
date_default_timezone_set('America/Lima');
$cn=new conexion();
$con=$cn->conectar();
session_start();
$id_cliente=$_POST['id_cliente'];
$nombre=$_POST['n_cliente'];
$razon=$_POST['rz_cliente'];
$dni=$_POST['d_cliente'];
$ruc=$_POST['r_cliente'];
$dir=$_POST['dir_cliente'];
$tel=$_POST['t_cliente'];
$referencia=$_POST['refere'];
$tip_usu=$_SESSION['tipo_usu'];
$resultado=mysqli_query($con,"update cliente set nom_clie='$nombre',raz_soc='$razon',dni_clie='$dni',ruc_clie='$ruc',dir_clie='$dir',cel_clie='$tel',clie_ref='$referencia' where id_clie='$id_cliente' ") or die(mysqli_error());

if($resultado){
   if(strcmp($tip_usu,"EMPLEADO")==0){
            header("Location:../clienteEmp.php");
        }elseif(strcmp($tip_usu,"ADMINISTRADOR")==0){header("Location:../clienteAdmin.php");}
}


?>
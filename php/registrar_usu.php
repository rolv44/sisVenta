<?php
include "conexion.php";
date_default_timezone_set('America/Lima');
$cn=new conexion();
$con=$cn->conectar();
$nombre=$_POST['reg_name'];
$pass=$_POST['reg_pass'];
$tipo=$_POST['reg_tip'];

$resultado=mysqli_query($con,"insert into usuario values(null,'$nombre',sha1('$pass'),'$tipo');")or die(mysqli_error());
if($resultado){
    header("Location:../controlAdmin.php");
}else{ echo "error";}

?>
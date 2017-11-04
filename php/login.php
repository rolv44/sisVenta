<?php 

include "conexion.php";
$cn=new conexion();
$con=$cn->conectar();
session_start();
$usuario=$_POST["name"];
$pass=$_POST["psw"];
$_SESSION['usuario']=$usuario;
$_SESSION['contrasena']=$pass;
$_SESSION['idcarrito']=0;
$rs1=mysqli_query($con,"select tip_usu as tipo from usuario where nom_usu='$usuario' and pass_usu=sha1('$pass')")or die(mysqli_error());
if($rs1){
    $file=mysqli_fetch_array($rs1);
    $tipo=$file['tipo'];    
}
        if(strcmp($tipo,"ADMINISTRADOR")==0){
            $_SESSION['tipo_usu']="ADMINISTRADOR";
              $rs=mysqli_query($con,"SELECT login('$usuario','$pass') as opcion");
              $f=mysqli_fetch_array($rs);
                   $r=$f['opcion'];
                       if(strcmp($usuario,"")!=0 && strcmp($pass, "")!=0){
	                    if($r==1 ){
                                 header("Location:../indexAdmin.php");
                                 $_SESSION['val']=1;  
                                 $usuario=null;
                                 $password=null;
                                       }else{
                             header("Location:../index.php");
                          }
                             }else{ echo "<script>alert('ALGUNOS CAMPOS VACIOS');</script>";
                     header("Location:../index.php");
                                     }
     }elseif(strcmp($tipo,"EMPLEADO")==0 || strcmp($tipo,"VENDEDOR")==0){
            $_SESSION['tipo_usu']="EMPLEADO";
              $rs=mysqli_query($con,"SELECT login('$usuario','$pass') as opcion");
              $f=mysqli_fetch_array($rs);
                   $r=$f['opcion'];
                       if(strcmp($usuario,"")!=0 && strcmp($pass, "")!=0){
	                    if($r==1 ){
                                 header("Location:../ventaEmp.php");
                                 $_SESSION['val']=1;  
                                 $usuario=null;
                                 $password=null;
                                       }else{
                             header("Location:../index.php");
                          }
                             }else{ echo "<script>alert('ALGUNOS CAMPOS VACIOS');</script>";
                     header("Location:../index.php");
                                     }
            
        }else{
            header("Location:../index.php");
        }
 ?>

<?php
?>

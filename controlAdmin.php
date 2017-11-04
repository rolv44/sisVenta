<?php 
session_start();
if(is_null($u=$_SESSION['usuario']) && is_null($c=$_SESSION['contrasena']) && !$_SESSION['val']==1){
   header("Location:index.php");
   
}
 ?>

<!DOCTYPE html PUBLIC "InnovatioCoorp">
<html xmlns="Cesar O'Higgins" xml:lang="en" lang="en">
<head>
<title>JR - DISTRIBUIDORES</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<link href="estilos/controlstyle.css" rel="stylesheet" type="text/css" />
<link href="estilos/layout.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/cufon-replace.js" type="text/javascript"></script>
<script src="js/Myriad_Pro_400.font.js" type="text/javascript"></script>
<script src="js/Myriad_Pro_600.font.js" type="text/javascript"></script>

</head>
<body id="page1">
<div id="header">
<div class="logo">
			<img src="images/logo.jpg" alt="" />
		</div>
	<div class="container">
		
		<ul class="nav">
			<li><a href="indexAdmin.php"><span>VENTAS</span></a></li>
			<li><a href="productoAdmin.php"><span>PRODUCTOS</span></a></li>
			<li><a href="clienteAdmin.php"><span>CLIENTES</span></a></li>
			<li><a href="reporteAdmin.php"><span>REPORTES</span></a></li>
			<li><a href="controlAdmin.php"  class="current"><span>CONTROL</span></a></li>
		</ul>

	</div>
</div>

<div class="usu">
   <h2 align="center">USUARIOS</h2>
    <table id="tblusu" border="1" bordercolor="#80deea">
        <tr>
            <th><label for="">COD</label></th>
            <th><label for="">NOMBRE</label></th>
            <th><label for="">TIPO</label></th>
        </tr>
        
        <?php
            include "php/conexion.php";
            $cn=new conexion();
            $con=$cn->conectar();
            $consulta=mysqli_query($con,"select *from usuario");
            $contador=1;
            while($row = mysqli_fetch_array($consulta)){ 
           
	        echo " 
		<tr bgcolor=#e1f5fe>
			<td>".$row[0]."</td>
			<td>".$row[1]."</td>
			<td>".$row[3]."</td>";
        $row[1]=str_replace(' ','+',$row[1]);        
    echo"  <td><label style='color:red' onclick=mostrar_edit('visible','$row[1]',$row[0],'$row[3]')>Editar</label></td>";
          if(strcmp($row[3],"ADMINISTRADOR")==0){ 
        echo" <td><label onclick='script:alerta();' style='color:green'>Eliminar</label></td>";
          }else{
            echo" <td><a href='elimina/elim_usuario.php?cod=$row[0]'>Eliminar</a></td>";
          }
    echo"	</tr>";      
              $contador++;  
             }
            ?>
        
    </table>
</div>

<div id="editusu">
    <div id="editusu2">
       <div class="lab"><h2 align="center">EDITAR USUARIO</h2><input type="button" value="cerrar" id="cerrar" onclick="javascript:mostrar_edit('hidden');"></div> 
        <form action="Editar/editar_usuario.php" method="post" >
        <input type="hidden" value="" name="edt_cod" id="edt_cod">
        <table id="tbledit">
            <tr>
                <td><label for="edt_nom">NOMBRE</label></td>
                <td><input type="text" name="edt_nom" id="edt_nom"></td>
            </tr>
            <tr>
                <td><label for="edt_pass">CONTRASEÑA</label></td>
                <td><input type="password" name="edt_pass" id="edt_pass" placeholder="*******" autocomplete="off"></td>
            </tr>
            <tr>
                <td><label for="edt_tip">TIPO</label></td>
                <td><select name="edt_tip" id="edt_tip">
                    <option value="EMPLEADO">EMPLEADO</option>
                    <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                    <option value="VENDEDOR">VENDEDOR</option>
                </select></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><label for="edt_passadmin">CONTRASEÑA ADMINISTRADOR</label></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="password" placeholder="*******" name="edt_passadmin" id="edt_passadmin" autocomplete="new-password"></td>
            </tr>   
            <tr>
                <td colspan="2" align="center"><input type="submit" value="GUARDAR"></td>
            </tr>
        </table>
        </form>
    </div>
</div>

<div id="creausu">
        <h2 align="center">REGISTRAR USUARIO</h2>
        <form action="php/registrar_usu.php" method="post">
        <table id="regusu">
            <tr>
                <td><label for="reg_name">NOMBRE</label></td>
                <td><input type="text" name="reg_name" id="reg_name"></td>
            </tr>
            <tr>
                <td><label for="reg_pass">CONTRASEÑA</label></td>
                <td><input type="text" name="reg_pass" id="reg_pass"></td>
            </tr>
            <tr>
                <td><label for="reg_tip">TIPO DE USUARIO</label></td>
                <td class="s"><select name="reg_tip" id="reg_tip">
                    <option value="EMPLEADO">EMPLEADO</option>
                    <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                    <option value="VENDEDOR">VENDEDOR</option>
                </select></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="ACEPTAR"></td>
            </tr>
        </table>
        </form>
</div>



<div id="footer">
	<div class="container">
		<a rel="nofollow" href="https://www.facebook.com/InnovatioCoorp/" target="_blank">Sitio Web diseñado por Innovatio Coorporation </a> 
		<h4>Diseñado por Cesar O'Higgins</h4>
		
	</div>
</div>
<script type="text/javascript"> Cufon.now(); </script> 
</body>
</html>

<script>
function mostrar_edit(x,nom,cod,tipo){
    var opc=0;
    document.getElementById('editusu').style.visibility=x;
    document.getElementById('edt_nom').value=nom.split('+').join(' ');
    document.getElementById('edt_cod').value=cod;
    if(tipo=="ADMINISTRADOR"){
        opc=1;
    }else{
        opc=0;
    }
    document.getElementById('edt_tip').selectedIndex=opc;
}
 function alerta(){
     window.alert("No es posible eliminar usuario de tipo ADMINISTRADOR ¡");
 }
</script>





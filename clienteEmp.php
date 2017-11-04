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
<link href="estilos/clientestyle.css" rel="stylesheet" type="text/css" />
<link href="estilos/layout.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="js/cufon-yui.js" type="text/javascript"></script>
<script src="js/cufon-replace.js" type="text/javascript"></script>
<script src="js/Myriad_Pro_400.font.js" type="text/javascript"></script>
<script src="js/Myriad_Pro_600.font.js" type="text/javascript"></script>
</head>
<body id="page1">
<!-- header -->
<div id="header">
<div class="logo">
			<img src="images/logo.jpg" alt="" />
		</div>
	<div class="container">
<!-- .logo -->
		

<!-- .nav -->
		<ul class="nav">
			<li><a href="ventaEmp.php"><span>VENTAS</span></a></li>
			<li><a href="productoEmp.php" ><span>PRODUCTOS</span></a></li>
            <li><a href="" class="current"><span>CLIENTES</span></a></li>
            <li><a href="reporteEmp.php"><span>REPORTES</span></a></li>
		</ul>

	</div>
</div>

<div id="reg1">
<div id="reg2">
<div class="lab1"><h3>REGISTRAR CLIENTE</h3><input type="button" id="cerrar" value="cerrar" onclick="script:view_add('hidden');"></div>
<form action="php/registrar_cliente.php" method="POST"> 
  <table class="tabla1">
    <tr>
        <td><label for="nombre">Nombre</label></td>
        <td><input type="text" name="nombre" id="nombre"></td>
    </tr>
    <tr>
         <td><label for="razon">Razon Social</label></td>
         <td><input type="text" name="razon" id="razon"></td>
     </tr>
     <tr>
         <td><label for="dni">DNI</label></td>
         <td><input type="text" name="dni" id="dni" size="8"></td>
     </tr>
      <tr>
         <td><label for="ruc">RUC</label></td>
         <td><input type="text" name="ruc" id="ruc" size="10"></td>
     </tr>
    <tr>
        <td><label for="dire">Direccion</label></td>
        <td><input type="text" name="dire" id="dire" size="20"></td>
    </tr>
    <tr>
        <td><label for="dire">Referencia</label></td>
        <td><input type="text" name="refere" id="refere" size="20"></td>
     </tr>
     <tr>
         <td><label for="tel">Telefono/Cel.</label></td>
         <td><input type="text" name="tel" id="tel" size="10"></td>
     </tr>
     
      <tr>
         <td colspan="2" align="center"><input type="submit" value="GUARDAR" name="botonclie" class="btG" id="botonclie"></td>
     </tr>
      
  </table>
       </form>
        </div>
        </div>
        
        <div class="dcliente">
        <label class="bus" for="buscar">Buscar</label><input type="text" id="buscar" onkeyup="buscar_cliente();">
        <table border="1" bordercolor="#80cbc4"  cellpadding="0" cellspacing="0" class="tblclie" id="datoclie" >
            <tr bgcolor=#80deea>
                <th style="width:15px"><label for="">COD</label></th>
                <th style="width:200px"><label for="">NOMBRE</label></th>
                <th style="width:250px"><label for="">RAZON SOCIAL</label></th>
                <th style="width:50px"><label for="">DNI</label></th>
                <th style="width:35px"><label for="">RUC</label></th>
                <th style="width:350px"><label for="">DIRECCION</label></th>
                <th style="width:350px"><label for="">REFERENCIA</label></th>
                <th style="width:35px"><label for="">TELEFONO</label></th>
                <th style="width:50px"><input type="button" value="REGISTRAR" onclick="view_add('visible');"></th>
            </tr>
            <?php
            include "php/conexion.php";
            $cn=new conexion();
            $con=$cn->conectar();
            $consulta=mysqli_query($con,"select *from cliente order by nom_clie");
            
            while($row = mysqli_fetch_array($consulta)){
	        echo "
		<tr bgcolor=#e1f5fe style='font-size: 13px;'>
			<td>".$row[0]."</td>
			<td>".$row[1]."</td>
			<td>".$row[2]."</td>
			<td>".$row[3]."</td>
            <td>".$row[4]."</td>
            <td>".$row[5]."</td>
            <td>".$row[7]."</td>
            <td>".$row[6]."</td>";
            $row[1]=str_replace(' ','+',$row[1]);
            $row[2]=str_replace(' ','+',$row[2]);
            $row[5]=str_replace(' ','+',$row[5]);
       echo "<td><label onclick=view_edit('visible','$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]'),subir(); style='color:red'>Editar</label></td>
		</tr>";
                
}
            
            ?>
        </table>
    </div>  
    
    <div id="editar">
        <div id="ven_edit">
            <div class="label_edit"><h3>EDITAR CLIENTE</h3><input type="button" id="cerrar" value="cerrar" onclick="script:view_cerrar('hidden');"></div>
    <form action="Editar/editar_cliente.php" method="post">   
             
            <input type="hidden" value="" name="id_cliente" id="id_cliente">
            <table class="tabla2">
    <tr>
        <td><label for="nombre">Nombre</label></td>
        <td><input type="text" name="n_cliente" id="n_cliente"></td>
    </tr>
    <tr>
         <td><label for="razon">Razon Social</label></td>
         <td><input type="text" name="rz_cliente" id="rz_cliente"></td>
     </tr>
     <tr>
         <td><label for="dni">DNI</label></td>
         <td><input type="text" name="d_cliente" id="d_cliente" size="8"></td>
     </tr>
      <tr>   
         <td><label for="ruc">RUC</label></td>
         <td><input type="text" name="r_cliente" id="r_cliente" size="10"></td>
     </tr>
    <tr>
        <td><label for="dire">Direccion</label></td>
        <td><input type="text" name="dir_cliente" id="dir_cliente" size="20"></td>
    </tr>
    <tr>
     <td><label for="dire">Referencia</label></td>
    <td><input type="text" name="refere" id="refere" size="20"></td>
    </tr>
     <tr>
         <td><label for="tel">Telefono/Cel.</label></td> 
         <td><input type="text" name="t_cliente" id="t_cliente" size="10"></td>
     </tr>
     
      <tr>
         <td colspan="2" align="center"><input type="submit" value="GUARDAR" name="botonclie" class="btG" id="botonclie"></td>
     </tr>
      
  </table>
         </form>      
        </div>
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

    function view_add(x){
        document.getElementById('reg1').style.visibility=x;
    }
    function view_cerrar(x){
        document.getElementById('editar').style.visibility=x;
    }
    function view_edit(x,cod,nom,rz,dni,ruc,dir,tel){
        
        document.getElementById('n_cliente').value=nom.split('+').join(' ');
        document.getElementById('id_cliente').value=cod;
        document.getElementById('rz_cliente').value=rz.split('+').join(' ');
        document.getElementById('d_cliente').value=dni;
        document.getElementById('r_cliente').value=ruc.split('+').join(' ');
        document.getElementById('dir_cliente').value=dir.split('+').join(' ');
        document.getElementById('t_cliente').value=tel.split('+').join(' ');
        document.getElementById('editar').style.visibility=x;
    }
    function buscar_cliente(){
    var tableReg = document.getElementById('datoclie');
    var searchText = document.getElementById('buscar').value.toLowerCase();
    var cellsOfRow = "";
    var found = false;
    var compareWith = "";

    // Recorremos todas las filas con contenido de la tabla
    for (var i = 1; i < tableReg.rows.length; i++)
    {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        found = false;
        // Recorremos todas las celdas
        for (var j = 0; j < cellsOfRow.length && !found; j++)
        {
            compareWith = cellsOfRow[j].innerHTML.toLowerCase();
            // Buscamos el texto en el contenido de la celda
            if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1))
            {
                found = true;
            }
        }
        if (found)
        {
            tableReg.rows[i].style.display = '';
        } else {
            // si no ha encontrado ninguna coincidencia, esconde la
            // fila de la tabla
            tableReg.rows[i].style.display = 'none';
        }
    }

}
    
    var arriba;
function subir() {
if (document.body.scrollTop != 0 || document.documentElement.scrollTop != 0) {
window.scrollBy(0, -15);
arriba = setTimeout('subir()', 10);
}
else clearTimeout(arriba);
}
    
</script>

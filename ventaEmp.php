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
    <link href="estilos/ventaEmpstyle.css" rel="stylesheet" type="text/css" />
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

            <div class="usu"><label for=""><?php echo $_SESSION['usuario'];?></label><a href="index.php">Cerrar Sesion</a></div>
            <ul class="nav">
                <li><a href="" class="current"><span>VENTAS</span></a></li>
                <li><a href="productoEmp.php"><span>PRODUCTOS</span></a></li>
                <li><a href="clienteEmp.php"><span>CLIENTES</span></a></li>
                <li><a href="reporteEmp.php"><span>REPORTES</span></a></li>
            </ul>

        </div>
    </div>


    <div class="venta">
        <form action="pedido/pedidoEmp.php" method="post">
            <input type="hidden" name="idcliente" id="idcliente">
            <table class="tblventa">
                <tr>
                    <th colspan="6" align="center">
                        <h4>REGISTRAR VENTA</h4>
                    </th>
                </tr>
                <tr>
                    <td align="center"><label for="dtlist">COMPROBANTE</label></td>
                    <td align="center"><input list="dtlis" name="dtlist" id="dtlist" style="width:150px" required>
                        <datalist id="dtlis">
                <option value="FACTURA"></option>
                <option value="BOLETA"></option>
            </datalist></td>
               <td><input type="text"  maxlength="3" id="serie" name="serie" style="width:50px"></td>
               <td><label for="">-</label></td>
               <td><input type="text"  maxlength="6" id="nCompr" name="nCompr" style="width:70px"></td>
                </tr>
                <tr>
                    <td align="center"><label for="cnom">Cliente</label></td>
                    <td><input type="text" name="cnom" id="cnom" style="width:150px" onclick="comp_clie();" autocomplete="off" required></td>
                    <td><input type="button" value="BUSCAR" onclick="cliente('visible')"></td>
                </tr>
                <tr>
                    <td align="center"><label for="cnom">PAGO</label></td>
                    <td><input list="pagolis" name="pago" id="pago" style="width:150px" required>
                    <datalist id="pagolis">
                        <option value="CONTADO">CONTADO</option>
                        <option value="CREDITO">CREDITO</option>
                    </datalist>
                    </td>
                    <!-- <td><input type="text" name="dsct" id="dsct" style="width:100px" placeholder="DESCUENTO %" onkeyup="calcular();"></td> -->
                </tr>
                <tr>
                    <td><label for="">VENDEDOR</label></td>
                    <td align="center"><input list="venlis" name="venlist" id="venlist" style="width:150px" required>
                        <datalist id="venlis">
               <?php
            include "php/conexion.php";
            $cn3=new conexion();
            $con3=$cn3->conectar();
            $consulta2=mysqli_query($con3,"select * from usuario where tip_usu='VENDEDOR'");
            while($row1= mysqli_fetch_array($consulta2)){ 
            echo"<option value=".$row1[1]."></option>";
            }    
                   ?>
            </datalist></td>
                </tr>

                <tr>
                    <td colspan="3" align="center"><input type="submit" value="VENDER"></td>
                </tr>

            </table>
        </form>
    </div>

    <div id="bcliente">
        <div id="bcliente2">
            <div class="lab1">
                <h3>BUSCAR CLIENTE</h3><input type="button" id="cerrar" value="cerrar" onclick="script:cliente('hidden');"></div>
            <div class="b"><input type="text" id="bcli"><input type="button" value="BUSCAR">
            </div>
            <div class="tablacli">
                <table id="tbl">
                    <tr bgcolor=#80deea>
                        <th><label for="">ID</label></th>
                        <th><label for="">NOMBRE</label></th>
                        <th><label for="">RAZON SOCIAL</label></th>
                        <th><label for="">DNI</label></th>
                        <th><label for="">RUC</label></th>
                        <th><label for="">DIRECCION</label></th>
                        <th><label for="">TELEFONO</label></th>
                    </tr>
                    <?php
            $cn=new conexion();
            $con=$cn->conectar();
            $consulta=mysqli_query($con,"select *from cliente order by nom_clie");
            $contador=1;
            while($row = mysqli_fetch_array($consulta)){ 
           
	        echo " 
		<tr bgcolor=#e1f5fe>
			<td>".$row[0]."</td>
			<td>".$row[1]."</td>
			<td>".$row[2]."</td>
			<td>".$row[3]."</td>
            <td>".$row[4]."</td>
            <td>".$row[5]."</td>
            <td>".$row[6]."</td>
            <td><input type='button' value='Enviar' onclick=script:getdato('$contador');cliente('hidden')></td>
		</tr>";      
              $contador++;  
             }
            ?>
                </table>
            </div>
        </div>
    </div>

    <div id="vemer2">
        <div id="busprod">
            <div class="lab1">
                <h3>BUSCAR PRODUCTO</h3><input type="button" id="cerrar" value="cerrar" onclick="script:producto('hidden');"></div>
            <div class="b"><input type="text" id="bcli"><input type="button" class="btnbus" value="BUSCAR">
            </div>
            <div class="tablaproduct">
                <table id="tbl2">
                    <tr bgcolor=#80deea>
                        <th><label for="">ID</label></th>
                        <th><label for="">NOMBRE</label></th>
                        <th><label for="">DESCRIPCION</label></th>
                        <th><label for="">MARCA</label></th>
                        <th><label for="">P. U.</label></th>
                        <th><label for="">STOCK</label></th>
                        <th><label for="">GUIA REM.</label></th>
                        <th><label for="">PROVEEDOR</label></th>
                        <th><label for="">FECHA REG.</label></th>
                    </tr>
                    <?php
            $cn=new conexion();
            $con=$cn->conectar();
            $consulta=mysqli_query($con,"select *from producto order by nom_pro");
            $contador=1;
            while($row = mysqli_fetch_array($consulta)){ 
	        echo " 
		<tr bgcolor=#e1f5fe>
			<td>".$row[0]."</td>
			<td>".$row[1]."</td>
			<td>".$row[2]."</td>
			<td>".$row[3]."</td>
            <td>".$row[5]."</td>
            <td>".$row[6]."</td>
            <td>".$row[8]."</td>
            <td>".$row[9]."</td>
            <td>".$row[10]."</td>
            ";
            echo "<td><input type='button' value='Enviar' onclick=script:getdatoprod('$contador');producto('hidden')></td>";
            
		      echo" </tr>";  
              $contador++;  
             }
            
            ?>
                </table>
            </div>
        </div>
    </div>

    <div class="carrito">
        <form action="php/metodo_listaCarro.php?tipoproducto=NORMAL" method="POST">
            <input type="hidden" value="" id="idpr" name="idpr">
            <input type="hidden" value="" id="descripcion" name="descripcion">
            <input type="hidden" value="" id="preuni" name="preuni">
            <input type="hidden" value="" id="prostock" name="prostock">
            <input type="hidden" value="" id="guiarem" name="guiarem">
            <input type="hidden" value="" id="nomproveedor" name="nomproveedor">
            <input type="hidden" value="" id="fechareg" name="fechareg">
            <div class="agreg">
                <table class="tblagregar">
                    <tr>
                        <td><label for="pnom">Producto</label></td>
                        <td><input type="text" id="pnom" name="pnom" required></td>
                        <td><input type="button" value="BUSCAR" onclick="producto('visible')"></td>
                    </tr>
                    <tr>
                        <td><label for="numberprod"> Cant.</label></td>
                        <td><input type="number" id="numberprod" name="numberprod"></td>
                        <td><input type="submit" value="AGREGAR" id="btnagrega" required></td>
                    </tr>
                </table>
            </div>
        </form>
        <br>
        <div class="scrolltbl">
            <table id="tblcarro">
                <tr>
                    <th colspan="6" align="center">
                        <h4>CARRITO DE COMPRAS</h4>
                    </th>
                </tr>
                <tr>
                    <td><label for="">CANT.</label></td>
                    <td><label for="">NOMBRE</label></td>
                    <td><label for="">DESCRIPCION</label></td>
                    <td><label for="">PRECIO U.</label></td>
                    <td><label for="">TOTAL</label></td>
                </tr>
                <?php
            
            $cn=new conexion();
            $con=$cn->conectar();
            $contador=1;
            $idc=$_SESSION['idcarrito'];
            if($idc>0){
                $total=0;
                $u="EMPLEADO";
                $consulta=mysqli_query($con,"call trae_carrito($idc)");
                while($row = mysqli_fetch_array($consulta)){ 
             $sub=$row[3]*$row[5];
             $total=$total+$sub;
	        echo " 
		<tr bgcolor=#e1f5fe>
			<td>".$row[3]."</td> 
			<td>".$row[2]."</td>
			<td>".$row[4]."</td>
			<td>".$row[5]."</td>
            <td>".$sub."</td>";
            $row[6]=str_replace(' ','+',$row[6]);     
        echo"<td><a href='elimina/elim_carrito.php?idcarro=$row[0]&idprod=$row[1]&cant=$row[3]&descr=$row[5]'>Eliminar</a></td>
		</tr>";   
              $contador++;  
             }
            echo "<tr>
            <td colspan='7' align='right'><input type='text' value='$total' size='2' disabled></td>
            </tr>";  
            
            }
            ?>
            </table>
        </div>

    </div>

    <div id="footer">
        <div class="container">
            <a rel="nofollow" href="https://www.facebook.com/InnovatioCoorp/" target="_blank">Sitio Web diseñado por Innovatio Coorporation </a>
            <h4>Diseñado por Cesar O'Higgins</h4>

        </div>
    </div>
    <script type="text/javascript">
        Cufon.now();

    </script>
</body>

</html>

<script type="text/javascript">
    function cliente(_param) {
        document.getElementById("bcliente").style.visibility = _param;

    }

    function producto(_param) {
        document.getElementById("vemer2").style.visibility = _param;

    }

    function stock(_param) {
        document.getElementById("vemer3").style.visibility = _param;

    }

    function getdato(x) {

        var n = document.getElementById("tbl").rows[x].cells[1].innerText;
        var i = document.getElementById("tbl").rows[x].cells[0].innerText;
        var rzsc = document.getElementById("tbl").rows[x].cells[2].innerText;
        document.getElementById("cnom").value = n;
        document.getElementById("idcliente").value = i;

        if (n.length < 1) {
            document.getElementById("cnom").value = rzsc;
        } else {
            document.getElementById("cnom").value = n;
        }
    }

    function getdatoprod(x) {

        var n = document.getElementById("tbl2").rows[x].cells[1].innerText;
        var mx = document.getElementById("tbl2").rows[x].cells[5].innerText;
        var idt = document.getElementById("tbl2").rows[x].cells[0].innerText;
        var descri = document.getElementById("tbl2").rows[x].cells[2].innerText;
        var puni = document.getElementById("tbl2").rows[x].cells[4].innerText;
        var guia = document.getElementById("tbl2").rows[x].cells[6].innerText;
        var provee = document.getElementById("tbl2").rows[x].cells[7].innerText;
        var fechareg = document.getElementById("tbl2").rows[x].cells[8].innerText;

        document.getElementById("pnom").value = n;
        document.getElementById("numberprod").setAttribute("max", mx);
        document.getElementById("numberprod").setAttribute("min", 1);
        document.getElementById("numberprod").setAttribute("placeholder", "Stock: " + mx);
        document.getElementById("idpr").value = idt;
        document.getElementById("descripcion").value = descri;
        document.getElementById("preuni").value = puni;
        document.getElementById("prostock").value = mx;
        document.getElementById("guiarem").value = guia;
        document.getElementById("nomproveedor").value = provee;
        document.getElementById("fechareg").value = fechareg;
    }

    function recargar() {
        window.location.reload(true);
    }

    function comp_clie() {
        var tipo = document.getElementById('dtlist').value;
        if (tipo == "BOLETA") {

        }
        if (tipo == "FACTURA") {
            alert("Seleccione un cliente del buscador para realizar factura");
        }
        if (tipo == "") {
            alert("Seleccione un tipo de comprobante antes");
        }
    }

</script>

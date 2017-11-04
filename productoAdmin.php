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
    <link href="estilos/productostyle.css" rel="stylesheet" type="text/css" />
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


            <!-- .nav -->
            <ul class="nav">
                <li><a href="indexAdmin.php"><span>VENTAS</span></a></li>
                <li><a href="" class="current"><span>PRODUCTOS</span></a></li>
                <li><a href="clienteAdmin.php"><span>CLIENTES</span></a></li>
                <li><a href="reporteAdmin.php"><span>REPORTES</span></a></li>
                <li><a href="controlAdmin.php"><span>CONTROL</span></a></li>
            </ul>

        </div>

    </div>

    <div id="reggen">
        <div id="inreggen">
            <div class="lab1">
                <h3>REGISTRAR PRODUCTO</h3><input type="button" id="cerrar" value="cerrar" onclick="script:view_add('hidden');"></div>
            <form action="php/registrar_productos.php" method="POST">

                <table class="tblreg">
                    <tr>
                        <td><label for="nombre">Nombre</label></td>
                        <td><input type="text" name="nombre" id="nombre" required></td>
                    </tr>
                    <tr>
                        <td><label for="desc">Descripcion</label></td>
                        <td><input type="text" name="desc" id="desc" required></td>
                    </tr>
                    <tr>
                        <td><label for="marca">Marca</label></td>
                        <td><input type="text" name="marca" id="marca" size="15" required></td>
                    </tr>
                    <tr>
                        <td><label for="cant">Cantidad</label></td>
                        <td><input type="text" name="cant" id="cant" size="5" required></td>
                    </tr>
                    <tr>
                        <td><label for="pc">P. Compra</label></td>
                        <td><input type="text" name="pc" id="pc" size="5" required></td>
                    </tr>
                    <tr>
                        <td><label for="pv">P. Venta</label></td>
                        <td><input type="text" name="pv" id="pv" size="5" required></td>
                    </tr>
                    <tr>
                        <td><label for="guia">Guia Remision</label></td>
                        <td><input type="text" name="guia" id="guia" size="10" required></td>
                    </tr>
                    <tr>
                        <td><label for="nomprove">N. Proveedor</label></td>
                        <td><input type="text" name="nomprove" id="nomprove"></td>
                    </tr>
                    <tr>
                        <td><label for="">U. Medida</label></td>
                        <td><select name="medidas" id="medidas">
             <option value="Metro">-------</option>
             <option value="Metro">Metro</option>
             <option value="Metro cuadrado">Metro cuadrado</option>
         </select></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="GUARDAR" name="botonpro" class="btG" id="botonpro"></td>
                    </tr>

                </table>
            </form>

        </div>
    </div>

    <div class="tblpro">
        <div class="chk"> <label><input type="checkbox" id="cbox1" value="first_checkbox">Mostrar Stock menor que 50</label><br></div>
        <input type="button" id="btnLow" name="btnlow" value="ACEPTAR" onclick="mostrarLow();">
        <label class="bus" for="buscar">Buscar</label><input type="text" id="buscar" onkeyup="buscar_producto();">
        <table class="tblprod" id="datopro" border="1" bordercolor="#80cbc4" cellpadding="0" cellspacing="0">
            <tr bgcolor=#80deea>
                <th style="width:15px"><label for="">COD</label></th>
                <th style="width:200px"><label for="">NOMBRE</label></th>
                <th style="width:400px"><label for="">DESCRIPCION</label></th>
                <th style="width:150px"><label for="">MARCA</label></th>
                <th style="width:80px"><label for="">P. U.</label></th>
                <th style="width:30px"><label for="">STOCK</label></th>
                <th style="width:100px" colspan="3" align="center"><input type="button" value="AGREGAR" class="btadd" onclick="view_add('visible');"></th>
                <th></th>
                <th></th>
            </tr>
            <?php
            include "php/conexion.php";
            $cn=new conexion();
            $con=$cn->conectar();
            $consulta=mysqli_query($con,"select *from producto order by nom_pro");
            
            while($row = mysqli_fetch_array($consulta)){
            $color='blue';
            if($row[6]<50){
                $color='red';
            }else{$color='green';}
	        echo "
		<tr bgcolor=#e1f5fe>
			<td>".$row[0]."</td>
			<td>".$row[1]."</td>
			<td>".$row[2]."</td>
			<td>".$row[3]."</td> 
            <td>".$row[5]."</td> 
            <td style='color:$color'>".$row[6]."</td> ";
            $row[1]=str_replace(' ', '+', $row[1]);
            $row[2]=str_replace(' ','+',$row[2]); 
            $row[3]=str_replace(' ','+',$row[3]);
            $row[8]=str_replace(' ','+',$row[8]);
            $row[9]=str_replace(' ','+',$row[9]);
        echo "    
            <td><label onclick=add_act('visible','$row[1]','$row[2]','$row[3]','$row[6]','$row[0]','$row[9]','$row[8]','$row[9]'),subir();  style='color:red'>Editar</label></td>
            <td><label onclick=mensaje('$row[6]','$row[0]','NORMAL') style='color:red' >Eliminar</label></td>
            <td><label onclick=show_dtl('$row[0]') style='color:red'>Detalles</label> </td>
		</tr>";   
            } 
            ?>
        </table>
    </div>
    <div id="actualizar">
        <div id="ven_act">
            <div class="lab2">
                <h3>EDITAR PRODUCTO</h3><input type="button" id="cerrar" value="cerrar" onclick="script:view_act('hidden');"></div>
            <form action="Editar/editar_producto.php" method="post">
                <input type="hidden" value="" name="id_producto" id="id_producto">
                <input type="hidden" value="" name="t_producto" id="t_producto">
                <table class="act_producto">
                    <tr>
                        <td><label for="nombre">Nombre</label></td>
                        <td><input type="text" name="n_producto" id="n_producto"></td>
                    </tr>
                    <tr>
                        <td><label for="desc">Descripcion</label></td>
                        <td><input type="text" name="d_producto" id="d_producto"></td>
                    </tr>
                    <tr>
                        <td><label for="marca">Marca</label></td>
                        <td><input type="text" name="m_producto" id="m_producto" size="15"></td>
                    </tr>
                    <!--  <tr>
                        <td><label for="cant">Stock</label></td>
                        <td><input type="text" name="s_producto" id="s_producto" size="3"></td>
                    </tr>-->

                    <tr>
                        <td><label for="guia">Guia Remision</label></td>
                        <td><input type="text" name="g_producto" id="g_producto" size="10"></td>
                    </tr>
                    <tr>
                        <td><label for="nomprove">N. Proveedor</label></td>
                        <td><input type="text" name="np_producto" id="np_producto"></td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="GUARDAR" name="botonpro" class="btG" id="botonpro"></td>
                    </tr>
                </table>
            </form>
            <br>
            <h3 align="center">EDITAR STOCK</h3>
            <form action="Editar/act_stock.php" method="post">
                <input type="hidden" name="iddp" id="iddp" value="">
                <table id="tbl_stt">
                    <tr>
                        <td>Producto</td>
                        <td><input type="text" name="nnp" id="nnp" required></td>
                    </tr>
                    <tr>
                        <td>Stock Actual</td>
                        <td><input type="text" name="sttp" id="sttp" style="width:60px" readonly></td>
                    </tr>
                    <tr>
                        <td>Agregar o Quitar</td>
                        <td><input type="text" name="ctta" id="ctta" style="width:60px" required></td>
                    </tr>
                    <tr>
                        <td>Guia Remision</td>
                        <td><input type="text" name="giir" id="giir" style="width:100px" required></td>
                    </tr>
                    <tr>
                        <td>Proveedor</td>
                        <td><input type="text" name="prr" id="prr"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="ACEPTAR"></td>
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
    <script type="text/javascript">
        Cufon.now();

    </script>
</body>

</html>



<script>
    function desc() {
        var pc = parseFloat(document.getElementById('pcm').value);
        var dc = parseFloat(document.getElementById('descu').value);
        var td = (pc * dc) / 100;
        var tt = pc - td;
        var fin = tt.toFixed(2);
        if (isNaN(td)) {
            document.getElementById('d').value = '';
        } else {
            document.getElementById('d').value = fin;
        }
    }

    function caligv() {
        var d = parseFloat(document.getElementById('d').value);
        var igv = parseFloat(document.getElementById('igv').value);
        var td = (d * igv) / 100;
        var tt = d + td;
        var fin = tt.toFixed(2);
        if (isNaN(td)) {
            document.getElementById('i').value = '';
        } else {
            document.getElementById('i').value = fin;
        }
    }

    function calflete() {
        var f = parseFloat(document.getElementById('flete').value);
        var i = parseFloat(document.getElementById('i').value);
        var td = (f * i) / 100;
        var tt = i + td;
        var fin = tt.toFixed(2);
        if (isNaN(td)) {
            document.getElementById('f').value = '';
        } else {
            document.getElementById('f').value = fin;
        }
    }

    function calgan() {
        var g = parseFloat(document.getElementById('gan').value);
        var f = parseFloat(document.getElementById('f').value);
        var td = (g * f) / 100;
        var tt = f + td;
        var fin = tt.toFixed(2);
        if (isNaN(td)) {
            document.getElementById('g').value = '';
        } else {
            document.getElementById('g').value = fin;
        }
    }

    function calcan() {
        var g = parseFloat(document.getElementById('g').value);
        var c = parseInt(document.getElementById('canti').value);
        var td = g / c;
        var tt = td.toFixed(2);
        if (isNaN(td)) {
            document.getElementById('ppu').value = '';
        } else {
            document.getElementById('ppu').value = tt;
        }

    }

    function send() {
        var cantid = parseInt(document.getElementById('canti').value);
        var pc = parseFloat(document.getElementById('pcm').value);
        var pu = document.getElementById('ppu').value;
        var tt = pc / cantid;
        if (isNaN(pc)) {
            alert('CAMPOS VACIOS');
        } else {

            document.getElementById('pc').value = tt;
            document.getElementById('pv').value = pu;
        }


    }
    
    function show_dtl(id){
        window.open("php/ver_det_pro.php?idpro="+id+"",'IMPRIMIR','width=1100,height=500,scrollbars=SI');  
    }

    function buscar_producto() {
        var tableReg = document.getElementById('datopro');
        var searchText = document.getElementById('buscar').value.toLowerCase();
        var cellsOfRow = "";
        var found = false;
        var compareWith = "";

        // Recorremos todas las filas con contenido de la tabla
        for (var i = 1; i < tableReg.rows.length; i++) {
            cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
            found = false;
            // Recorremos todas las celdas
            for (var j = 0; j < cellsOfRow.length && !found; j++) {
                compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                // Buscamos el texto en el contenido de la celda
                if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                    found = true;
                }
            }
            if (found) {
                tableReg.rows[i].style.display = '';
            } else {
                // si no ha encontrado ninguna coincidencia, esconde la
                // fila de la tabla
                tableReg.rows[i].style.display = 'none';
            }
        }

    }

    function view_add(x) {
        document.getElementById('reggen').style.visibility = x;
    }

    function view_act(x) {
        document.getElementById('actualizar').style.visibility = x;
    }

    function add_act(x, nombre, desc, marca, s, id, tipo, rem, prov) {
        document.getElementById('n_producto').value = nombre.split('+').join(' ');
        document.getElementById('d_producto').value = desc.split('+').join(' ');
        document.getElementById('m_producto').value = marca.split('+').join(' ');
        //document.getElementById('s_producto').value = s;
        document.getElementById('id_producto').value = id;
        document.getElementById('t_producto').value = tipo;
        document.getElementById('g_producto').value = rem.split('+').join(' ');
        document.getElementById('np_producto').value = prov.split('+').join(' ');
        document.getElementById('actualizar').style.visibility = x;
        document.getElementById('sttp').value = s;
        document.getElementById('nnp').value = nombre.split('+').join(' ');
        document.getElementById('iddp').value = id;
    }

    function mensaje(c, id, tipo) {
        if (c >= 1) {
            var opc = confirm("Esta seguro de eliminar este producto? aun quedan: " + c + " en stock.");
            if (opc) {
                window.location = "elimina/elim_producto.php?idproducto=" + id + "&tipo=" + tipo + "&cantidad=" + c;
            }

        }
        if (c == 0) {
            window.location = "elimina/elim_producto.php?idproducto=" + id + "&tipo=" + tipo + "&cantidad=" + c;
        }
    }

    var arriba;

    function subir() {
        if (document.body.scrollTop != 0 || document.documentElement.scrollTop != 0) {
            window.scrollBy(0, -15);
            arriba = setTimeout('subir()', 10);
        } else clearTimeout(arriba);
    }

    function mostrarLow() {
        if (document.getElementById('cbox1').checked) {
            var tableReg = document.getElementById('datopro');
            var searchText = 50;
            var cellsOfRow = "";
            var found = false;
            var compareWith = "";
            for (var i = 1; i < tableReg.rows.length; i++) {
                cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
                found = false;


                compareWith = cellsOfRow[5].innerHTML.toLowerCase();
                if (searchText.length == 0 || (compareWith < searchText)) {
                    found = true;
                }

                if (found) {
                    tableReg.rows[i].style.display = '';
                } else {
                    tableReg.rows[i].style.display = 'none';
                }
            }

        } else {
            var tableReg = document.getElementById('datopro');
            var searchText = "";
            var cellsOfRow = "";
            var found = false;
            var compareWith = "";

            // Recorremos todas las filas con contenido de la tabla
            for (var i = 1; i < tableReg.rows.length; i++) {
                cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
                found = false;
                // Recorremos todas las celdas
                for (var j = 0; j < cellsOfRow.length && !found; j++) {
                    compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                    // Buscamos el texto en el contenido de la celda
                    if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                        found = true;
                    }
                }
                if (found) {
                    tableReg.rows[i].style.display = '';
                } else {
                    // si no ha encontrado ninguna coincidencia, esconde la
                    // fila de la tabla
                    tableReg.rows[i].style.display = 'none';
                }
            }

        }
    }

</script>

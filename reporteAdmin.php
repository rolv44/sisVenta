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
    <link href="estilos/reportestyle.css" rel="stylesheet" type="text/css" />
    <link href="estilos/layout.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script src="js/cufon-yui.js" type="text/javascript"></script>
    <script src="js/cufon-replace.js" type="text/javascript"></script>
    <script src="js/Myriad_Pro_400.font.js" type="text/javascript"></script>
    <script src="js/Myriad_Pro_600.font.js" type="text/javascript"></script>

    <link href="calendario_dw/calendario_dw-estilos.css" type="text/css" rel="STYLESHEET">
    <script type="text/javascript" src="calendario_dw/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="calendario_dw/calendario_dw.js"></script>

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
                <li><a href="reporteAdmin.php" class="current"><span>REPORTES</span></a></li>
                <li><a href="controlAdmin.php"><span>CONTROL</span></a></li>
            </ul>

        </div>
    </div>
    <div class="filtrador">
        <table>
            <tr>
                <td><input type="button" value="ANTERIOR" id="btnAnte" onclick="cargar_anterior();"></td>
                <td><input type="button" value="SIGUIENTE" id="btnSig" onclick="cargar_siguiente();"></td>
                <td><input type="text" name="fech1" id="fech1" class="date" style="width:80px;"></td>
                <td><input type="text" name="fech2" id="fech2" class="date" style="width:80px;"></td>
                <td align="center"><input list="emplis" name="emplist" id="emplist" style="width:150px">
                    <datalist id="emplis">
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
                <td><input type="button" value="ACEPTAR" onclick="cargarXvendedor();"></td>
            </tr>
        </table>
    </div>
    <div class="ventas">
        <table id="tblventa" border="1" bordercolor="#4fc3f7">
            <tr>
                <th colspan="10" align="center">
                    <h4>LISTA DE VENTAS</h4>
                </th>
            </tr>
            <tr>
                <td><label for="">COD</label></td>
                <td><label for="">USUARIO</label></td>
                <td><label for="">CLIENTE</label></td>
                <td><label for="">COMPROBANTE</label></td>
                <td><label for="">ESTADO</label></td>
                <td><label for="">TOTAL</label></td>
                <td><label for="">DEUDA</label></td>
                <td><label for="">VENDEDOR</label></td>
                <td><label for="">FECHA</label></td>
            </tr>
            
        </table>
    </div>

    <div id="pago">
        <div id="pago1">
            <div class="lab">
                <h3>PAGO DE DEUDA</h3> <input type="button" id="cerrar" value="cerrar" onclick="script:pago('hidden');"></div>
            <form action="pago/pago_deuda.php" method="post">
                <input type="hidden" value="" name="idclie" id="idclie">
                <input type="hidden" value="" name="pagado" id="pagado">
                <input type="hidden" value="" name="monto_total" id="monto_total">
                <table class="tblpago">
                    <tr>
                        <th colspan="2" align="center"><label for="">DATOS DE VENTA</label></th>
                    </tr>
                    <tr>
                        <td><label for="codventa">COD VENTA</label></td>
                        <td><input type="text" name="codventa" id="codventa" readonly></td>
                    </tr>
                    <tr>
                        <td><label for="cliente">CLIENTE</label></td>
                        <td><input type="text" name="cliente" id="cliente" required></td>
                    </tr>
                    <tr>
                        <td><label for="deuda">DEUDA</label></td>
                        <td><input type="text" name="deuda" id="deuda" required></td>
                    </tr>
                    <tr>
                        <td><label for="pago_deuda">PAGO</label></td>
                        <td><input type="text" name="pago_deuda" id="pago_deuda" ></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="ACEPTAR" id="OK" name="OK"> <input type="submit" value="ANULAR" id="abort" name="abort"></td>
                    </tr>
                    
                </table>
            </form>
        </div>
    </div>

    <div class="egreso">
        <form action="egreso/egreso.php" method="post">
            <h3 align="center">EGRESOS</h3>
            <table id="egreso_in">
                <tr>
                    <th colspan="2" align="center"><label for="">DETALLES</label></th>
                </tr>
                <tr>
                    <td><label for="descr">Descripcion</label></td>
                    <td><input type="text" name="descr" id="descr" required></td>
                </tr>
                <tr>
                    <td><label for="mon">Monto</label></td>
                    <td><input type="text" name="mon" id="mon" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="Aceptar"></td>
                </tr>
            </table>
            <br>
            <div class="tbegreso">
                <table id="tblegreso" border="1" bordercolor="#4fc3f7">
                    <tr>
                        <th colspan="5" align="center"><label for="">Lista de Egresos</label></th>
                    </tr>
                    <tr>
                        <td><label for="">COD</label></td>
                        <td><label for="">DESCRIPCION</label></td>
                        <td><label for="">MONTO</label></td>
                        <td><label for="">FECHA</label></td>
                    </tr>

                    <?php
                    
                $cn=new conexion();
                $con=$cn->conectar();
                $contador=1;
                $consulta1=mysqli_query($con,"select *from egreso order by id_egreso desc limit 150")or die(mysqli_error());
                while($row1 = mysqli_fetch_array($consulta1)){ 
                   
	        echo " 
		<tr>
			<td>".$row1[0]."</td> 
			<td style='width:130px'>".$row1[1]."</td>
			<td>".$row1[2]."</td>
			<td>".$row1[3]."</td>";
            $row1[1]=str_replace(" ","+",$row1[1]);
       echo"<td><label  onclick=editar_egreso('visible','$row1[0]','$row1[1]','$row1[2]'),subir(); style='color:red';>Editar</label></td>";       
              $contador++; 
             }            
            ?>

                </table>
            </div>
        </form>
    </div>

    <div id="ediegre">
        <div id="ediegre2">
            <div class="lab">
                <h3>EDITAR EGRESO</h3> <input type="button" id="cerrar" value="cerrar" onclick="script:editar_egreso('hidden');"></div>
            <form action="Editar/editar_egreso.php" method="post">
                <input type="hidden" value="" name="idegre" id="idegre">
                <table class="tbleditegre">
                    <tr>
                        <th colspan="2" align="center"><label for="">DETALLES</label></th>
                    </tr>
                    <tr>
                        <td><label for="codventa">DESCRIPCION</label></td>
                        <td><input type="text" name="descripcion" id="descripcion" required></td>
                    </tr>
                    <tr>
                        <td><label for="cliente">MONTO</label></td>
                        <td><input type="text" name="monto" id="monto" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="ACEPTAR"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <div class="grafico">
        <h3 align="center">GRAFICOS</h3>
        <table id="tblgrafico">
            <tr>
                <td align="center">
                    <a href="reporte/reporte_usuario.php" target="_blank"><img src="images/Galeria2/report_usu.png" WIDTH=60 HEIGHT=80 /></a>
                    <br><label for="">VENDEDOR</label></td>
                <td align="center">
                    <a href="reporte/grafica_venta.php" target="_blank"><img src="images/Galeria2/estadistica_venta.jpg" WIDTH=90 HEIGHT=80 /></a>
                    <br><label for="">Ventas</label></td>
                <td align="center">
                    <a href="reporte/reporte_balance.php" target="_blank"><img src="images/Galeria2/estadisticas.png" WIDTH=90 HEIGHT=80 /></a>
                    <br><label for="">Balances</label></td>
            </tr>
        </table>
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
    $(document).ready(function() {
        $(".date").calendarioDW();
    })

    function formatear(fecha) {
        var d = fecha.split("/");
        var f = d[2] + "-" + d[1] + "-" + d[0];
        return f;
    }

    var glob_inicio = 0;
    var glob_final = 25;
    $(document).ready(cargar_primero());



    function cargar_primero() {
        var f1 = glob_inicio;
        var f2 = glob_final;
        document.getElementById('btnAnte').disabled = true;
        var parametros = {
            "ini": f1,
            "fin": f2
        };

        $.ajax({
            type: 'POST',
            url: 'reporte/reporte_block.php',
            data: parametros,
            dataType: 'json',
            success: function(data) {
                var valor = eval(data);
                var cont = 0;

                for (var i in valor) {
                    cont++;
                }

                var tabla = document.getElementById('tblventa');
                var i = 1;
                while (i <= cont) {

                    if (valor[i - 1].estado == 'PENDIENTE') {
                        var a = valor[i - 1].total;
                        var b = valor[i - 1].pago;
                        var c = a - b;
                        var cad = "darkorange";
                        var nombre = valor[i - 1].nom_clie.split(' ').join('+');
                        var cadena = "onclick=pago1('visible','" + valor[i - 1].id_venta + "','" + nombre + "','" + valor[i - 1].pago + "','" + valor[i - 1].total + "','" + valor[i - 1].id_clie + "');subir();";
                    } else  {
                        if(valor[i - 1].estado == 'CANCELADO'){
                            
                        var a = valor[i - 1].total;
                        var b = valor[i - 1].pago;
                        var c = a - b;
                        var c = 0;
                        var nombre = valor[i - 1].nom_clie.split(' ').join('+');
                            
                        var cad = "green";
                        var cadena = "onclick=pago1('visible','" + valor[i - 1].id_venta + "','" + nombre + "','" + valor[i - 1].pago + "','" + valor[i - 1].total + "','" + valor[i - 1].id_clie + "');subir(); ";
                           }else{
                               if(valor[i - 1].estado == 'ANULADO'){
                                  var c = 0;
                        var cad = "red";
                        var cadena = " ";
                                  }
                           }
                    }
                    var fila = tabla.insertRow(i + 1);
                    fila.insertCell(0).innerHTML = valor[i - 1].id_venta;
                    fila.insertCell(1).innerHTML = valor[i - 1].usuario;
                    fila.insertCell(2).innerHTML = valor[i - 1].nom_clie;
                    fila.insertCell(3).innerHTML = valor[i - 1].tipo;
                    fila.insertCell(4).innerHTML = "<label style='color:" + cad + "' " + cadena + " >" + valor[i - 1].estado + "</label>";
                    fila.insertCell(5).innerHTML = valor[i - 1].total;
                    fila.insertCell(6).innerHTML = c;
                    fila.insertCell(7).innerHTML = valor[i - 1].vendedor;
                    fila.insertCell(8).innerHTML = valor[i - 1].fecha;
                    fila.insertCell(9).innerHTML = "<a href='php/imprimir.php?venta=" + valor[i - 1].id_venta + "&carro=" + valor[i - 1].id_carrito + "&cliente=" + valor[i - 1].id_clie + "' target='_blank'>Imprimir</a>";
                    i++;
                }

            }
        });
        return false;

    }


    function cargar_siguiente() {
        glob_inicio += 25;
        glob_final += 25;
        var f1 = glob_inicio;
        var f2 = glob_final;
        document.getElementById('btnAnte').disabled = false;

        var dd = document.getElementById('tblventa');
        for (var j = dd.rows.length - 1; j > 1; j--) {
            document.getElementById("tblventa").deleteRow(j);
        }

        var parametros = {
            "ini": f1,
            "fin": f2
        };

        $.ajax({
            type: 'POST',
            url: 'reporte/reporte_block.php',
            data: parametros,
            dataType: 'json',
            success: function(data) {
                var valor = eval(data);
                var cont = 0;

                for (var i in valor) {
                    cont++;
                }
                if (cont < 25) {
                    document.getElementById('btnSig').disabled = true;
                }

                var tabla = document.getElementById('tblventa');
                var i = 1;
                while (i <= cont) {

                    if (valor[i - 1].estado == 'PENDIENTE') {
                        var a = valor[i - 1].total;
                        var b = valor[i - 1].pago;
                        var c = a - b;
                        var cad = "darkorange";
                        var nombre = valor[i - 1].nom_clie.split(' ').join('+');
                        var cadena = "onclick=pago1('visible','" + valor[i - 1].id_venta + "','" + nombre + "','" + valor[i - 1].pago + "','" + valor[i - 1].total + "','" + valor[i - 1].id_clie + "');subir();";
                    } else {
                        if(valor[i - 1].estado == 'CANCELADO'){
                           var c = 0;
                        var cad = "green";
                        var cadena = " ";
                           }else{
                               if(valor[i - 1].estado == 'ANULADO'){
                                  var c = 0;
                        var cad = "red";
                        var cadena = " ";
                                  }
                           }
                    }
                    
                    var fila = tabla.insertRow(i + 1);
                    fila.insertCell(0).innerHTML = valor[i - 1].id_venta;
                    fila.insertCell(1).innerHTML = valor[i - 1].usuario;
                    fila.insertCell(2).innerHTML = valor[i - 1].nom_clie;
                    fila.insertCell(3).innerHTML = valor[i - 1].tipo;
                    fila.insertCell(4).innerHTML = "<label style='color:" + cad + "' " + cadena + " >" + valor[i - 1].estado + "</label>";
                    fila.insertCell(5).innerHTML = valor[i - 1].total;
                    fila.insertCell(6).innerHTML = c;
                    fila.insertCell(7).innerHTML = valor[i - 1].vendedor;
                    fila.insertCell(8).innerHTML = valor[i - 1].fecha;
                    fila.insertCell(9).innerHTML = "<a href='php/imprimir.php?venta=" + valor[i - 1].id_venta + "&carro=" + valor[i - 1].id_carrito + "&cliente=" + valor[i - 1].id_clie + "' target='_blank'>Imprimir</a>";
                    i++;
                }

            }
        });


        return false;
    }


    function cargar_anterior() {
        glob_final -= 25;
        glob_inicio -= 25;
        var f1 = glob_inicio;
        var f2 = glob_final;
        var dd = document.getElementById('tblventa');
        for (var j = dd.rows.length - 1; j > 1; j--) {
            document.getElementById("tblventa").deleteRow(j);
        }

        var parametros = {
            "ini": f1,
            "fin": f2
        };

        $.ajax({
            type: 'POST',
            url: 'reporte/reporte_block.php',
            data: parametros,
            dataType: 'json',
            success: function(data) {
                var valor = eval(data);
                var cont = 0;

                for (var i in valor) {
                    cont++;
                }
                if (cont < 25) {
                    document.getElementById('btnAnte').disabled = true;
                }

                var tabla = document.getElementById('tblventa');
                var i = 1;
                while (i <= cont) {

                    if (valor[i - 1].estado == 'PENDIENTE') {
                        var a = valor[i - 1].total;
                        var b = valor[i - 1].pago;
                        var c = a - b;
                        var cad = "darkorange";
                        var nombre = valor[i - 1].nom_clie.split(' ').join('+');
                        var cadena = "onclick=pago1('visible','" + valor[i - 1].id_venta + "','" + nombre + "','" + valor[i - 1].pago + "','" + valor[i - 1].total + "','" + valor[i - 1].id_clie + "');subir();";
                    } else {
                        if(valor[i - 1].estado == 'CANCELADO'){
                           var c = 0;
                        var cad = "green";
                        var cadena = " ";
                           }else{
                               if(valor[i - 1].estado == 'ANULADO'){
                                  var c = 0;
                        var cad = "red";
                        var cadena = " ";
                                  }
                           }
                    }
                    var fila = tabla.insertRow(i + 1);
                    fila.insertCell(0).innerHTML = valor[i - 1].id_venta;
                    fila.insertCell(1).innerHTML = valor[i - 1].usuario;
                    fila.insertCell(2).innerHTML = valor[i - 1].nom_clie;
                    fila.insertCell(3).innerHTML = valor[i - 1].tipo;
                    fila.insertCell(4).innerHTML = "<label style='color:" + cad + "' " + cadena + " >" + valor[i - 1].estado + "</label>";
                    fila.insertCell(5).innerHTML = valor[i - 1].total;
                    fila.insertCell(6).innerHTML = c;
                    fila.insertCell(7).innerHTML = valor[i - 1].vendedor;
                    fila.insertCell(8).innerHTML = valor[i - 1].fecha;
                    fila.insertCell(9).innerHTML = "<a href='php/imprimir.php?venta=" + valor[i - 1].id_venta + "&carro=" + valor[i - 1].id_carrito + "&cliente=" + valor[i - 1].id_clie + "' target='_blank'>Imprimir</a>";
                    i++;
                }

            }
        });
        document.getElementById('btnSig').disabled = false;
        return false;
    }


    function cargarXvendedor() {

        var fecha1 = document.getElementById('fech1').value;
        var fecha2 = document.getElementById('fech2').value;
        var f1 = formatear(fecha1);
        var f2 = formatear(fecha2);
        var nombr = document.getElementById('emplist').value;
        var dd = document.getElementById('tblventa');
        for (var j = dd.rows.length - 1; j > 1; j--) {
            document.getElementById("tblventa").deleteRow(j);
        }
        var parametros = {
            "ini": f1,
            "fin": f2,
            "nomVendedor": nombr
        };

        $.ajax({
            type: 'POST',
            url: 'reporte/reporte_vendedor.php',
            data: parametros,
            dataType: 'json',
            success: function(data) {
                var valor = eval(data);
                var cont = 0;

                for (var i in valor) {
                    cont++;
                }

                var tabla = document.getElementById('tblventa');
                var i = 1;
                while (i <= cont) {

                    if (valor[i - 1].estado == 'PENDIENTE') {
                        var a = valor[i - 1].total;
                        var b = valor[i - 1].pago;
                        var c = a - b;
                        var cad = "red";
                        var nombre = valor[i - 1].nom_clie.split(' ').join('+');
                        var cadena = "onclick=pago1('visible','" + valor[i - 1].id_venta + "','" + nombre + "','" + valor[i - 1].pago + "','" + valor[i - 1].total + "','" + valor[i - 1].id_clie + "');subir();";
                    } else {
                        var c = 0;
                        var cad = "green";
                        var cadena = " ";
                    }
                    var fila = tabla.insertRow(i + 1);
                    fila.insertCell(0).innerHTML = valor[i - 1].id_venta;
                    fila.insertCell(1).innerHTML = valor[i - 1].usuario;
                    fila.insertCell(2).innerHTML = valor[i - 1].nom_clie;
                    fila.insertCell(3).innerHTML = valor[i - 1].tipo;
                    fila.insertCell(4).innerHTML = "<label style='color:" + cad + "' " + cadena + " >" + valor[i - 1].estado + "</label>";
                    fila.insertCell(5).innerHTML = valor[i - 1].total;
                    fila.insertCell(6).innerHTML = c;
                    fila.insertCell(7).innerHTML = valor[i - 1].vendedor;
                    fila.insertCell(8).innerHTML = valor[i - 1].fecha;
                    fila.insertCell(9).innerHTML = "<a href='php/imprimir.php?venta=" + valor[i - 1].id_venta + "&carro=" + valor[i - 1].id_carrito + "&cliente=" + valor[i - 1].id_clie + "' target='_blank'>Imprimir</a>";
                    i++;
                }

            }
        });


        return false;
    }


    function pago(x) {
        document.getElementById("pago").style.visibility = x;

    }

    function editar_egreso(x, cod, des, mon) {
        document.getElementById("ediegre").style.visibility = x;
        document.getElementById("idegre").value = cod;
        document.getElementById("descripcion").value = des.split("+").join(" ");
        document.getElementById("monto").value = mon;

    }

    function pago1(x, cod, cli, pag, t, idc) {
        document.getElementById("pago").style.visibility = x;
        document.getElementById('codventa').value = cod;
        document.getElementById('cliente').value = cli.split('+').join(' ');
        var deuda = t - pag;
        document.getElementById('deuda').value = deuda.toFixed(2);
        document.getElementById('idclie').value = idc;
        document.getElementById('pagado').value = pag;
        document.getElementById('monto_total').value = t;
    }

    var arriba;

    function subir() {
        if (document.body.scrollTop != 0 || document.documentElement.scrollTop != 0) {
            window.scrollBy(0, -15);
            arriba = setTimeout('subir()', 10);
        } else clearTimeout(arriba);

    }

</script>

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
    <link href="../estilos/report_usu.css" rel="stylesheet" type="text/css" />
    <link href="../estilos/layout.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/chartJS/Chart.min.js"></script>

    <link href="../calendario_dw/calendario_dw-estilos.css" type="text/css" rel="STYLESHEET">
    <script type="text/javascript" src="../calendario_dw/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="../calendario_dw/calendario_dw.js"></script>

</head>

<body id="page1">
    <div id="header">
        <div class="container">
            <div class="logo">
                <img src="../images/logo.jpg" alt="" />
            </div>

        </div>
    </div>

    <div class="caja">
        <table>
            <tr>
                <td>DESDE: </td>
                <td><input type="text" name="fech1" id="fech1" class="date"></td>
            </tr>
            <tr>
                <td>HASTA: </td>
                <td><input type="text" name="fech2" id="fech2" class="date"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="button" value="Mostrar" onclick="javascript: mostrarResultados();"></td>
            </tr>
        </table>
    </div>
    <div class="tbl_reporte">
        <table id="lista" border="1" bordercolor="#4fc3f7">
           <tr>
                <th colspan="2" align="center" style="background:#80deea">
                    <h4>LISTA DE VENDEDORES</h4>
                </th>
            </tr>
            <tr>
                <td><label for="">VENDEDOR</label></td>
                <td><label for="">CANTIDAD VENDIDAD</label></td>
            </tr>
        </table>
    </div>
    <!-- <div class="resultados"><canvas id="grafico"  ></canvas></div>  -->

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

    function mostrarResultados() {
        var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        var fecha1 = document.getElementById('fech1').value;
        var fecha2 = document.getElementById('fech2').value;
        var f1 = formatear(fecha1);
        var f2 = formatear(fecha2);

        var parametros = {
            "fecha1": f1,
            "fecha2": f2
        };
        $.ajax({
            type: 'POST',
            url: 'venta_usu.php',
            data: parametros,
            dataType: 'json',
            success: function(data) {

                var valores = eval(data);
                var tam = Object.keys(valores).length;
                var nombre = new Array();
                var det = new Array();
                var cont = 0;
                for (var key in valores) {
                    if (valores.hasOwnProperty(key)) {
                        nombre.push(key);
                        det.push(valores[key]);
                        var table = document.getElementById("lista");
                        var row = table.insertRow(2);
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        cell1.innerHTML =key;
                        cell2.innerHTML=valores[key];
                    }
                }
            }
        });
        // $('#lista_reporte tr:last').after('<tr><td>'key'</td><td>'valores[key]'</td></tr>');  
        return false;
    }

    //$(document).ready(mostrarResultados()); 
    /*
                function mostrarResultados(){
                    var meses=["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];
                    
                    var fecha1=document.getElementById('fech1').value;
                    var fecha2=document.getElementById('fech2').value;
                    var f1=formatear(fecha1);
                    var f2=formatear(fecha2);
                   
                     var parametros = { 
                                 "fecha1" : f1,
                                  "fecha2" : f2
                                            };
                    $.ajax({
                        type:'POST',
                        url:'venta_usu.php',
                        data:parametros,
                        dataType:'json',
                        success:function(data){

                            var valores = eval(data);
                            var tam=Object.keys(valores).length;
                            var nombre=new Array();
                            var det=new Array();
                            var cont=0;
                            for (var key in valores) {
                                  if (valores.hasOwnProperty(key)) {
                                 nombre.push(key);
                                 det.push(valores[key]);
                                                  }
                                   }  
                            var Datos = {
                                    labels : nombre,
                                    datasets : [
                                        { 
                                            fillColor : 'rgba(91,228,146,0.6)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(57,194,112,0.7)', //COLOR DEL BORDE DE LAS BARRAS
                                            highlightFill : 'rgba(73,206,180,0.6)', //COLOR "HOVER" DE LAS BARRAS
                                            highlightStroke : 'rgba(66,196,157,0.7)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                            data : det
                                            
                                        }
                                    ]
                                }
                                
                            var contexto = document.getElementById('grafico').getContext('2d');
                            window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                        }
                    });
                    return false;
                }    */

</script>
<?php
                  
                ?>

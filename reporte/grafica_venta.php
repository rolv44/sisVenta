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
    <link href="../estilos/report_venta.css" rel="stylesheet" type="text/css" />
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
                <td><input type="text" name="fech1" id="fech1" class="cd"></td>
            </tr>
            <tr>
                <td>HASTA: </td>
                <td><input type="text" name="fech2" id="fech2" class="cd"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center"><label for="mes">MES</label><input type="radio" id="mes" name="mes" value="MES"> <label for="dia">DIA</label><input type="radio" id="dia" name="mes" value="DIA"></td>

            </tr>
            <tr>
                <td colspan="2" align="center"><input type="button" value="Mostrar" onclick="javascript: mostrarResultados();"></td>
            </tr>
        </table>
    </div>
    <div class="resultados"><canvas id="grafico" width="1000" height="400"></canvas></div>

    <!-- <canvas id="countries" width="600" height="400"></canvas> -->


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
        $(".cd").calendarioDW();
    })

</script>
<script>
    function formatear(fecha) {
        var d = fecha.split("/");
        var f = d[2] + "-" + d[1] + "-" + d[0];
        return f;
    }

    function mostrar_mes(fecha1, fecha2) {
        var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        var f1 = fecha1.split("-");
        var f2 = fecha2.split("-");
        var mes = new Array();
        if (f1[0] == f2[0]) {
            if (f1[1] < f2[1]) {
                var i;
                for (i = f1[1]; i <= f2[1]; i++) {
                    mes.push(meses[i - 1]);
                }
            } else {
                if (f1[1] == f2[1]) {
                    var i = f1[1] - 1;
                    mes.push(meses[i]);
                }
            }
        }
        if (f1[0] < f2[0]) {

            var i;
            for (i = f1[1]; i <= 12; i++) {
                mes.push(meses[i - 1]);
            }
            for (i = 0; i < f2[1]; i++) {
                mes.push(meses[i]);
            }

        }
        return mes;
    }

    function mostrar_dias(fecha1, fecha2) {
        var f1 = fecha1.split("-");
        var f2 = fecha2.split("-");
        var numDia = new Array();
        numDia.push(31);
        numDia.push(28);
        numDia.push(31);
        numDia.push(30);
        numDia.push(31);
        numDia.push(30);
        numDia.push(31);
        numDia.push(31);
        numDia.push(30);
        numDia.push(31);
        numDia.push(30);
        numDia.push(31);

        var dias = new Array();
        if (parseInt(f1[0]) == parseInt(f2[0])) {
            if (parseInt(f1[1]) < parseInt(f2[1])) {
                for (var i = parseInt(f1[1]); i <= parseInt(f2[1]); i++) {
                    if (i < parseInt(f2[1])) {
                        for (var j = parseInt(f1[2]); j <= numDia[i - 1]; j++) {
                            dias.push(j);
                        }
                    } else {
                        if (i == parseInt(f2[1])) {
                            for (var y = 1; y <= parseInt(f2[2]); y++) {
                                dias.push(y);
                            }
                        }
                    }

                }

            } else {
                if (parseInt(f1[1]) == parseInt(f2[1])) {
                    for (var sd = parseInt(f1[2]); sd <= parseInt(f2[2]); sd++) {
                        dias.push(sd);
                    }

                }
            }
        } else {
            if (parseInt(f1[0]) < parseInt(f2[0])) {
                var cont = parseInt(f1[1]);
                var contf = parseInt(f1[0]);
                var ddddd = parseInt(f2[0] - 1);
                var sssss=parseInt(f2[1]);
                var vvvvv=parseInt(f1[1]);
                if (vvvvv > sssss) {
                    
                    var vuel = 13 - f1[1];
                    var vue = vuel + parseInt(f2[1]);
                    for (var z = 1; z <= parseInt(vue); z++) {
                        if (contf == ddddd) {
                            for (var b = parseInt(f1[2]); b <= numDia[cont - 1]; b++) {
                                dias.push(b);
                            }

                            if (cont == 12) {
                                contf++;
                            }
                            cont++;
                        } else {
                            if (contf == parseInt(f2[0])) {
                                for (var m = 1; m <= f2[1]; m++) {
                                        if (m < parseInt(f2[1])) {
                                            for (var c = 1; c <= numDia[m - 1]; c++) {
                                                dias.push(c);
                                            }
                                        }else{
                                            if (m == parseInt(f2[1])) {
                                        for (var g = 1; g <= parseInt(f2[2]); g++) {
                                            dias.push(g);
                                        }
                                    }
                                        }
                                    z++;
                                }
                            }
                        }
                    }
                }else{alert(f1[1]+"....."+f2[1]);}

            }

        }

        return dias;
    }

    function mostrarResultados() {
        var fe1 = document.getElementById('fech1').value;
        var fe2 = document.getElementById('fech2').value;
        var d1 = formatear(fe1);
        var d2 = formatear(fe2);
        var parametros = {
            "fecha1": d1,
            "fecha2": d2
        };
        
        if (document.getElementById('dia').checked) {
            var meses=mostrar_dias(d1,d2);
            var enlace = "venta_xfecha.php"; 
            
        }else{
            if (document.getElementById('mes').checked) {
            var enlace = "venta_t.php";
            var meses = mostrar_mes(d1, d2);
        }
        }
        $.ajax({
            type: 'POST',
            url: enlace,
            data: parametros,
            dataType: 'json',
            success: function(data) {
                var valores = eval(data);
                var v = new Array();
                for (var key in valores) {
                    if (valores.hasOwnProperty(key)) {
                        v.push(valores[key]);
                    }
                }
                                              
                var data = {
                    labels: meses,              
                    datasets: [{
                        labels: "My First dataset",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "#9ccc65",
                        fillColor: '#01579b',
                        borderColor: "rgba(75,192,192,1)",
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: "rgba(75,192,192,1)",
                        pointBackgroundColor: "#9ccc65",
                        pointBorderWidth: 1,
                        pointStrokeColor: "#9DB86D",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(75,192,192,1)",
                        pointHoverBorderColor: "rgba(220,220,220,1)",
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        data: v,
                        spanGaps: false,
                    }]
                };
                var buyers = document.getElementById('grafico').getContext('2d');
                new Chart(buyers).Line(data);

            }

        });
        return false;

        /*
        var pieData = [
	{
		value: 20,
		color:"#878BB6"   
	},
	{
		value : 40,
		color : "#4ACAB4"
	},
	{
		value : 10,
		color : "#FF8153"
	},
	{
		value : 30,
		color : "#FFEA88"
	}
];
        var pieOptions = {
	segmentShowStroke : false,
	animateScale : true
}
        var countries= document.getElementById("countries").getContext("2d");
new Chart(countries).Pie(pieData, pieOptions);

        */
    }

    /*  enviar array por ajax a php desde javascript
    var saveData = Array(); //Declaro el arreglo
    saveData[0] = 2;
    saveData[1] = 1;

    //Lo convierto a objeto
    var jObject={};
    for(i in saveData)
    {
        jObject[i] = saveData[i];
    }

    //Luego lo paso por JSON  a un archivo php llamado js.php

    jObject= JSON.stringify(jObject);
    $.ajax({
            type:'post',
             cache:false,
             url:"js.php",
            data:{jObject:  jObject},
            success:function(server){
            alert(server);//cuando reciva la respuesta lo imprimo

               }
     });
     });

    
    */
        
    
</script>

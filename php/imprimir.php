<?php
include "conexion.php";
require '../fpdf/fpdf.php';
date_default_timezone_set('America/Lima');
$idventa=$_GET['venta'];
$idcarro=$_GET['carro'];
session_start();
$tip_usu=$_SESSION['tipo_usu'];
function numtoletras($xcifra)
{ 
$xarray = array(0 => "Cero",
1 => "UN",2=> "DOS",3=> "TRES",4=> "CUATRO",5=> "CINCO",6=> "SEIS",7=> "SIETE",8=> "OCHO",9=> "NUEVE", 
10=>"DIEZ",11=> "ONCE",12=> "DOCE",13=> "TRECE",14=> "CATORCE",15=> "QUINCE",16=> "DIECISEIS",17=> "DIECISIETE",18=> "DIECIOCHO",19=> "DIECINUEVE", 
20=>"VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA", 
100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
);
//
$xcifra = trim($xcifra);
$xlength = strlen($xcifra);
$xpos_punto = strpos($xcifra, ".");
$xaux_int = $xcifra;
$xdecimales = "00";
if (!($xpos_punto === false))
	{
	if ($xpos_punto == 0)
		{
		$xcifra = "0".$xcifra;
		$xpos_punto = strpos($xcifra, ".");
		}
	$xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
	$xdecimales = substr($xcifra."00", $xpos_punto + 1, 2); // obtengo los valores decimales
	}
 
$XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
$xcadena = "";
for($xz = 0; $xz < 3; $xz++)
	{
	$xaux = substr($XAUX, $xz * 6, 6);
	$xi = 0; $xlimite = 6; // inicializo el contador de centenas xi y establezco el l�mite a 6 d�gitos en la parte entera
	$xexit = true; // bandera para controlar el ciclo del While	
	while ($xexit)
		{
		if ($xi == $xlimite) // si ya lleg� al l�mite m�ximo de enteros
			{
			break; // termina el ciclo
			}
 
		$x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
		$xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres d�gitos)
		for ($xy = 1; $xy < 4; $xy++) // ciclo para revisar centenas, decenas y unidades, en ese orden
			{
			switch ($xy) 
				{
				case 1: // checa las centenas
					if (substr($xaux, 0, 3) < 100) // si el grupo de tres d�gitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
						{
						}
					else
						{
						$xseek = in_array(substr($xaux, 0, 3),$xarray); // busco si la centena es n�mero redondo (100, 200, 300, 400, etc..)
						if ($xseek)
							{
							$xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Mill�n, Millones, Mil o nada)
							if (substr($xaux, 0, 3) == 100) 
								$xcadena = " ".$xcadena." CIEN ".$xsub;
							else
								$xcadena = " ".$xcadena." ".$xseek." ".$xsub;
							$xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
							}
						else // entra aqu� si la centena no fue numero redondo (101, 253, 120, 980, etc.)
							{
							$xseek = $xarray[substr($xaux, 0, 1) * 100]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
							$xcadena = " ".$xcadena." ".$xseek;
							} // ENDIF ($xseek)
						} // ENDIF (substr($xaux, 0, 3) < 100)
					break;
				case 2: // checa las decenas (con la misma l�gica que las centenas)
					if (substr($xaux, 1, 2) < 10)
						{
						}
					else
						{
						$xseek = in_array(substr($xaux, 1, 2),$xarray);
						if ($xseek)
							{
							$xsub = subfijo($xaux);
							if (substr($xaux, 1, 2) == 20)
								$xcadena = " ".$xcadena." VEINTE ".$xsub;
							else
								$xcadena = " ".$xcadena." ".$xseek." ".$xsub;
							$xy = 3;
							}
						else
							{
							$xseek = $xarray[substr($xaux, 1, 1) * 10];
							if (substr($xaux, 1, 1) * 10 == 20)
								$xcadena = " ".$xcadena." ".$xseek;
							else	
								$xcadena = " ".$xcadena." ".$xseek." Y ";
							} // ENDIF ($xseek)
						} // ENDIF (substr($xaux, 1, 2) < 10)
					break;
				case 3: // checa las unidades
					if (substr($xaux, 2, 1) < 1) // si la unidad es cero, ya no hace nada
						{
						}
					else
						{
						$xseek = $xarray[substr($xaux, 2, 1)]; // obtengo directamente el valor de la unidad (del uno al nueve)
						$xsub = subfijo($xaux);
						$xcadena = " ".$xcadena." ".$xseek." ".$xsub;
						} // ENDIF (substr($xaux, 2, 1) < 1)
					break;
				} // END SWITCH
			} // END FOR
			$xi = $xi + 3;
		} // ENDDO
 
		if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
			$xcadena.= " DE";
 
		if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
			$xcadena.= " DE";
 
		// ----------- esta l�nea la puedes cambiar de acuerdo a tus necesidades o a tu pa�s -------
		if (trim($xaux) != "")
			{
			switch ($xz)
				{
				case 0:
					if (trim(substr($XAUX, $xz * 6, 6)) == "1")
						$xcadena.= "UN BILLON ";
					else
						$xcadena.= " BILLONES ";
					break;
				case 1:
					if (trim(substr($XAUX, $xz * 6, 6)) == "1")
						$xcadena.= "UN MILLON ";
					else
						$xcadena.= " MILLONES ";
					break;
				case 2:
					if ($xcifra < 1 )
						{
						$xcadena = " CERO SOLES Y $xdecimales/100 NUEVOS SOLES ";
						}
					if ($xcifra >= 1 && $xcifra < 2)
						{
						$xcadena = " UN SOLES Y $xdecimales/100 NUEVOS SOLES ";
						}
					if ($xcifra >= 2)
						{
						$xcadena.= " SOLES Y $xdecimales/100 NUEVOS SOLES "; // 
						}
					break;
				} // endswitch ($xz)
			} // ENDIF (trim($xaux) != "")
		// ------------------      en este caso, para M�xico se usa esta leyenda     ----------------
		$xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
		$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles 
		$xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
		$xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles 
		$xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
		$xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
		$xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
	} // ENDFOR	($xz)
	return trim($xcadena);
} // END FUNCTION
 
 
function subfijo($xx)
	{ // esta funci�n regresa un subfijo para la cifra
	$xx = trim($xx);
	$xstrlen = strlen($xx);
	if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
		$xsub = "";
	//	
	if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
		$xsub = "MIL";
	//
	return $xsub;
	} // END FUNCTION



$idcliente=$_GET['cliente'];
$c=new conexion();
$con=$c->conectar();
$total=0;
$result=mysqli_query($con,"select *from carrito where idcarrito='$idcarro' ")or die(mysqli_error());
$res=mysqli_query($con,"select *from venta where id_venta='$idventa' ")or die(mysqli_error());
$resu=mysqli_query($con,"select *from cliente where id_clie='$idcliente' ")or die(mysqli_error());

$cliente_list=array();
$cnt=0;
while($tr=mysqli_fetch_row($resu)){
    $cnt=1;
    $cliente_list[0]=$tr[0];
    $cliente_list[1]=$tr[1];
    $cliente_list[2]=$tr[2];
    $cliente_list[3]=$tr[3];
    $cliente_list[4]=$tr[4];
    $cliente_list[5]=$tr[5];
    $cliente_list[6]=$tr[6];
}
if($res && $result){
    $ven=mysqli_fetch_array($res);
    $cifra=0;
    $numero=$ven[12];
    while($numero>=1){
        $numero=$numero/10;
        $cifra++;
    }
    $ceros="00000000";
    if($cifra==1){
        $ceros="0000000";
    }elseif($cifra==2){
        $ceros="000000";
    }elseif($cifra==3){
        $ceros="00000";
    }elseif($cifra==4){
        $ceros="00000";
    }elseif($cifra==5){
        $ceros="00000";
    }
       if(strcmp($ven[5],"FACTURA")==0){
           $pdf=new FPDF();
$pdf->AddPage();
$anio=substr($ven[10],2,2);
$mes=substr($ven[10],5,2);
$dia=substr($ven[10],8);
$pdf->SetFont('Times','B',10);
$pdf->Cell(50,40," ",0,1,'l');
$pdf->SetXY(30,43);
$pdf->Cell(100,5,$cliente_list[2],0,1,'l');
$pdf->SetXY(30,52);
$pdf->Cell(100,5,$cliente_list[5],0,1,'l');
$pdf->SetXY(30,60);
$pdf->Cell(123,5,$cliente_list[4],0,0,'l');
$pdf->Cell(25,5,$dia,0,0,'r');
$pdf->Cell(27,5,$mes,0,0,'r');
$pdf->Cell(20,5,$anio,0,1,'r');
$pdf->Cell(20,10,' ',0, 1,'l');

$total=0;
while ($row = mysqli_fetch_row($result)){ 
    $subtotal=$row[3]*$row[5];
    $total=$total+$subtotal;
    $pdf->Cell(20,3,$row[3],0,0,'c');
    $pdf->Cell(100,3,$row[2],0,0,'c');
    $pdf->Cell(30,3,number_format($row[5],2,'.',','),0,0,'l');
    $pdf->Cell(30,3,number_format($subtotal,2,'.',','),0,1,'l');
    //$pdf->Cell(50,5,$row[5],0,1,'l');
}  
//$vz="DESCUENTO:".$ven[11]."%";
 $pdf->SetXY(19,133);
 $dess=($total*$ven[11])/100; 
 $newt=$total-$dess;
 $redondo=round($newt,2);
 //$pdf->Cell(20,12,$redondo,0,1,'r');
 $nn=numtoletras($redondo);
 $pdf->Cell(167,10,$nn,0,0,'r');
 $pdf->Cell(50,12,number_format($ven[9],2,'.',','),0,1,'r');
 $pdf->Cell(176,10,"     ",0,0,'r');
 $pdf->Cell(50,10,number_format($ven[9],2,'.',','),0,1,'r');
 $pdf->Cell(55,10,$ven[13],0,1,'r');
//$impor="IMPORTE:".$ven[7]." ";
//$vuelto="VUELTO:".$ven[8]." ";
$pdf->Output();
           
       }elseif(strcmp($ven[5],"BOLETA")==0){
          
$pdf=new FPDF();
$pdf->AddPage();
$anio=substr($ven[10],2,2);
$mes=substr($ven[10],5,2);
$dia=substr($ven[10],8);
$pdf->SetFont('Times','B',10);
$pdf->Cell(50,40," ",0,1,'l');
$pdf->SetXY(30,43);
$pdf->Cell(100,5,$cliente_list[1],0,1,'l');
$pdf->SetXY(30,52);
$pdf->Cell(100,5,$cliente_list[5],0,1,'l');
$pdf->SetXY(30,60);
$pdf->Cell(123,5,$cliente_list[3],0,0,'l');
$pdf->Cell(25,5,$dia,0,0,'r');
$pdf->Cell(27,5,$mes,0,0,'r');
$pdf->Cell(20,5,$anio,0,1,'r');
$pdf->Cell(20,10,' ',0, 1,'l');

$total=0;
while ($row = mysqli_fetch_row($result)){ 
    $subtotal=$row[3]*$row[5];
    $total=$total+$subtotal;
    $pdf->Cell(20,3,$row[3],0,0,'c');
    $pdf->Cell(100,3,$row[2],0,0,'c');
    $pdf->Cell(30,3,number_format($row[5],2,'.',','),0,0,'R');
    $pdf->Cell(30,3,number_format($subtotal,2,'.',','),0,1,'R');
    //$pdf->Cell(50,5,$row[5],0,1,'l');
}  
//$vz="DESCUENTO:".$ven[11]."%";
 $pdf->SetXY(19,133);
 $dess=($total*$ven[11])/100; 
 $newt=$total-$dess;
 $redondo=round($newt,2);
 //$pdf->Cell(20,12,$redondo,0,1,'r');
 $nn=numtoletras($redondo);
 $pdf->Cell(167,10,$nn,0,0,'r');
 $pdf->Cell(50,12,number_format($ven[9],2,'.',','),0,1,'r');
 $pdf->Cell(176,10,"     ",0,0,'r');
 $pdf->Cell(50,10,number_format($ven[9],2,'.',','),0,1,'r');
 $pdf->Cell(55,10,$ven[13],0,1,'r');
//$impor="IMPORTE:".$ven[7]." ";
//$vuelto="VUELTO:".$ven[8]." ";
$pdf->Output();
       }
}
echo"
<script type='text/javascript'>
function imprSelec()
{
var ficha=document.getElementById('imp');
var ventimp=window.open(' ','_blank');
ventimp.document.write(ficha.innerHTML);
ventimp.document.close();
ventimp.print();
ventimp.close();}

</script>


";




?>
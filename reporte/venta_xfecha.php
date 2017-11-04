<?php
	include('../php/conexion.php');
	$cn=new conexion();
    $con=$cn->conectar();
	$fecha1 =$_POST['fecha1'];
    $fecha2=$_POST['fecha2'];
    $f1=explode("-",$fecha1);
    $f2=explode("-",$fecha2);

     $numDia =array();
     array_push($numDia,31);
     array_push($numDia,28);
     array_push($numDia,31);
     array_push($numDia,30);
     array_push($numDia,31);
     array_push($numDia,30);
     array_push($numDia,31);
     array_push($numDia,31);
     array_push($numDia,30);
     array_push($numDia,31);
     array_push($numDia,30);
     array_push($numDia,31);

        $dias =array();
        if ($f1[0] == $f2[0]) {
            if ($f1[1] < $f2[1]) {
                for ($i =$f1[1];$i <= $f2[1];$i++) {
                    if ($i < $f2[1]) {
                        for ($j = $f1[2]; $j <= $numDia[$i - 1]; $j++) {
                            $result=mysqli_query($con,"select SUM(total) as s from venta WHERE month(fecha)=$i  and year(fecha)=$f1[0] and day(fecha)=$j ")or die(mysqli_error());
                            if($result){
                            $r=mysqli_fetch_array($result);
                            $rd=round($r['s'],2);
                            array_push($dias,$rd);
                               }
                        }
                    } else {
                        if ($i == $f2[1]) {
                            for ($y = 1; $y <= $f2[2]; $y++) {
                                $result1=mysqli_query($con,"select SUM(total) as s from venta WHERE month(fecha)=$i  and year(fecha)=$f1[0] and day(fecha)=$y ")or die(mysqli_error());
                            if($result1){
                            $r1=mysqli_fetch_array($result1);
                            $rd1=round($r1['s'],2);
                            array_push($dias,$rd1);
                               }
                            }
                        }  
                    }

                }

            } else {
                if ($f1[1] == $f2[1]) {
                    for ($s = $f1[2]; $s <= $f2[2]; $s++) {
                        $result2=mysqli_query($con,"select SUM(total) as s from venta WHERE month(fecha)=$f1[1] and year(fecha)=$f1[0] and day(fecha)=$s ")or die(mysqli_error());
                            if($result2){
                            $r2=mysqli_fetch_array($result2);
                            $rd2=round($r2['s'],2);
                            array_push($dias,$rd2);
                               }
                    }

                }
            }
        } else {
            if ($f1[0] < $f2[0]) {
                $cont = $f1[1];
                $contf = $f1[0];
                $ddddd = intval($f2[0] - 1);
                $sssss=intval($f2[1]);
                $vvvvv=intval($f1[1]);
                if ($vvvvv > $sssss) {
                    
                    $vuel = 13 - $f1[1];
                    $vue = $vuel + intval($f2[1]);
                    for ($z = 1; $z <= $vue; $z++) {
                        if ($contf == $ddddd) {
                            for ($b = $f1[2]; $b <= $numDia[$cont - 1]; $b++) {
                                $result3=mysqli_query($con,"select SUM(total) as s from venta WHERE month(fecha)=$vvvvv and year(fecha)=$f2[0] and day(fecha)=$b ")or die(mysqli_error());
                                if($result3){
                                $r3=mysqli_fetch_array($result3);
                                $rd3=round($r3['s'],2);
                                array_push($dias,$rd3);
                               }
                            } $vvvvv++;

                            if ($cont == 12) {
                                $contf++;
                            }
                            $cont++;
                        } else {
                            if ($contf == $f2[0]) {
                                for ($m = 1; $m <= $f2[1]; $m++) {
                                        if ($m < $f2[1]) {
                                            for ($c = 1; $c <= $numDia[$m - 1]; $c++) {
                                               $result5=mysqli_query($con,"select SUM(total) as s from venta WHERE month(fecha)=$m and year(fecha)=$f2[0] and day(fecha)=$c ")or die(mysqli_error());
                                               if($result5){
                                               $r5=mysqli_fetch_array($result5);
                                               $rd5=round($r5['s'],2);
                                              array_push($dias,$rd5);
                                              }
                                            }
                                        }else{
                                            if ($m == $f2[1]) {
                                        for ($g = 1;$g <= $f2[2]; $g++) {
                                            $result4=mysqli_query($con,"select SUM(total) as s from venta WHERE month(fecha)=$m and year(fecha)=$f2[0] and day(fecha)=$g ")or die(mysqli_error());
                                           if($result4){
                                            $r4=mysqli_fetch_array($result4);
                                               $rd4=round($r4['s'],2);
                                          array_push($dias,$rd4);
                                           }
                                        }
                                    }
                                        }
                                   $z++; 
                                }
                            }
                        }



                    }
                }else{}

            }

        }


    echo json_encode($dias); 

	
	
?>

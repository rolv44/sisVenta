<?php
	include('../php/conexion.php');
	$cn=new conexion();
    $con=$cn->conectar();
	$ini= $_POST['ini']; 
    $fin=$_POST['fin'];
    $listaVenta=array();

$c=0;
$rs1=mysqli_query($con,"SELECT * FROM `venta` GROUP BY tipo,id_venta DESC ORDER BY tipo,id_venta DESC")or die(mysqli_error()); 
 while($r=mysqli_fetch_array($rs1)){
       
       array_push($listaVenta,array( "id_venta"=>$r[0],"id_clie"=>$r[1],"usuario"=>$r[2],"nom_clie"=>$r[3],"id_carrito"=>$r[4],
                                "tipo"=>$r[5],"estado"=>$r[6],"pago"=>$r[7],"vuelto"=>$r[8],"total"=>$r[9],"fecha"=>$r[10],"descuento"=>$r[11],"nro_comp"=>$r[12],"vendedor"=>$r[13]
           ));
     
     
   }
  
    echo json_encode($listaVenta); 
  //select * from venta where id_venta BETWEEN '$ini' and '$fin' ORDER BY id_venta DESC
?>
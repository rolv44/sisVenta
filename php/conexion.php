<?php 

class conexion {

    function conectar(){
    	return mysqli_connect("jrdistribuidores.com","jrdistri_adminUs","admin98765","jrdistri_venta");
    }
}

 ?>
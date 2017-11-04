<?php
date_default_timezone_set('America/Lima');
include "producto.php";
include "conexion.php";
session_start();
class metodo_producto{
    
    public function fill_producto($id,$nombre,$descripcion,$marca,$cantidad,$pcompra,$pventa,$guia,$nprovee,$medida,$fecha,$codigo){
        
        $producto=new producto();
        
        $producto->set_id($id);
        $producto->set_nombre($nombre);
        $producto->set_descripcion($descripcion);
        $producto->set_marca($marca);
        $producto->set_cantidad($cantidad);
        $producto->set_pcompra($pcompra);
        $producto->set_pventa($pventa);
        $producto->set_guia($guia);
        $producto->set_nprovee($nprovee);
        $producto->set_medida($medida);
        $producto->set_fecha($fecha);
        $producto->set_codigo($codigo);
        
        return $producto;        
    }
    
    public function reg_producto($producto){
        $cn=new conexion();
        $con=$cn->conectar();
        
        $id=$producto->get_id();
        $n=$producto->get_nombre();
        $d=$producto->get_descripcion();
        $m=$producto->get_marca();
        $pc=$producto->get_pcompra();
        $pv=$producto->get_pventa();
        $c=$producto->get_cantidad();
        $md=$producto->get_medida();
        $g=$producto->get_guia();
        $np=$producto->get_nprovee();
        $f=$producto->get_fecha();
        $cd=$producto->get_codigo();
        
        $fecha=date('Y-m-d H:i:s');
        $usu=$_SESSION['usuario'];
        
        mysqli_query($con,"call ingresar_prod('$id','$n','$d','$m','$pc','$pv','$c','$md','$g','$np','$f')");
        mysqli_query($con,"insert into actual_stock values('$id','$n','0','$c','$g','$np','$usu','$fecha'); ");
        
    }
    
    public function show_prod(){
      
        
        
    }
    
}


?>
<?php

include "cliente.php";
include "conexion.php";

class metodo_clie{
    
    public function fill_cliente($id,$nombre,$razon,$dni,$ruc,$dire,$celu,$reff){
        
        $cliente=new cliente();
        
        $cliente->set_id($id);
        $cliente->set_nombre($nombre);
        $cliente->set_razon($razon);
        $cliente->set_dni($dni);
        $cliente->set_ruc($ruc);
        $cliente->set_dire($dire);
        $cliente->set_cel($celu);
        $cliente->set_ref($reff);
        return $cliente;        
    }
    
    
    public function reg_cliente($cliente){
        $cn=new conexion();
        $con=$cn->conectar();
        $refe=$cliente->get_ref();
        $id=$cliente->get_id();
        $n=$cliente->get_nombre();
        $r=$cliente->get_razon();
        $d=$cliente->get_dni();
        $ru=$cliente->get_ruc();
        $di=$cliente->get_dire();
        $c=$cliente->get_cel();
        mysqli_query($con,"insert into cliente values('$id','$n','$r','$d','$ru','$di','$c','$refe')")or die(mysqli_error());
       
    }
    
    
    
    
    
    
}



?>
<?php
//Clase encargada de manejar las vistas
class vistas
{   
    public function __CONSTRUCT(){
       
    }
    
    //Funcion que se encarga de cargar las vistas del usuario
    function vista($vista){
        include_once('vistas/layout/header.php');
        require "vistas/".$vista.".php";
        include_once('vistas/layout/footer.php');
    }
    //Funcion que se encarga de cargar las vistas del administrador
    function vistad($vista){
        include_once('vistas/layout/headeradmin.php');
        require "vistas/administrador/".$vista.".php";
        include_once('vistas/layout/footeradmin.php');
    }

    function vistan($vista){
        require "vistas/".$vista.".php";
    }
}
?>
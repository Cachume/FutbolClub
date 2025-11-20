<?php
session_start();
//Se guarda en la variable $url el valor proveniente la url de GET['u']
$url = $_GET['url'] ?? 'home';
$metodo = $_GET['m'] ?? 'index';
$partes= explode('/', trim($url));
// echo "Controlador: $url<br>";
// var_dump($partes);
$controlador = $partes[0] ?? 'home';
$controlador = strtolower($controlador); //Convertimos el controlador a minusculas

//Concatenamos el nombre del controlador llamado en la url para luego hacer su llamado
 $controlller="controlador/".$controlador.".php";

//Verificamos que el controlador solicitado exista
if(file_exists($controlller)){

    //Incluimos el controlador previamente solicitado
    require_once "modelo/database.php";
    require_once "controlador/vistas.php";
    require_once $controlller;

    //Instanciamos el controlador
    $cont= new $controlador;
    if(isset($partes[1]) && !empty($partes[1])){
        //Verificamos si el metodo llamado existe en el controlador
        if (method_exists($cont,$partes[1])) {
            //Si existe el metodo
            $cont->{$partes[1]}();
        }else{
            //Si el metodo no existe
            $cont->load();
        }
    }else{
        //Se carga la vista principal del controlador
        $cont->load();
    }
}else{
    //Si el controlador no existe
    require_once("vistas/404.php");
    exit();
}

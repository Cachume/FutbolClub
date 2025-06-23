<?php
    //clase login la cual hereda los metodo de la clase vistas
    class login extends vistas
    {   
        //Variable que guarda la conexion a al base de datos
        private $db;

        public function __CONSTRUCT(){

        }
        //Funcion que se encarga de cargar la vista principal del controlador
        public function load(){
            //Se hace el llamado de la funcion vista pasando como parametro la vista que vamos a cargar
            $this->vistan('user/login');
        }

        public function authUser(){
            echo "Vamos a logearnos";
        }
    }
    ?>
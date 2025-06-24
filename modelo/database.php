<?php
    //Clase modelo para el uso de base de datos
    class Database
    {   
        //Variable privada que almacena el parametro hostname de la base de datos
        private $hostname="localhost";
        //Variable privada que almacena el parametro contraseña de la base de datos
        private $password="";
        //Variable privada que almacena el parametro usuario de la base de datos
        private $user="root";
        //Variable privada que almacena el parametro nombre de la base de datos
        private $dbname="futbolclub";
        //Variable privada que almacena la conexion de la base de datos
        public $db;
        //funcion constructora que se ejecuta al crear la instancia de la clase
        public static function getDatabase(){
            try {
                $db = new PDO("mysql:host=localhost;dbname=futbolclub", "root", "");
                return $db;

            } catch (Exception $e) {
                return false;
            }
        }
      
    }
    ?>
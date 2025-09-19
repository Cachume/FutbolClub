<?php
    include_once 'modelo/usermodel.php';
    
    class Usuario extends vistas{

        public $data;
        public function __construct(){
            if(!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "user"){
                session_destroy();
                header("Location:/FutbolClub/login");
                exit();
            }
        }
        public function load(){
            $this->vistan('user/index');
        }

        public function misJugadores(){
            $rep_id = $_SESSION["cedula"];
            $this->data = userModel::getMysPlayers($rep_id);
            $this->vistan('user/misjugadores');
        }

        public function pagar(){
            $this->vistan('user/misjugadores_pagos');
        }
    }
?>
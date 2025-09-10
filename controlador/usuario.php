<?php
    class Usuario extends vistas{
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
            $this->vistan('user/misjugadores');
        }
    }
?>
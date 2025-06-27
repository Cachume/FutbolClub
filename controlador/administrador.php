<?php
    class administrador extends vistas{

        public function __construct(){
            if(!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "admin"){
                session_destroy();
                header("Location:/FutbolClub/login");
                exit();
            }
        }

        public function load(){
            $this->vistan('administrador/index');
            // echo loginModel::createAdmin();
        }

        public function salir(){
            session_unset();
            session_destroy();
            echo "<script>alert('Sesion Cerrada')</script>";
            header("Location:/FutbolClub/login");
        }

    }
?>
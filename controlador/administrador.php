<?php
    class administrador extends vistas{

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
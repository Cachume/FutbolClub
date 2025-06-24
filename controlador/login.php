<?php
require_once "modelo/loginmodel.php";
    class login extends vistas{

        public function load(){
            $this->vistan('user/login');
            // echo loginModel::createAdmin();
        }

        public function autenticar(){
            echo "estamos en autenticar";
            if(isset($_POST["iniciarsesion"])){
                $datos = array(
                    "email" => $_POST["email"],
                    "password" => $_POST["password"]
                );
                $auth = loginModel::ingresoUsuario($datos,"usuarios");
                var_dump($auth);
                if($auth != "error"){
                    if(password_verify($datos["password"], $auth["contraseña"])){
                        echo "<script>alert('Sesion iniciada')</script>";
                    }else{
                        echo "<script>alert('Sesion no iniciada')</script>";
                    }
                }else{
                    echo "<script>alert('Sesion no existe')</script>";
                    }
            }else{
            header("Location:/FutbolClub/login");
        }
            // print_r($_POST);
        }
    }


?>
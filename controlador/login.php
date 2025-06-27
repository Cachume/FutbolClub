<?php
require_once "modelo/loginmodel.php";
    class login extends vistas{

        public function load(){
            $this->vistan('user/login');
            // echo loginModel::createAdmin();
        }

        public function autenticar(){
            // echo "estamos en autenticar";
            if(isset($_POST["iniciarsesion"])){
                $datos = array(
                    "email" => $_POST["email"],
                    "password" => $_POST["password"]
                );
                $auth = loginModel::ingresoUsuario($datos,"usuarios");
                if($auth != "error"){
                    if(password_verify($datos["password"], $auth["contraseña"])){
                        $_SESSION["username"] = $auth["nombre_usuario"];
                        $_SESSION["email"] = $auth["email"];
                        $_SESSION["rol"] = $auth["rol"];
                        if($auth["rol"]=="admin"){
                            echo "<script>alert('Sesion iniciada')</script>";
                            header("Location:/FutbolClub/administrador");
                        }else{
                            session_destroy();
                            echo "<script>alert('Aun no se permite el ingreso de usuarios comunes')</script>";
                            $this->vistan('user/login');
                        }
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
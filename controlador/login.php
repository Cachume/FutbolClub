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
                var_dump ($auth);
                echo "<br>";
                if($auth){
                    if(password_verify($datos["password"], $auth["contraseña"])){
                        $_SESSION["username"] = $auth["nombre_usuario"];
                        $_SESSION["email"] = $auth["email"];
                        $_SESSION["rol"] = $auth["rol"];
                        if($auth["rol"]=="admin"){
                            echo "<script>alert('Sesion iniciada')</script>";
                            header("Location:/FutbolClub/administrador");
                        }else{
                            session_destroy();
                            $this->vistan('user/login');
                        }
                    }else{
                        echo "<script>alert('Sesion no iniciada')</script>";
                    }
                }else{
                    $auth = loginModel::ingresoUsers($datos,"representantes");
                    if($auth){
                        if(password_verify($datos["password"], $auth["passwordp"])){
                            $_SESSION["username"] = $auth["nombre_completo"];
                            $_SESSION["email"] = $auth["correo"];
                            $_SESSION["foto"] = $auth["foto"];
                            $_SESSION["rol"] = "user";
                            $_SESSION["cedula"] = $auth["cedula"];
                            $_SESSION["id"] = $auth["id"];
                            echo "<script>alert('Sesion iniciada')</script>";
                            header("Location:/FutbolClub/usuario");
                        }else{
                            session_destroy();
                            $this->vistan('user/login');
                        }
                    }else{
                        header("Location:/FutbolClub/login");
                        session_destroy();
                    }
                }
            }else{
            header("Location:/FutbolClub/login");
        }
            // print_r($_POST);
        }
    }


?>
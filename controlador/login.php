<?php
require_once "modelo/loginmodel.php";
    class login extends vistas{

        public function __CONSTRUCT()
        {
            if(isset($_SESSION["rol"])){
                if($_SESSION["rol"] == "user"){
                    header("Location:/FutbolClub/usuario");
                }else{
                  header("Location:/FutbolClub/administrador"); 
                }
                exit();
            }
        }

        public function load(){
            $this->vistan('user/login');
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
                            $_SESSION['toast_type'] = 'success';
                            $_SESSION['toast_message'] = 'Has iniciado sesión Correctamente.';
                            header("Location:/FutbolClub/administrador");
                            return;
                        }else{
                            $_SESSION['toast_type'] = 'errror';
                            $_SESSION['toast_message'] = 'Correo o Contraseña incorrecto.';
                            $this->vistan('user/login');
                        }
                    }else{
                        header("Location:/FutbolClub/login");
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
                            $_SESSION['toast_type'] = 'success';
                            $_SESSION['toast_message'] = 'Has iniciado sesión Correctamente.';
                            header("Location:/FutbolClub/usuario");
                            return;
                        }else{
                            $_SESSION['toast_type'] = 'errror';
                            $_SESSION['toast_message'] = 'Correo o Contraseña incorrecto.';
                            $this->vistan('user/login');
                        }
                    }else{
                        $_SESSION['toast_type'] = 'errror';
                        $_SESSION['toast_message'] = 'Correo o Contraseña incorrecto.';
                        header("Location:/FutbolClub/login");
                    }
                }
            }else{
            header("Location:/FutbolClub/login");
        }
            header("Location:/FutbolClub/login");
        }
    }


?>
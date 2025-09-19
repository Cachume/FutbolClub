<?php
    //clase login la cual hereda los metodo de la clase vistas
    require_once "database.php";
    class loginModel extends Database
    {   
        public static function createAdmin(){
            // Implement logic to create an admin user
            $password = password_hash('admin123', PASSWORD_DEFAULT);
            $usuario = "Administrador";
            $email = "admin@futbolclub.com";
            $rol = "admin";
            $stmt = Database::getDatabase()->prepare("INSERT INTO usuarios (nombre_usuario, email ,contraseña, rol) VALUES (:usuario, :email, :password, :rol)");
            $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->bindParam(":rol", $rol, PDO::PARAM_STR);
            if($stmt->execute()){
                return "success";
            }else{
                return "error";
            }
        }
        public static function ingresoUsuario($datos, $tabla){
            $stmt = Database::getDatabase()->prepare("SELECT nombre_usuario, email ,contraseña,rol FROM $tabla WHERE email = :email");
            $stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
            $stmt->execute();
            //Obtiene una fila de resultados
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public static function ingresoUsers($datos, $tabla){
            $stmt = Database::getDatabase()->prepare("SELECT nombre_completo, correo ,passwordp, foto, cedula ,id FROM $tabla WHERE correo = :email");
            $stmt->bindParam(":email", $datos['email'], PDO::PARAM_STR);
            $stmt->execute();
            //Obtiene una fila de resultados
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
    ?>
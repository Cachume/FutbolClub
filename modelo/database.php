<?php
    //Clase modelo para el uso de base de datos
    class database extends vistas
    {   
        //Variable privada que almacena el parametro hostname de la base de datos
        private $hostname="localhost";
        //Variable privada que almacena el parametro contraseña de la base de datos
        private $password="";
        //Variable privada que almacena el parametro usuario de la base de datos
        private $user="root";
        //Variable privada que almacena el parametro nombre de la base de datos
        private $dbname="dbcarnet";
        //Variable privada que almacena la conexion de la base de datos
        private $db;
        //funcion constructora que se ejecuta al crear la instancia de la clase
        public function __CONSTRUCT(){
            try {
                $this->db = new mysqli($this->hostname, $this->user, $this->password, $this->dbname);
                $this->crearUsuarioAdministrador();
            } catch (Exception $e) {
                $this->vista('error2');
                exit();
            }
        }
        //Funcion para insertar datos en la tablas donde se necesitan 3 valores Nombre de la tabla, campos de la tabla y los valores
        public function insertar($tabla, $campos, $valores){
            try {
                //Se concatenan los datos pedidos por la funcion para crear la instruccion sql
                $sql="INSERT INTO ".$tabla." (".$campos.") VALUES (".$valores.")";
                //Ejecutamos la consulta
                return $this->db->query($sql);
            } catch (Exception $th) {
                return false;
            }
        }
        private function crearUsuarioAdministrador() {
            $consulta = $this->selecionar("id", "usuarios", "WHERE id=1");
            $password = password_hash("Admin.00", PASSWORD_BCRYPT);
    
            if ($consulta->num_rows < 1) {
                $this->insertar("usuarios", "nombres, apellidos, cdi, rol, correo, contrasena", "'Admistrador', 'Administrador', 0, 1, 'admin@gmail.com', '$password'");
            }
        }
        public function selecionar($campos,$tabla, $condicion){
            try {
                $sql="SELECT ".$campos." FROM ".$tabla." ".$condicion;
                return $this->db->query($sql);
            } catch (Exception $th) {
                return false;
            }
        }

        public function eliminar($tabla, $condicion){
            try {
                $sql="DELETE FROM ".$tabla." WHERE ".$condicion;
                return $this->db->query($sql);
            } catch (Exception $th) {
                return false;
            }
        }

        public function mostrar($campos,$tabla, $condicion){
            try {
                $sql="DELETE FROM ".$tabla." WHERE ".$condicion;
                $datos=array();
                $sql="SELECT ".$campos." FROM ".$tabla." ".$condicion;
                $resul=$this->db->query($sql);
                if ($resul->num_rows > 0) {
                    while ($fila = $resul->fetch_assoc()) {
                        $datos[]=$fila;
                    }
                    return $datos;
                }else{
                    return false;
                }
            } catch (Exception $th) {
                return false;
            }
        }
        public function actualizar($campos,$tabla, $condicion){
            try {
                $sql="UPDATE ".$tabla." SET ".$campos." WHERE ".$condicion;
                return $this->db->query($sql);
            } catch (Exception $th) {
                return false;
            }
        }
    }
    ?>
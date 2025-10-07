<?php
    include_once 'modelo/usermodel.php';
    
    class Usuario extends vistas{

        public $data;
        public $pago;
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
            $rep_id = $_SESSION["cedula"];
            $this->data = userModel::getMyPayments($rep_id);
            $this->vistan('user/misjugadores_pagos');
        }

        public function historial(){
            $rep_id = $_SESSION["cedula"];
            $this->data = userModel::getMyPaymentsHistory($rep_id);
            $this->vistan('user/misjugadores_pagoshistorial');
        }

        public function pagarPost(){
            print_r($_POST);
            print_r($_FILES);
            $rep_id = $_SESSION["cedula"];
            if(isset($_POST['metodo_pago_hidden']) && isset($_POST['fecha_pago']) && isset($_POST['monto_pago']) && isset($_FILES['comprobante'])){
                $metodo_pago = $_POST['metodo_pago_hidden'];
                $fecha_pago = $_POST['fecha_pago'];
                $monto_pago = $_POST['monto_pago'];
                $descripcion_pago = $_POST['descripcion_pago'];
                $comprobante_pago = $_FILES['comprobante'];
                $referencia = $_POST['referencia'] ?? null;
                $idpago = $_POST['id_pago'];

                // Validar y procesar el archivo subido
                $target_dir = "uploads/pagos/";
                $target_file = $target_dir . basename($comprobante_pago["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // Verificar si el archivo es una imagen real o falsa
                $check = getimagesize($comprobante_pago["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "El archivo no es una imagen.";
                    $uploadOk = 0;
                }
                // Limitar el tamaño del archivo
                if ($comprobante_pago["size"] > 500000) {
                    echo "Lo siento, el archivo es demasiado grande.";
                    $uploadOk = 0;
                }
                // Permitir ciertos formatos de archivo
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG & GIF.";
                    $uploadOk = 0;
                }

                // Verificar si $uploadOk está configurado a 0 por un error
                if ($uploadOk == 0) {
                    echo "Lo siento, tu archivo no fue subido.";
                // Si todo está bien, intenta subir el archivo
                } else {
                    if (move_uploaded_file($comprobante_pago["tmp_name"], $target_file)) {
                        echo "El archivo ". htmlspecialchars( basename( $comprobante_pago["name"])). " ha sido subido.";
                        // Aquí puedes guardar la información del pago en la base de datos
                        userModel::guardarPago($metodo_pago, $fecha_pago, $monto_pago, $descripcion_pago,$rep_id,$target_file,$referencia,$idpago);
                        header("Location:/FutbolClub/usuario/pagar");
                    }
                }
            } else {
                echo "Faltan datos del formulario.";
            }
        }

        public function pago(){
            $rep_id = $_SESSION["cedula"];
            $url = $_GET['url'] ?? 'login';
            $partes= explode('/', trim($url));
            $this->pago = intval($partes[2]);
            $validar = userModel::validarAccesoPago(intval($partes[2]),$rep_id);
            if($validar){
                $this->data = userModel::DatosdePago(intval($partes[2]),$rep_id);
                $this->vistan('user/pago');
            }else{
                header("Location:/FutbolClub/usuario");
            }
        }
    }
?>
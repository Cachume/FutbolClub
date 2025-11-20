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

        public function pagarPost()
{
    // print_r($_POST);
    // print_r($_FILES);

    $rep_id = $_SESSION["cedula"];
    $metodo_pago = $_POST['metodo_pago_hidden'] ?? null;
    $monto_pago = $_POST['monto_pago'] ?? null;
    $idpago = $_POST['id_pago'] ?? null;

    // 1. **Verificación Mínima Requerida** (Método y Monto)
    if (empty($metodo_pago) || empty($monto_pago) || empty($idpago)) {
        echo "Faltan datos esenciales del formulario (Método, Monto o ID de pago).";
        return;
    }

    $descripcion_pago = $_POST['descripcion_pago'] ?? '';
    
    // Asignación de valores por defecto si no vienen
    $fecha_pago = $_POST['fecha_pago'] ?? date('Y-m-d'); // Usar fecha actual si no viene
    $referencia = $_POST['referencia'] ?? 'N/A';
    $comprobante_path = 'N/A'; // Valor por defecto

    $es_efectivo = ($metodo_pago === 'efectivo');
    $pago_exitoso = false; // Flag para determinar si el pago se guardó

    // 2. **Procesamiento Condicional del Comprobante (Si NO es Efectivo)**
    if (!$es_efectivo) {
        $comprobante_pago = $_FILES['comprobante'] ?? null;

        // 2a. Validar que el archivo exista si el método NO es efectivo
        if (!isset($comprobante_pago) || $comprobante_pago['error'] === UPLOAD_ERR_NO_FILE) {
             echo "Falta el archivo de comprobante para este método de pago.";
             return;
        }

        // --- Lógica de Validación de Archivos (Mantenida) ---
        $target_dir = "uploads/pagos/";
        // Generar un nombre único para el archivo para evitar sobrescribir
        $file_name = uniqid('comp_') . "_" . basename($comprobante_pago["name"]);
        $target_file = $target_dir . $file_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // ... (El resto de tu lógica de validación de imagen aquí)
        // Verificar si es imagen, tamaño, tipo, etc.

        $check = getimagesize($comprobante_pago["tmp_name"]);
        if($check === false) { $uploadOk = 0; }
        if ($comprobante_pago["size"] > 500000) { $uploadOk = 0; }
        if(!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) { $uploadOk = 0; }
        // --- Fin Lógica de Validación de Archivos ---

        if ($uploadOk == 0) {
            echo "Lo siento, tu archivo no fue subido o no pasó la validación.";
            return;
        } else {
            // Intento de mover el archivo
            if (move_uploaded_file($comprobante_pago["tmp_name"], $target_file)) {
                $comprobante_path = $target_file; // Guardamos la ruta para la DB
                $pago_exitoso = true;
            } else {
                echo "Hubo un error al subir el archivo.";
                return;
            }
        }
    } else {
        // Si es efectivo, el procesamiento del comprobante se salta,
        // y el pago es considerado exitoso si pasamos la validación inicial.
        $pago_exitoso = true;
    }
    
    // 3. **Guardar el Pago en la Base de Datos**
    if ($pago_exitoso) {
        $cedula = $_SESSION['cedula'];
        // userModel::guardarPago(metodo, fecha, monto, descripcion, rep_id, comprobante_path, referencia, idpago)
        userModel::guardarPago(
            $metodo_pago,
            $fecha_pago,
            $monto_pago,
            $descripcion_pago,
            $rep_id,
            $comprobante_path, 
            $referencia,     
            $idpago
        );
        echo "El pago ha sido procesado exitosamente.";
        // Si todo está bien, redirige
        header("Location:/FutbolClub/usuario/pagar");
        exit;
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
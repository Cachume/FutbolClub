<?php
require_once "modelo/adminmodel.php";
require_once __DIR__ . "/../validations/generalValidations.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';    

class administrador extends vistas{
        public $erroresf;
        public $jugadores;
        public $trainers;
        public $categorys;
        public $categoria;
        public $data;

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
        public function nuevojugador(){
            if(isset($_SESSION["cedular"])){
                $this->vistan('administrador/players_new');
            }else{
               header("Location:/FutbolClub/administrador/verificacionjugador");
            } 
        }
        
        public function listajugadores(){
            $this->jugadores = adminModel::getAllPlayers();
            $this->vistan('administrador/players_list');
        }
        public function representantes_lista(){
            $this->jugadores = adminModel::getAllRepresentatives();
            // var_dump($this->jugadores); 
            $this->vistan('administrador/representative_list');
        }

        public function new_representantes(){
            $this->vistan('administrador/representative_new');
        }

        public function verificacionjugador(){
            $this->vistan('administrador/player_verification');
        }

        public function generarpago(){
            $this->data = adminModel::getCategorys();
            $this->vistan('administrador/payment_new');
        }
        public function metodos_pago(){
            $this->data = adminModel::getMetodosPago();
            $this->vistan('administrador/metodo_pagos');
        }

        public function pagos_lista(){
            $this->data = adminModel::getPagos();
            $this->vistan('administrador/lista_pagos');
        }

        public function nuevopago(){
            print_r($_POST);
            echo "<br>";
            if( isset($_POST['nombrepago']) || 
                isset($_POST['descripcion']) || 
                isset($_POST['montopago']) ||
                isset($_POST['categorias'])){
                    echo "Todo correcto";
                    echo "<br>";
                    echo implode(',', $_POST['categorias']);
                    $data = [
                        'nombre'=> $_POST['nombrepago'],
                        'descripcion'=> $_POST['descripcion'],
                        'monto' => floatval($_POST['montopago']),
                        'categorias'=> $_POST['categorias']
                    ];
                    $pagodb = adminModel::createPago($data);
                    echo "<br>";
                    echo "<br>";
                    var_dump($pagodb);
                }
        }

        public function get_representative(){
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['id'];
                $representante = adminModel::getRepresentativeById($id);
                header('Content-Type: application/json');
                if($representante) {
                    echo json_encode(["success" => true, "data" => $representante]);
                } else {
                    echo json_encode(["success" => false, "message" => "Representante no encontrado"]);
                }
            }
        }

        public function update_representative(){
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(isset($_POST['id'], $_POST['nombre'], $_POST['fecha_nacimiento'], $_POST['cedula'], $_POST['telefono'], $_POST['correo'], $_POST['direccion'])) {
                    $data = [
                        'id' => $_POST['id'],
                        'nombre_completo' => $_POST['nombre'],
                        'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                        'cedula' => $_POST['cedula'],
                        'telefono' => $_POST['telefono'],
                        'correo' => $_POST['correo'],
                        'direccion' => $_POST['direccion']
                    ];
                    if($data['id'] == "" || $data['nombre_completo'] == "" || $data['fecha_nacimiento'] == "" || $data['cedula'] == "" || $data['telefono'] == "" || $data['correo'] == "" || $data['direccion'] == ""){
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios"]);
                        exit;
                    }

                    if (!GeneralValidations::validateEmail($data['correo'])) {
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "Correo electrónico inválido"]);
                        exit;
                    }

                    if (!GeneralValidations::validateNames($data['nombre_completo'])) {
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "El nombre solo puede contener letras y espacios"]);
                        exit;
                    }

                    if (!GeneralValidations::validateCedula($data['cedula'])) {
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "Cédula debe ser solo números y máximo 8 dígitos"]);
                        exit;
                    }

                    if (!GeneralValidations::validatePhone($data['telefono'])) {
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "Teléfono debe ser solo números y máximo 11 dígitos"]);
                        exit;
                    }

                    $existingRepresentative = adminModel::useDni($data['cedula'],'representantes');
                    if ($existingRepresentative && $existingRepresentative['id'] != $data['id']) {
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "La cédula ya está en uso por otro representante"]);
                        exit;
                    }

                    $existingRepresentative = adminModel::useEmail($data['correo'],'representantes');
                    if ($existingRepresentative && $existingRepresentative['id'] != $data['id']) {
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "El correo electrónico ya está en uso por otro representante"]);
                        exit;
                    }

                    $actualizado = adminModel::updateRepresentative($data);
                    header('Content-Type: application/json');
                    if($actualizado === "success") {
                        echo json_encode(["success" => true, "message" => "Representante actualizado correctamente"]);
                    } else {
                        echo json_encode(["success" => false, "message" => "Error al actualizar el representante"]);
                    }
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
                }
            }
        }

        public function RepresentativeDelete()
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $representante = $_POST['id'];
                $existe = adminModel::representanteExiste(intval($representante));
                //echo $representante;
                //var_dump($existe);
                header('Content-Type: application/json');
                if($existe) {
                    adminModel::deleteRepresentative($representante);
                    echo json_encode(["message" => true]);
                } else {
                    echo json_encode(["message" => false]);
                }
            }
        }

        public function categorias(){
            $this->trainers = adminModel::getTrainers();
            $this->categorys = adminModel::getCategorys();
            $this->vistan('administrador/categorys');
        }

        public function editcategorias(){
            $id = $_GET['id'] ?? null;

            if ($id) {
                $this->trainers = adminModel::getTrainers();
                $this->categoria = adminModel::getCategoryById($id);
                // var_dump($this->categoria);
                $this->vistan('administrador/editcategory');
            } else {
                $this->categorias();
                exit;
            }
            
        }
        public function updateCategory(){
            print_r($_POST);
            $data = [
                'id' => $_POST['id'],
                'ncategoria' => $_POST['nombre_categoria'],
                'periodo' => $_POST['periodo'],
                'entrenador' => $_POST['entrenador_id'],
                'horario' => $_POST['horario']
            ];

            $result = adminModel::updateCategory($data);
            if ($result === "success") {
                header("Location:/FutbolClub/administrador/categorias?success=Categoria actualizada correctamente");
            } else {
                header("Location:/FutbolClub/administrador/categorias?error=Error al actualizar la categoría");
            }
        }

                public function addCategory(){
            print_r($_POST);
            $data = [
                'ncategoria' => $_POST['nombre_categoria'],
                'periodo' => $_POST['periodo'],
                'entrenador' => $_POST['entrenador_id'],
                'horario' => $_POST['horario']
            ];
            $accion = adminModel::createCategory($data);
            if($accion == "success"){
                header("Location:/FutbolClub/administrador/categorias?success=Categoria creada correctamente");
            } elseif ($accion == "error"){
                header("Location:/FutbolClub/administrador/categorias?error=Error al crear la categoría");
            }
        }

        public function vefCategory(){
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $categoria = $_POST['categoria'];
                $existe = adminModel::existCategory($categoria);
                header('Content-Type: application/json');
                if($existe == 1) {
                    echo json_encode(["message" => true]);
                } else {
                    echo json_encode(["message" => false]);
                }
            }
        }

        public function categoryDelete()
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $categoria = $_POST['id'];
                $existe = adminModel::existCategoryID(intval($categoria));
                //echo $categoria;
                //var_dump($existe);
                header('Content-Type: application/json');
                if($existe == 1) {
                    adminModel::deleteCategory($categoria);
                    echo json_encode(["message" => true]);
                } else {
                    echo json_encode(["message" => false]);
                }
            }
        }

        public function nuevoentrenador() {
            $this->vistan('administrador/trainer_new');
        }

        public function entrenadores_lista() {
            $this->trainers = adminModel::getTrainers();
            $this->vistan('administrador/trainer_list');
        }

        public function get_trainer(){
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['id'];
                $entrenador = adminModel::getTrainerById($id);
                header('Content-Type: application/json');
                if($entrenador) {
                    echo json_encode(["success" => true, "data" => $entrenador]);
                } else {
                    echo json_encode(["success" => false, "message" => "Entrenador no encontrado"]);
                }
            }
        }

        public function update_trainer(){
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(isset($_POST['id'], $_POST['nombre'], $_POST['fecha_nacimiento'], $_POST['cedula'], $_POST['telefono'], $_POST['correo'], $_POST['direccion'])) {
                    $data = [
                        'id' => $_POST['id'],
                        'nombre_completo' => $_POST['nombre'],
                        'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                        'cedula' => $_POST['cedula'],
                        'telefono' => $_POST['telefono'],
                        'correo' => $_POST['correo'],
                        'direccion' => $_POST['direccion']
                    ];

                    if($data['id'] == "" || $data['nombre_completo'] == "" || $data['fecha_nacimiento'] == "" || $data['cedula'] == "" || $data['telefono'] == "" || $data['correo'] == "" || $data['direccion'] == ""){
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios"]);
                        exit;
                    }

                    if (!GeneralValidations::validateEmail($data['correo'])) {
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "Correo electrónico inválido"]);
                        exit;
                    }

                    if (!GeneralValidations::validateNames($data['nombre_completo'])) {
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "El nombre solo puede contener letras y espacios"]);
                        exit;
                    }

                    if (!GeneralValidations::validateCedula($data['cedula'])) {
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "Cédula debe ser solo números y máximo 8 dígitos"]);
                        exit;
                    }

                    if (!GeneralValidations::validatePhone($data['telefono'])) {
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "Teléfono debe ser solo números y máximo 11 dígitos"]);
                        exit;
                    }

                    $existingRepresentative = adminModel::useDni($data['cedula'],'entrenadores');
                    if ($existingRepresentative && $existingRepresentative['id'] != $data['id']) {
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "La cédula ya está en uso por otro representante"]);
                        exit;
                    }

                    $existingRepresentative = adminModel::useEmail($data['correo'],'entrenadores');
                    if ($existingRepresentative && $existingRepresentative['id'] != $data['id']) {
                        header('Content-Type: application/json');
                        echo json_encode(["success" => false, "message" => "El correo electrónico ya está en uso por otro representante"]);
                        exit;
                    }

                    $actualizado = adminModel::updateTrainer($data);
                    header('Content-Type: application/json');
                    if($actualizado === "success") {
                        echo json_encode(["success" => true, "message" => "Entrenador actualizado correctamente"]);
                    } else {
                        echo json_encode(["success" => false, "message" => "Error al actualizar el entrenador"]);
                    }
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
                }
            }
        }

        public function TrainerDelete()
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $entrenador = $_POST['id'];
                $existe = adminModel::getTrainerById(intval($entrenador));
                //echo $representante;
                //var_dump($existe);
                header('Content-Type: application/json');
                if($existe) {
                    adminModel::deleteTrainer($entrenador);
                    echo json_encode(["message" => true]);
                } else {
                    echo json_encode(["message" => false]);
                }
            }
        }

        public function usedDni() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                header('Content-Type: application/json');

                $dni = $_POST['dni'] ?? null;
                $id  = $_POST['id'] ?? null;

                if (!$dni) {
                    echo json_encode(["success" => false, "message" => "DNI no enviado"]);
                    return;
                }
                $existing = adminModel::useDni($dni, 'entrenadores');

                if ($id !== null) {
                    if ($existing) {
                        if ($existing['id'] == $id) {
                            echo json_encode(["exists" => false, "message" => "DNI permitido (mismo usuario)"]);
                        } else {
                            echo json_encode(["exists" => true, "message" => "DNI ya registrado en otro usuario"]);
                        }
                    } else {
                        echo json_encode(["exists" => false, "message" => "DNI libre"]);
                    }

                } else {
                    if ($existing) {
                        echo json_encode(["exists" => true, "message" => "DNI ya registrado"]);
                    } else {
                        echo json_encode(["exists" => false, "message" => "DNI libre"]);
                    }
                }
            }
        }

        public function usedEmail() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header('Content-Type: application/json');

            $email = $_POST['email'] ?? null;
            $id    = $_POST['id'] ?? null;

            if (!$email) {
                echo json_encode(["success" => false, "message" => "Email no enviado"]);
                return;
            }
            $existingEmail = adminModel::useEmail($email, 'entrenadores');
            if ($id !== null) {
                if ($existingEmail) {
                    if ($existingEmail['id'] == $id) {
                        echo json_encode(["exists" => false, "message" => "Email permitido (mismo usuario)"]);
                    } else {
                        echo json_encode(["exists" => true, "message" => "Email ya registrado en otro usuario"]);
                    }
                } else {
                    echo json_encode(["exists" => false, "message" => "Email libre"]);
                }
            } else {
                if ($existingEmail) {
                    echo json_encode(["exists" => true, "message" => "Email ya registrado"]);
                } else {
                    echo json_encode(["exists" => false, "message" => "Email libre"]);
                }
            }
        }
    }


        public function informacionjugador() {
            if (isset($_GET['player']) && !empty($_GET['player'])) {
                $cedula = $_GET['player'];
                $this->jugadores = adminModel::getPlayerWithDetails($cedula);
                if ($this->jugadores) {
                    $this->vistan('administrador/player_info');
                } else {
                    header("Location:/FutbolClub/administrador/listajugadores");
                }
            } else {
                header("Location:/FutbolClub/administrador/listajugadores");
            }
        }
        
        public function salir(){
            session_unset();
            session_destroy();
            echo "<script>alert('Sesion Cerrada')</script>";
            header("Location:/FutbolClub/login");
        }

        public function verificacionRe(){
            print_r($_POST);
            if(isset($_POST["vefref"])){
                $cedula = htmlspecialchars($_POST["cedula-representante"]);
                if(adminModel::representanteExiste($cedula)){
                    $_SESSION["cedular"] = $cedula;
                   header("Location:/FutbolClub/administrador/nuevojugador?r=$cedula");

                }else{
                    header("Location:/FutbolClub/administrador/new_representantes");
                }
            }else{
                header("Location:/FutbolClub/administrador/verificacionjugador");
            }
        }

    public function addPlayer() {
        $errores = [];
        $datos = $_POST;
        $archivo = $_FILES;

        // Función para calcular la categoría automáticamente
        function determinarCategoria($birthYear) {
            if ($birthYear >= 2020 && $birthYear <= 2021) return "Sub-5";
            if ($birthYear >= 2018 && $birthYear <= 2019) return "Sub-7";
            if ($birthYear >= 2016 && $birthYear <= 2017) return "Sub-9";
            if ($birthYear >= 2014 && $birthYear <= 2015) return "Sub-11";
            if ($birthYear >= 2012 && $birthYear <= 2013) return "Sub-13";
            if ($birthYear >= 2010 && $birthYear <= 2011) return "Sub-15";
            if ($birthYear >= 2008 && $birthYear <= 2009) return "Sub-17";
            return "Sin categoría";
        }

        // --- Validaciones básicas ---
        if (empty($datos['player-dni']) || !is_numeric($datos['player-dni'])) {
            $errores[] = "La cédula del jugador es inválida.";
        }

        if (empty($datos['player-name']) || !preg_match('/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/', $datos['player-name'])) {
            $errores[] = "El nombre del jugador es inválido.";
        }

        if (empty($datos['player-lastname']) || !preg_match('/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/', $datos['player-lastname'])) {
            $errores[] = "El apellido del jugador es inválido.";
        }

        if (empty($datos['player-birthdate']) || !strtotime($datos['player-birthdate'])) {
            $errores[] = "La fecha de nacimiento no es válida.";
        } else {
            $anioNacimiento = (int)date('Y', strtotime($datos['player-birthdate']));
            if ($anioNacimiento < 2008 || $anioNacimiento > 2021) {
                $errores[] = "El año de nacimiento debe estar entre 2008 y 2021.";
            }
            // Asignar categoría automáticamente
            $datos['player-category'] = determinarCategoria($anioNacimiento);
        }

        if (empty($datos['player-gender']) || !in_array($datos['player-gender'], ['M', 'F'])) {
            $errores[] = "Debe seleccionar un género válido.";
        }

        if (empty($datos['player-shirt']) || strlen($datos['player-shirt']) > 20) {
            $errores[] = "El nombre de la camiseta es obligatorio y debe tener menos de 20 caracteres.";
        }

        // Cedula del representante opcional
        $cedulaRepresentante = null;
        if (!empty($datos['player-representative-dni'])) {
            if (!is_numeric($datos['player-representative-dni'])) {
                $errores[] = "La cédula del representante no es válida.";
            } else {
                $cedulaRepresentante = intval($datos['player-representative-dni']);
            }
        }

        // --- Validación y movimiento de imagen ---
        $rutaDestino = '';
        if (isset($archivo['player-image']) && $archivo['player-image']['error'] === UPLOAD_ERR_OK) {
            $tipo = mime_content_type($archivo['player-image']['tmp_name']);
            $dimensiones = getimagesize($archivo['player-image']['tmp_name']);

            if (!in_array($tipo, ['image/jpeg', 'image/png', 'image/jpg'])) {
                $errores[] = "La imagen debe ser JPG o PNG.";
            }

            if ($dimensiones[0] !== 250 || $dimensiones[1] !== 250) {
                $errores[] = "La imagen debe tener exactamente 250x250 píxeles.";
            }

            if (empty($errores)) {
                $ext = pathinfo($archivo['player-image']['name'], PATHINFO_EXTENSION);
                $nombreArchivo = 'jugador_' . $datos['player-dni'] . '.' . $ext;
                $directorio = 'uploads/jugadores/';

                if (!is_dir($directorio)) {
                    mkdir($directorio, 0755, true);
                }

                $rutaDestino = $directorio . $nombreArchivo;

                if (!move_uploaded_file($archivo['player-image']['tmp_name'], $rutaDestino)) {
                    $errores[] = "No se pudo guardar la imagen en el servidor.";
                }
            }

        } else {
            $errores[] = "Debe subir una imagen válida.";
        }

    if (empty($errores)) {
        $playerYear = explode("-",$datos['player-birthdate']);
        $playerData = [
            'cedula' => intval($datos['player-dni']),
            'nombres' => trim($datos['player-name']),
            'apellidos' => trim($datos['player-lastname']),
            'fecha_nacimiento' => date('Y-m-d', strtotime($datos['player-birthdate'])),
            'genero' => $datos['player-gender'],
            'categoria' => adminModel::getCategorysDetails(intval($playerYear[0])),
            'nombre_camiseta' => trim($datos['player-shirt']),
            'cedula_representante' => $cedulaRepresentante,
            'foto' => $rutaDestino
        ];
        $mail_body= '
                    <div style="font-family: Arial, sans-serif; font-size: 14px; line-height: 1.5; background-color: #f4f4f4; padding: 20px; border: 1px solid #ddd; border-radius: 5px; max-width: 600px; margin: auto;">
                    <div style="text-align: center;">
                        <h2 style="margin: 0px; color:#8b51d0;">FUTBOL CLUB</h2>
                        <strong style="color:#188d32;">AGUA DULCE</strong>
                    </div>
                    <div>
                        <p style="text-align: center;">Estimado Representante, se ha registrado a un Jugador en su Perfil</p>
                        <p style="text-align: center;">Le informamos que se ha registrado a <strong>'.$playerData['nombres'].'</strong> en el Sistema de Gestión de Futbol Club.</p>
                        <h4>Sus Credenciales son las siguientes:</h4>
                        <p>Nombre Completo: <strong>'.$playerData['nombres'].' '.$playerData['apellidos'].'</strong></p>
                        <p>Cedula: <strong>'.$playerData['cedula'].'</strong></p>
                        <p>Categoria: <strong>'.$playerData['categoria'].'</strong></p>
                        <p>Le recomendamos iniciar sesion en su perfil para ver mas informacion.</p>
                        <div class="mail-body-links" style="display: flex; justify-content: center;">
                            <a href="#" style="color: white; text-decoration: none; background-color: #8b51d0; padding: 10px 15px; border-radius: 5px;">Ir a Iniciar Sesión</a>
                        </div>
                    </div>
                </div>';

        $resultao = adminModel::createPlayer($playerData);
        $resultado_representante = adminModel::getRepresentativeByCedula($playerData['cedula_representante']);
        if ($resultao === "success") {
            if (isset($_SESSION['cedular'])) {
                unset($_SESSION['cedular']);
            }
            $this->sendMail($resultado_representante['correo'], 'Registro en Futbol Club - Nuevo Jugador', $mail_body);
            header("Location:/FutbolClub/administrador/listajugadores");
        } else {
            $errores[] = "Error al registrar el jugador: " . $resultao;
            $this->erroresf = $errores;
        }
    } else {
        $this->erroresf = $errores;
        $this->vistan('administrador/players_new');
        echo "Errores al registrar el jugador:";
    }
    }
    
        public function addRepresentative() {
            $errores = [];
            $datos = $_POST;
            $archivo = $_FILES;
            // --- Validaciones básicas ---
            if (empty($datos['representative-dni']) || !is_numeric($datos['representative-dni'])) {
                $errores[] = "La cédula del representante es inválida.";
            }

            if (empty($datos['representative-name']) || !preg_match('/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/', $datos['representative-name'])) {
                $errores[] = "El nombre del representante es inválido.";
            }

            if (empty($datos['representative-lastname']) || !preg_match('/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/', $datos['representative-lastname'])) {
                $errores[] = "El apellido del representante es inválido.";
            }

            if (empty($datos['representative-email']) || !filter_var($datos['representative-email'], FILTER_VALIDATE_EMAIL)) {
                $errores[] = "El correo electrónico no es válido.";
            }

            if (empty($datos['representative-phone']) || !preg_match('/^[0-9]{11}$/', $datos['representative-phone'])) {
                $errores[] = "El número de teléfono debe tener 11 dígitos.";
            }

            if (empty($datos['representative-gender']) || !in_array($datos['representative-gender'], ['M', 'F'])) {
                $errores[] = "Debe seleccionar un género válido.";
            }

            if (empty($datos['representative-birthdate']) || !strtotime($datos['representative-birthdate'])) {
                $errores[] = "La fecha de nacimiento no es válida.";
            }

            if(adminModel::representanteExiste($datos['representative-dni'])){
                $errores[] = "La cedula se encuentra en uso.";
            }

            // --- Validación y movimiento de imagen ---
            $rutaDestino = '';
            if (isset($archivo['representative-image']) && $archivo['representative-image']['error'] === UPLOAD_ERR_OK) {
                $tipo = mime_content_type($archivo['representative-image']['tmp_name']);
                $dimensiones = getimagesize($archivo['representative-image']['tmp_name']);

                if (!in_array($tipo, ['image/jpeg', 'image/png', 'image/jpg'])) {
                    $errores[] = "La imagen debe ser JPG o PNG.";
                }

                if ($dimensiones[0] !== 250 || $dimensiones[1] !== 250) {
                    $errores[] = "La imagen debe tener exactamente 250x250 píxeles.";
                }

                if (empty($errores)) {
                    $ext = pathinfo($archivo['representative-image']['name'], PATHINFO_EXTENSION);
                    $nombreArchivo = 'representante_' . $datos['representative-dni'] . '.' . $ext;
                    $directorio = 'uploads/representantes/';

                    if (!is_dir($directorio)) {
                        mkdir($directorio, 0755, true);
                    }

                    $rutaDestino = $directorio . $nombreArchivo;

                    if (!move_uploaded_file($archivo['representative-image']['tmp_name'], $rutaDestino)) {
                        $errores[] = "No se pudo guardar la imagen en el servidor.";
                    }
                }

            } else {
                $errores[] = "Debe subir una imagen válida.";
            }
            if (empty($errores)) {
                $representativeData = [
                    'cedula' => intval($datos['representative-dni']),
                    'nombres' => trim($datos['representative-name']),
                    'apellidos' => trim($datos['representative-lastname']),
                    'email' => trim($datos['representative-email']),
                    'telefono' => trim($datos['representative-phone']),
                    'genero' => $datos['representative-gender'],
                    'fecha_nacimiento' => date('Y-m-d', strtotime($datos['representative-birthdate'])),
                    'foto' => $rutaDestino,
                    'password' => $this->generarPassword(8)
                ];
                

                $mail_body= '
                    <div style="font-family: Arial, sans-serif; font-size: 14px; line-height: 1.5; background-color: #f4f4f4; padding: 20px; border: 1px solid #ddd; border-radius: 5px; max-width: 600px; margin: auto;">
                    <div style="text-align: center;">
                        <h2 style="margin: 0px; color:#8b51d0;">FUTBOL CLUB</h2>
                        <strong style="color:#188d32;">AGUA DULCE</strong>
                    </div>
                    <div>
                        <p style="text-align: center;">Estimado Representante, <strong>'.$representativeData['nombres'].'</strong></p>
                        <p style="text-align: center;">Le informamos que se ha registrado en el Sistema de Gestión de Futbol Club.</p>
                        <h4>Sus Credenciales de acceso son las siguientes:</h4>
                        <p>Correo Electrónico: <strong>'.$representativeData['email'].'</strong></p>
                        <p>Contraseña: <strong>'.$representativeData['password'].'</strong></p>
                        <p>Le recomendamos cambiar su contraseña después de iniciar sesión por primera vez.</p>
                        <div class="mail-body-links" style="display: flex; justify-content: center;">
                            <a href="#" style="color: white; text-decoration: none; background-color: #8b51d0; padding: 10px 15px; border-radius: 5px;">Ir a Iniciar Sesión</a>
                        </div>
                    </div>
                </div>';

                $resultado = adminModel::createRepresentative($representativeData);
                if ($resultado === "success") {
                    $this->sendMail($representativeData['email'], 'Registro en Futbol Club - Credenciales de Acceso', $mail_body);
                    header("Location:/FutbolClub/administrador/representantes_lista");
                    exit();
                } else {
                    $errores[] = "Error al registrar el representante: " . $resultado;
                    $this->erroresf = $errores;
                    
                }
            } else {
                $this->erroresf = $errores;
                $this->vistan('administrador/representative_new');
            }
        }

        public function addTrainer(){
            if(!isset($_POST) && !isset($_FILES)) {
                // Manejar el caso en que no se envían datos
            }
            if(!empty($_POST) && !empty($_FILES)){
                if(isset($_POST['trainer-names']) && isset($_POST['trainer-email']) 
                    && isset($_POST['trainer-phone']) && isset($_POST['trainer-gender'])
                    && isset($_POST['trainer-birthdate']) && isset($_POST['trainer-dni'])) {

                    if(!GeneralValidations::validateNames($_POST['trainer-names'])){
                        $this->erroresf[] = "El nombre solo puede contener letras y espacios.";
                    }

                    //Validaciones de cédula
                    if(!GeneralValidations::validateCedula($_POST['trainer-dni'])){
                        $this->erroresf[] = "La cédula no es válida.";
                    }else{
                        if(adminModel::existDni($_POST['trainer-dni'], 'entrenadores')){
                            $this->erroresf[] = "La cédula ya está en uso.";
                        }
                    }

                    //Validaciones de correo electrónico
                    if(!GeneralValidations::validateEmail($_POST['trainer-email'])){
                        $this->erroresf[] = "El correo electrónico no es válido.";
                    }else{
                        if(adminModel::existEmail($_POST['trainer-email'], 'entrenadores')){
                            $this->erroresf[] = "El correo electrónico ya está en uso.";
                        }
                    }
                    //Validaciones de teléfono
                    if(!GeneralValidations::validatePhone($_POST['trainer-phone'])){
                        $this->erroresf[] = "El teléfono debe tener 11 dígitos.";
                    }

                    //Validaciones de Genero
                    if(!GeneralValidations::validateGender($_POST['trainer-gender'])){
                        $this->erroresf[] = "El género no es válido.";
                    }

                    if(!GeneralValidations::validateBirthDate($_POST['trainer-birthdate'])){
                        $this->erroresf[] = "La fecha de nacimiento no es válida.";
                    }

                    $photo_result= GeneralValidations::validatePlayerImage($_FILES, $_POST['trainer-dni'], 'trainer-image');
                    var_dump($photo_result);
                    echo "<br>";
                    if (isset($photo_result['success']) && $photo_result['success'] === true) {
                        // Crear directorio si no existe
                        $dirDestino = dirname($photo_result['rutaDestino']);
                        if (!is_dir($dirDestino)) {
                            mkdir($dirDestino, 0755, true);
                        }

                        $rutaDestino = $photo_result['rutaDestino'];

                        if (!move_uploaded_file($photo_result['tmp_name'], $rutaDestino)) {
                            $this->erroresf[] = "No se pudo guardar la imagen en el servidor.";
                        }

                    } else {
                        // Si no tiene 'success', son errores
                        if (is_array($photo_result)) {
                            $this->erroresf = array_merge($this->erroresf ?? [], $photo_result);
                        } else {
                            $this->erroresf[] = $photo_result;
                        }
                        var_dump($this->erroresf);
                    }

                    var_dump($this->erroresf);
                    if(empty($this->erroresf)){
                        // Si no hay errores, se puede proceder a guardar el entrenador
                        $entrenadorData = [
                            'nombres' => trim($_POST['trainer-names']),
                            'email' => trim($_POST['trainer-email']),
                            'telefono' => trim($_POST['trainer-phone']),
                            'genero' => $_POST['trainer-gender'],
                            'fecha_nacimiento' => date('Y-m-d', strtotime($_POST['trainer-birthdate'])),
                            'cedula' => trim($_POST['trainer-dni']),
                            'foto' => $photo_result['nombreArchivo']
                        ];
                        $resultado = adminModel::createTrainer($entrenadorData);
                        if($resultado === "success"){
                            header("Location:/FutbolClub/administrador/entrenadores_lista?success");
                        }else{
                            $this->vistan('administrador/trainer_new');
                        }
                    }
                }
            }else{
                header("Location:/FutbolClub/administrador/nuevoentrenador");
            }

        }

        public function sendMail($destinatario, $asunto, $cuerpo){

            $mail = new PHPMailer(true);

            try {
                // Configuración SMTP
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'aguadulceclub9@gmail.com';
                $mail->Password   = 'fkjjjxmcsmfmbean';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';


                // Datos del correo
                $mail->setFrom('aguadulceclub9@gmail.com', 'Futbol Club | Agua Dulce');
                $mail->addAddress($destinatario);
                $mail->Subject = $asunto;
                $mail->Body    = $cuerpo;

                $mail->send();
                return true;
            } catch (Exception $e) {
                return "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        }

        private function generarPassword($longitud = 10) {
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $password = '';
            $max = strlen($caracteres) - 1;

            for ($i = 0; $i < $longitud; $i++) {
                $password .= $caracteres[random_int(0, $max)];
            }

            return $password;
        }

}
?>
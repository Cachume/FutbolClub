<?php
require_once "modelo/adminmodel.php";
    class administrador extends vistas{
        public $erroresf;
        public $jugadores;
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
        public function representates(){
            $this->vistan('administrador/representative_list');
        }

        public function new_representantes(){
            $this->vistan('administrador/representative_new');
        }

        public function verificacionjugador(){
            $this->vistan('administrador/player_verification');
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

    // --- Registro si no hay errores ---
    if (empty($errores)) {
        $playerData = [
            'cedula' => intval($datos['player-dni']),
            'nombres' => trim($datos['player-name']),
            'apellidos' => trim($datos['player-lastname']),
            'fecha_nacimiento' => date('Y-m-d', strtotime($datos['player-birthdate'])),
            'genero' => $datos['player-gender'],
            'categoria' => $datos['player-category'],
            'nombre_camiseta' => trim($datos['player-shirt']),
            'cedula_representante' => $cedulaRepresentante,
            'foto' => $rutaDestino
        ];

        $resultao = adminModel::createPlayer($playerData);
        var_dump($playerData);
        var_dump($resultao);
        if ($resultao === "success") {
            if (isset($_SESSION['cedular'])) {
                unset($_SESSION['cedular']);
            }
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
                    'foto' => $rutaDestino
                ];

                $resultado = adminModel::createRepresentative($representativeData);
                if ($resultado === "success") {
                    header("Location:/FutbolClub/administrador/listarepresentantes");
                } else {
                    $errores[] = "Error al registrar el representante: " . $resultado;
                    $this->erroresf = $errores;
                    
                }
            } else {
                $this->erroresf = $errores;
                $this->vistan('administrador/representative_new');
            }
        }


    }
?>
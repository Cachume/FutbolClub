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
            $this->vistan('administrador/players_new');
        }
        public function listajugadores(){
            $this->jugadores = adminModel::getAllPlayers();
            $this->vistan('administrador/players_list');
        }
        public function salir(){
            session_unset();
            session_destroy();
            echo "<script>alert('Sesion Cerrada')</script>";
            header("Location:/FutbolClub/login");
        }

        public function addPlayer() {
            $errores = [];
            $datos = $_POST;
            $archivo = $_FILES;

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
            }

            if (empty($datos['player-gender']) || !in_array($datos['player-gender'], ['M', 'F'])) {
                $errores[] = "Debe seleccionar un género válido.";
            }

            if (empty($datos['player-category']) || !in_array($datos['player-category'], ['Sub-6', 'Sub-8'])) {
                $errores[] = "Debe seleccionar una categoría válida.";
            }

            if (empty($datos['player-shirt']) || strlen($datos['player-shirt']) > 20) {
                $errores[] = "El nombre de la camiseta es obligatorio y debe tener menos de 20 caracteres.";
            }

            if (empty($datos['player-representative-dni']) || !is_numeric($datos['player-representative-dni'])) {
                $errores[] = "La cédula del representante no es válida.";
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
                // Preparar el array con los campos que espera createPlayer()
                $playerData = [
                    'cedula' => intval($datos['player-dni']),
                    'nombres' => trim($datos['player-name']),
                    'apellidos' => trim($datos['player-lastname']),
                    'fecha_nacimiento' => date('Y-m-d', strtotime($datos['player-birthdate'])),
                    'genero' => $datos['player-gender'],
                    'categoria' => $datos['player-category'],
                    'nombre_camiseta' => trim($datos['player-shirt']),
                    'cedula_representante' => intval($datos['player-representative-dni']),
                    'foto' => $rutaDestino
                ];

                $resultao = adminModel::createPlayer($playerData);
                if ($resultao === "success") {
                    header("Location:/FutbolClub/administrador/listajugadores");
                } else {
                    $errores[] = "Error al registrar el jugador: " . $resultao;
                    $this->erroresf = $errores;
                }
            }else{
                $this->erroresf = $errores;
                $this->vistan('administrador/players_new');
                echo "Errores al registrar el jugador:";
                
            }
            
        }
    }
?>
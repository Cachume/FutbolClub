<?php

    class GeneralValidations{


        public static function validateString($string, $min = 1, $max = 255) {
            return is_string($string) && strlen(trim($string)) >= $min && strlen($string) <= $max;
        }

        public static function validateEmail($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        }

        public static function validatePhone($phone) {
            return preg_match('/^[0-9]{11}$/', $phone); // 11 dígitos
        }

        public static function validateCedula($cedula) {
            return preg_match('/^[0-9]{7,8}$/', $cedula); // 7 u 8 dígitos
        }

        public static function validateNames($name){
            return preg_match("/^[a-zA-ZÀ-ÿ\s]+$/", $name);
        }

        public static function validateBirthDate($date) {
            $timestamp = strtotime($date);
            return $timestamp && $timestamp < time();
        }

        public static function validateGender($gender) {
            return in_array($gender, ['M', 'F']);
        }

        public static function validatePlayerImage($archivo, $dni ,$name_input)
        {
            $errores = [];

            if (!isset($archivo[$name_input]) || $archivo[$name_input]['error'] !== UPLOAD_ERR_OK) {
                return ["No se subió ninguna imagen válida."];
            }

            $tipo = mime_content_type($archivo[$name_input]['tmp_name']);
            $dimensiones = getimagesize($archivo[$name_input]['tmp_name']);

            if (!in_array($tipo, ['image/jpeg', 'image/png', 'image/jpg'])) {
                $errores[] = "La imagen debe ser JPG o PNG.";
            }

            if ($dimensiones[0] !== 250 || $dimensiones[1] !== 250) {
                $errores[] = "La imagen debe tener exactamente 250x250 píxeles.";
            }

            if($name_input === 'player-image') {
                $name = 'jugador_' . $dni;
            } elseif($name_input === 'trainer-image') {
                $name = 'entrenador_' . $dni;
            }elseif($name_input === 'representative-image') {
                $name = 'representante_' . $dni;
            }else{
                $name = 'imagen_' . $dni;
            }

            // Si no hay errores, devolvemos también info para guardado
            if (empty($errores)) {
                $ext = pathinfo($archivo[$name_input]['name'], PATHINFO_EXTENSION);
                $nombreArchivo = $name . '.' . $ext;
                $rutaDestino = 'uploads/jugadores/' . $nombreArchivo;

                return [
                    'success' => true,
                    'rutaDestino' => $rutaDestino,
                    'nombreArchivo' => $nombreArchivo,
                    'tmp_name' => $archivo[$name_input]['tmp_name']
                ];
            }

            return $errores;
        }

    }
?>
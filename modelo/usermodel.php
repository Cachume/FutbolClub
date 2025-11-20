<?php
    //clase login la cual hereda los metodo de la clase vistas
    require_once "database.php";
    class userModel extends Database
    {  
        public static function getMysPlayers($rep_id)
        {
            $stmt = Database::getDatabase()->prepare("SELECT j.*, c.nombre_categoria, c.horario, e.nombre_completo FROM jugadores j 
            JOIN categorias c ON c.id = j.categoria
            JOIN entrenadores e ON e.id = c.entrenador_id
            WHERE cedula_representante = :rep_id");
            $stmt->bindParam(":rep_id", $rep_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getMyPayments($rep_id) {
            $stmt = Database::getDatabase()->prepare("
                    SELECT DISTINCT 
                        p.id AS pago_id,
                        p.nombre,
                        p.descripcion,
                        p.monto,
                        p.fecha_creacion,
                        pr.estado,
                        pr.metodo_pago,
                        pr.referencia,
                        pr.fecha_pago
                    FROM lista_pagos p
                    JOIN pago_categoria pc ON p.id = pc.id_pago
                    JOIN jugadores j ON j.categoria = pc.id_categoria
                    LEFT JOIN pagos pr 
                        ON pr.id_pago = p.id AND pr.representante_id = :representante
                    WHERE j.cedula_representante = :representante
                ");
            $stmt->bindParam(":representante", $rep_id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getMyPaymentsHistory($rep_id) {
            $stmt = Database::getDatabase()->prepare("
                    SELECT DISTINCT 
                        p.id AS pago_id,
                        p.nombre,
                        p.descripcion,
                        p.monto,
                        p.fecha_creacion,
                        pr.estado,
                        pr.metodo_pago,
                        pr.referencia,
                        pr.fecha_pago
                    FROM lista_pagos p
                    JOIN pago_categoria pc ON p.id = pc.id_pago
                    JOIN jugadores j ON j.categoria = pc.id_categoria
                    LEFT JOIN pagos pr 
                        ON pr.id_pago = p.id AND pr.representante_id = :representante
                    WHERE j.cedula_representante = :representante AND pr.estado != 'pendiente'
                ");
            $stmt->bindParam(":representante", $rep_id, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function validarAccesoPago($idPago, $rep) {
            $stmt = Database::getDatabase()->prepare("
                SELECT p.id
                FROM lista_pagos p
                JOIN pago_categoria pc ON p.id = pc.id_pago
                JOIN jugadores j ON j.categoria = pc.id_categoria
                WHERE p.id = :id_pago
                AND j.cedula_representante = :representante
                LIMIT 1
            ");
            $stmt->bindParam(":id_pago", $idPago, PDO::PARAM_INT);
            $stmt->bindParam(":representante", $rep, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
        }

        public static function DatosdePago($idPago, $rep) {
            $stmt = Database::getDatabase()->prepare("
                SELECT p.id, p.nombre ,p.monto, j.nombres, j.apellidos, c.nombre_categoria
                FROM lista_pagos p
                JOIN pago_categoria pc ON p.id = pc.id_pago
                JOIN jugadores j ON j.categoria = pc.id_categoria
                JOIN categorias c ON j.categoria = c.id
                WHERE p.id = :id_pago
                AND j.cedula_representante = :representante
            ");
            $stmt->bindParam(":id_pago", $idPago, PDO::PARAM_INT);
            $stmt->bindParam(":representante", $rep, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return !empty($result) ? $result : false;
        }

        public static function guardarPago($metodo_pago, $fecha_pago, $monto_pago, $descripcion_pago, $representante_id, $comprobante_path, $referencia, $idPago = null) {
            // $stmt = Database::getDatabase()->prepare("
            //     INSERT INTO pagos (metodo_pago, fecha_pago, monto, concepto, representante_id, foto, referencia, id_pago)
            //     VALUES (:metodo_pago, :fecha_pago, :monto_pago, :descripcion_pago, :representante_id, :comprobante_path, :referencia, :id_pago)
            // ");
            $stmt = Database::getDatabase()->prepare("
                UPDATE pagos SET
                    metodo_pago = :metodo_pago,
                    monto = :monto_pago,
                    fecha_pago = :fecha_pago,
                    concepto = :descripcion_pago,
                    foto = :comprobante_path,
                    referencia = :referencia,
                    estado = 'espera'
                WHERE representante_id = :representante_id AND id_pago = :id_pago
            ");
            $stmt->bindParam(":metodo_pago", $metodo_pago, PDO::PARAM_STR);
            $stmt->bindParam(":monto_pago", $monto_pago, PDO::PARAM_STR);
            $stmt->bindParam(":fecha_pago", $fecha_pago, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_pago", $descripcion_pago, PDO::PARAM_STR);
            $stmt->bindParam(":comprobante_path", $comprobante_path, PDO::PARAM_STR);
            $stmt->bindParam(":referencia", $referencia, PDO::PARAM_STR);
            //WHERE
            $stmt->bindParam(":representante_id", $representante_id, PDO::PARAM_STR);
            $stmt->bindParam(":id_pago", $idPago, PDO::PARAM_INT);
            return $stmt->execute();
        }

        public static function misjugadores($id) {
            $stmt = Database::getDatabase()->prepare("
                SELECT j.nombres, j.apellidos, c.nombre_categoria,c.horario
                FROM jugadores j JOIN categorias c ON c.id=j.categoria
                WHERE j.cedula_representante=:id
            ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return !empty($result) ? $result : false;
        }

        public static function mispartidos($id) {
            $stmt = Database::getDatabase()->prepare("
                SELECT DISTINCT 
                    p.id,
                    p.nombre,
                    p.descripcion,
                    p.fecha_partido
                FROM partidos p
                JOIN estadisticas_partidos e ON e.partido_id = p.id
                JOIN jugadores j ON j.id = e.jugador_id
                WHERE j.cedula_representante = :id
                ORDER BY p.fecha_partido DESC;
            ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return !empty($result) ? $result : false;
        }

    }
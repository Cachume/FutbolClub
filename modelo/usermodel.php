<?php
    //clase login la cual hereda los metodo de la clase vistas
    require_once "database.php";
    class userModel extends Database
    {  
        public static function getMysPlayers($rep_id)
        {
            $stmt = Database::getDatabase()->prepare("SELECT * FROM jugadores WHERE cedula_representante = :rep_id");
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
                SELECT p.id, p.monto, j.nombres, j.apellidos, c.nombre_categoria
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

    }
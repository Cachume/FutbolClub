<?php
    //clase login la cual hereda los metodo de la clase vistas
    require_once "database.php";
    class reportesModel extends Database
    {   

    public static function todoslospagos(){
        try {
            $stmt = Database::getDatabase()->prepare("SELECT * FROM lista_pagos");
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            return []; 
        }
    }
    public static function categorys($id=null){
        try {
            if(is_null($id)){
                $stmt = Database::getDatabase()->prepare("SELECT j.nombres, j.apellidos, j.genero, c.nombre_categoria,j.cedula,j.partida_nacimiento
                FROM jugadores j 
                JOIN categorias c ON j.categoria = c.id
                ORDER BY c.nombre_categoria;
                ");
            }else{
                $stmt = Database::getDatabase()->prepare("SELECT j.nombres, j.apellidos, j.genero, c.nombre_categoria,j.cedula,j.partida_nacimiento
                FROM jugadores j 
                JOIN categorias c ON j.categoria = c.id
                WHERE c.id=:id
                ORDER BY c.nombre_categoria;
                ");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            }
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            return []; 
        }
    }

    public static function listaPagosPorMesYAnio($mes, $anio)
    {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT id, nombre, descripcion, monto, fecha_creacion
                FROM lista_pagos
                WHERE MONTH(fecha_creacion) = :mes
                AND YEAR(fecha_creacion) = :anio
                ORDER BY fecha_creacion DESC
            ");

            $stmt->bindParam(':mes', $mes, PDO::PARAM_INT);
            $stmt->bindParam(':anio', $anio, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return [];
        }
    }
    public static function datapago($id)
    {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT p.id_pago, lp.nombre, j.nombres, j.apellidos,p.monto,p.estado,r.nombre_completo,r.telefono ,c.nombre_categoria FROM pagos p
                JOIN representantes r ON r.cedula = p.representante_id
                JOIN jugadores j ON p.representante_id= j.cedula_representante
                JOIN categorias c ON c.id = j.categoria
                JOIN lista_pagos lp ON lp.id=p.id_pago
                WHERE p.id_pago =:id
                ORDER BY 
                    c.nombre_categoria ASC,
                    j.apellidos ASC,
                    p.estado ASC;
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return [];
        }
    }

    public static function estadisticaGeneros() {
        try {
            $stmt = Database::getDatabase()->prepare("SELECT genero, COUNT(*) as cantidad FROM jugadores GROUP BY genero;");
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            return []; 
        }
    }
    public static function estadisticaCategorias() {
        try {
            $stmt = Database::getDatabase()->prepare("SELECT c.nombre_categoria, COUNT(*) as cantidad FROM jugadores j JOIN categorias c ON c.id = j.categoria GROUP BY j.categoria");
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            return []; 
        }
    }

    public static function estadisticapartidas($id) {
        try {
            $stmt = Database::getDatabase()->prepare(
                " SELECT e.*, 
                        j.nombres,
                        j.apellidos ,
                        c.nombre_categoria,
                        p.nombre
                    FROM estadisticas_partidos e
                    JOIN jugadores j ON j.id = e.jugador_id
                    JOIN categorias c ON c.id = e.categoria_id
                    JOIN partidos p ON p.id = e.partido_id
                    WHERE e.partido_id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            return [$e]; 
        }
    }

}
?>
<?php
    //clase login la cual hereda los metodo de la clase vistas
    require_once "database.php";
    class adminModel extends Database
    {   
        public static function createPlayer($datos) {
        try {
            $stmt = Database::getDatabase()->prepare("
                INSERT INTO jugadores 
                (cedula, nombres, apellidos, fecha_nacimiento, genero, categoria, nombre_camiseta, cedula_representante, foto) 
                VALUES 
                (:cedula, :nombres, :apellidos, :fecha_nacimiento, :genero, :categoria, :nombre_camiseta, :cedula_representante, :foto)
            ");

            $stmt->bindParam(":cedula", $datos['cedula'], PDO::PARAM_INT);
            $stmt->bindParam(":nombres", $datos['nombres'], PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $datos['apellidos'], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_nacimiento", $datos['fecha_nacimiento'], PDO::PARAM_STR);
            $stmt->bindParam(":genero", $datos['genero'], PDO::PARAM_STR);
            $stmt->bindParam(":categoria", $datos['categoria'], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_camiseta", $datos['nombre_camiseta'], PDO::PARAM_STR);
            $stmt->bindParam(":cedula_representante", $datos['cedula_representante'], PDO::PARAM_INT);
            $stmt->bindParam(":foto", $datos['foto'], PDO::PARAM_STR);

            return $stmt->execute() ? "success" : "error";

        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    public static function createRepresentative($datos) {
    try {
        $stmt = Database::getDatabase()->prepare("
            INSERT INTO representantes 
            (nombre_completo, fecha_nacimiento, cedula, telefono, correo, direccion, id_usuario, foto) 
            VALUES 
            (:nombre_completo, :fecha_nacimiento, :cedula, :telefono, :correo, :direccion, :id_usuario, :foto)
        ");

        $nombreCompleto = trim($datos['nombres']) . ' ' . trim($datos['apellidos']);

        $stmt->bindParam(":nombre_completo", $nombreCompleto, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $datos['fecha_nacimiento'], PDO::PARAM_STR);
        $stmt->bindParam(":cedula", $datos['cedula'], PDO::PARAM_INT);
        $stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos['email'], PDO::PARAM_STR);

        // Estos campos pueden estar vacíos o completarse luego
        $direccion = isset($datos['direccion']) ? $datos['direccion'] : '';
        $idUsuario = isset($datos['id_usuario']) ? $datos['id_usuario'] : null;

        $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(":foto", $datos['foto'], PDO::PARAM_STR);

        return $stmt->execute() ? "success" : "error";

    } catch (PDOException $e) {
        return "error: " . $e->getMessage();
    }
}


    public static function getAllPlayers() {
        try {
            $stmt = Database::getDatabase()->prepare("SELECT * FROM jugadores ORDER BY apellidos, nombres");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return []; 
        }
    }

    public static function representanteExiste($cedula) {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT COUNT(*) FROM representantes WHERE cedula = :cedula
            ");
            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetchColumn();

            return $resultado > 0;
        } catch (PDOException $e) {
            // Puedes loguearlo o devolver falso directamente
            return false;
        }
    }

    public static function getPlayerWithDetails($cedula) {
    try {
        $stmt = Database::getDatabase()->prepare("
            SELECT 
            j.cedula AS cedula_jugador, 
            j.nombres AS nombres_jugador, 
            j.apellidos AS apellidos_jugador, 
            j.fecha_nacimiento AS fecha_nacimiento_jugador, 
            j.genero, 
            j.categoria, 
            j.nombre_camiseta, 
            j.foto AS foto_jugador, 
            r.nombre_completo AS nombre_representante, 
            r.fecha_nacimiento AS fecha_nacimiento_representante, 
            r.cedula AS cedula_representante, 
            r.telefono AS telefono_representante, 
            r.correo AS correo_representante, 
            r.direccion AS direccion_representante, 
            r.foto AS foto_representante, 
            c.nombre_categoria, 
            c.periodo, 
            c.horario 
        FROM jugadores j 
        LEFT JOIN representantes r ON j.cedula_representante = r.cedula 
        LEFT JOIN categorias c ON j.categoria = c.nombre_categoria 
        WHERE j.cedula = :cedula");
        $stmt->bindParam(':cedula', $cedula, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return null;
    }
}

}
?>
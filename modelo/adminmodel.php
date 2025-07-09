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

    public static function getAllPlayers() {
        try {
            $stmt = Database::getDatabase()->prepare("SELECT * FROM jugadores ORDER BY apellidos, nombres");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return []; 
        }
}
}
?>
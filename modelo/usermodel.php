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

    }
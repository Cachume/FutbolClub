<?php
    //clase login la cual hereda los metodo de la clase vistas
    require_once "database.php";
    class adminModel extends Database
    {   
        public static function createPlayer($datos) {
            $db = Database::getDatabase();
        try {
            $stmt = $db->prepare("
                INSERT INTO jugadores 
                (cedula, partida_nacimiento, nombres, apellidos, fecha_nacimiento, genero, categoria, nombre_camiseta, cedula_representante, foto) 
                VALUES 
                (:cedula,:partida_nacimiento ,:nombres, :apellidos, :fecha_nacimiento, :genero, :categoria, :nombre_camiseta, :cedula_representante, :foto)
            ");

            $stmt->bindParam(":cedula", $datos['cedula'], PDO::PARAM_INT);
            $stmt->bindParam(":partida_nacimiento", $datos['partida_nacimiento'], PDO::PARAM_INT);
            $stmt->bindParam(":nombres", $datos['nombres'], PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $datos['apellidos'], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_nacimiento", $datos['fecha_nacimiento'], PDO::PARAM_STR);
            $stmt->bindParam(":genero", $datos['genero'], PDO::PARAM_STR);
            $stmt->bindParam(":categoria", $datos['categoria'], PDO::PARAM_STR);
            $stmt->bindParam(":nombre_camiseta", $datos['nombre_camiseta'], PDO::PARAM_STR);
            $stmt->bindParam(":cedula_representante", $datos['cedula_representante'], PDO::PARAM_INT);
            $stmt->bindParam(":foto", $datos['foto'], PDO::PARAM_STR);

            $success = $stmt->execute();

            if ($success) {
                $lastId = $db->lastInsertId();
                return [
                    "status" => "success",
                    "id" => $lastId
                ];
            }else{
                return [
                    "status" => "error",
                    "message" => "Error al ejecutar la sentencia de inserción."
                ];
            }
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }
    public static function createRepresentative($datos) {
    try {
        $stmt = Database::getDatabase()->prepare("
            INSERT INTO representantes 
            (nombre_completo, fecha_nacimiento, cedula, telefono, correo, direccion, id_usuario, foto, passwordp) 
            VALUES 
            (:nombre_completo, :fecha_nacimiento, :cedula, :telefono, :correo, :direccion, :id_usuario, :foto, :passwordp)
        ");

        $nombreCompleto = trim($datos['nombres']) . ' ' . trim($datos['apellidos']);
        $password = password_hash($datos['password'], PASSWORD_DEFAULT);
        $stmt->bindParam(":nombre_completo", $nombreCompleto, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nacimiento", $datos['fecha_nacimiento'], PDO::PARAM_STR);
        $stmt->bindParam(":cedula", $datos['cedula'], PDO::PARAM_INT);
        $stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos['email'], PDO::PARAM_STR);
        $stmt->bindParam(":passwordp", $password, PDO::PARAM_STR);
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

    
    public static function jugadoresestadistica(){
        try {
            $stmt = Database::getDatabase()->prepare("SELECT j.nombres, j.apellidos, j.cedula, j.genero, c.nombre_categoria FROM jugadores j JOIN categorias c ON c.id=j.categoria");
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
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
    public static function getAllPlayers() {
        try {
            $stmt = Database::getDatabase()->prepare("SELECT j.*, c.nombre_categoria FROM jugadores j JOIN categorias c ON j.categoria = c.id ORDER BY j.apellidos, j.nombres");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return []; 
        }
    }

    public static function getAllRepresentatives() {
        try {
            $stmt = Database::getDatabase()->prepare("SELECT * FROM representantes ORDER BY nombre_completo");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return []; 
        }
    }

    public static function getRepresentativeById($id) {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT * FROM representantes WHERE id = :id
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $representante = $stmt->fetch(PDO::FETCH_ASSOC);
            return $representante ? $representante : null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getplayercarnet($id) {
        try {
            $stmt = Database::getDatabase()->prepare("SELECT j.nombres, j.apellidos,j.nombre_camiseta,j.fecha_nacimiento,j.foto ,c.nombre_categoria, e.nombre_completo, c.horario
            FROM jugadores j 
            JOIN categorias c ON j.categoria = c.id
            LEFT JOIN entrenadores e ON e.id = c.entrenador_id
            WHERE j.id=:id
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $jugador = $stmt->fetch(PDO::FETCH_ASSOC);
            return $jugador;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getRepresentativeByCedula($cedula) {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT * FROM representantes WHERE cedula = :cedula
            ");
            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);
            $stmt->execute();
            $representante = $stmt->fetch(PDO::FETCH_ASSOC);
            return $representante ? $representante : null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function useDni($cedula, $table) {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT * FROM $table WHERE cedula = :cedula
            ");
            $stmt->bindParam(':cedula', $cedula, PDO::PARAM_INT);
            $stmt->execute();
            $representante = $stmt->fetch(PDO::FETCH_ASSOC);
            return $representante ? $representante : null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function useEmail($email ,$table) {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT * FROM $table WHERE correo = :correo
            ");
            $stmt->bindParam(':correo', $email, PDO::PARAM_STR);
            $stmt->execute();
            $representante = $stmt->fetch(PDO::FETCH_ASSOC);
            return $representante ? $representante : null;
        } catch (PDOException $e) {
            return null;
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

    public static function updateRepresentative($data){
        try {
            $stmt = Database::getDatabase()->prepare("
                UPDATE representantes 
                SET nombre_completo = :nombre_completo, 
                    fecha_nacimiento = :fecha_nacimiento, 
                    cedula = :cedula, 
                    telefono = :telefono, 
                    correo = :correo, 
                    direccion = :direccion
                WHERE id = :id
            ");

            $stmt->bindParam(":id", $data['id'], PDO::PARAM_INT);
            $stmt->bindParam(":nombre_completo", $data['nombre_completo'], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);
            $stmt->bindParam(":cedula", $data['cedula'], PDO::PARAM_INT);
            $stmt->bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $data['direccion'], PDO::PARAM_STR);
            return $stmt->execute() ? "success" : "error";

        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }
    public static function deleteRepresentative($id) {
        try {
            $stmt = Database::getDatabase()->prepare("
                DELETE FROM representantes WHERE cedula = :cedula
            ");
            $stmt->bindParam(':cedula', $id, PDO::PARAM_INT);
            return $stmt->execute() ? "success" : "error";
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
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
    public static function getTrainers() {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT * FROM entrenadores
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function existCategory($nombreCategoria) {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT EXISTS ( SELECT 1 FROM categorias WHERE nombre_categoria = :category ) AS existe;
            ");
            $stmt->bindParam(':category', $nombreCategoria, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function existCategoryID($id) {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT EXISTS ( SELECT 1 FROM categorias WHERE id = :id ) AS existe;
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function createCategory($datos) {
        try {
            $stmt = Database::getDatabase()->prepare("
                INSERT INTO categorias  
                (nombre_categoria, periodo, entrenador_id, horario) 
                VALUES 
                (:nombrecategoria, :periodo, :entrenador, :horario)
            ");

            $stmt->bindParam(":nombrecategoria", $datos['ncategoria'], PDO::PARAM_STR);
            $stmt->bindParam(":periodo", $datos['periodo'], PDO::PARAM_STR);
            $stmt->bindParam(":entrenador", $datos['entrenador'], PDO::PARAM_STR);
            $stmt->bindParam(":horario", $datos['horario'], PDO::PARAM_STR);

            return $stmt->execute() ? "success" : "error";

        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }
    public static function getCategorys() {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT categorias.*, entrenadores.nombre_completo AS nombre_entrenador FROM categorias JOIN entrenadores ON entrenadores.id = categorias.entrenador_id
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

        public static function getCategorysDetails($year) {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT * FROM categorias 
                WHERE CAST(LEFT(periodo, 4) AS UNSIGNED) <= :year 
                AND CAST(RIGHT(periodo, 4) AS UNSIGNED) >= :year
            ");
            $stmt->bindParam(":year", $year, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result["id"];
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getCategoryById($id) {
        $stmt = Database::getDatabase()->prepare("SELECT * FROM categorias WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getCategoryByName($id) {
        $stmt = Database::getDatabase()->prepare("SELECT * FROM categorias WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateCategory($datos){
        try {
            $stmt = Database::getDatabase()->prepare("
                UPDATE categorias SET 
                    nombre_categoria = :nombrecategoria, 
                    periodo = :periodo, 
                    entrenador_id = :entrenador, 
                    horario = :horario 
                WHERE id = :id
            ");
            $stmt->bindParam(":nombrecategoria", $datos['ncategoria'], PDO::PARAM_STR);
            $stmt->bindParam(":periodo", $datos['periodo'], PDO::PARAM_STR);
            $stmt->bindParam(":entrenador", $datos['entrenador'], PDO::PARAM_STR);
            $stmt->bindParam(":horario", $datos['horario'], PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos['id'], PDO::PARAM_INT);

            return $stmt->execute() ? "success" : "error";

        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    public static function deleteCategory($id) {
        try {
            $stmt = Database::getDatabase()->prepare("
                DELETE FROM categorias WHERE id = :id
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute() ? "success" : "error";
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    public static function existDni($dni, $table) {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT EXISTS ( SELECT 1 FROM $table WHERE cedula = :dni ) AS existe;
            ");
            $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function existEmail($email, $table) {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT EXISTS ( SELECT 1 FROM $table WHERE correo = :email ) AS existe;
            ");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function createTrainer($datos) {
        try {
                $stmt = Database::getDatabase()->prepare("
                    INSERT INTO entrenadores 
                    (nombre_completo, fecha_nacimiento, cedula, telefono, correo, direccion, foto) 
                    VALUES 
                    (:nombre_completo, :fecha_nacimiento, :cedula, :telefono, :correo, :direccion, :foto)
                ");

                $stmt->bindParam(":nombre_completo", $datos['nombres'], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_nacimiento", $datos['fecha_nacimiento'], PDO::PARAM_STR);
                $stmt->bindParam(":cedula", $datos['cedula'], PDO::PARAM_INT);
                $stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);
                $stmt->bindParam(":correo", $datos['email'], PDO::PARAM_STR);

                // Estos campos pueden estar vacíos o completarse luego
                $direccion = isset($datos['direccion']) ? $datos['direccion'] : '';

                $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
                $stmt->bindParam(":foto", $datos['foto'], PDO::PARAM_STR);

                return $stmt->execute() ? "success" : "error";

            } catch (PDOException $e) {
                return "error: " . $e->getMessage();
            }
        }
    public static function getTrainerById($id) {
        try {
            $stmt = Database::getDatabase()->prepare("
                SELECT * FROM entrenadores WHERE id = :id
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $entrenador = $stmt->fetch(PDO::FETCH_ASSOC);
            return $entrenador ? $entrenador : null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function updateTrainer($data){
        try {
            $stmt = Database::getDatabase()->prepare("
                UPDATE entrenadores 
                SET nombre_completo = :nombre_completo, 
                    fecha_nacimiento = :fecha_nacimiento, 
                    cedula = :cedula, 
                    telefono = :telefono, 
                    correo = :correo, 
                    direccion = :direccion
                WHERE id = :id
            ");

            $stmt->bindParam(":id", $data['id'], PDO::PARAM_INT);
            $stmt->bindParam(":nombre_completo", $data['nombre_completo'], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_nacimiento", $data['fecha_nacimiento'], PDO::PARAM_STR);
            $stmt->bindParam(":cedula", $data['cedula'], PDO::PARAM_INT);
            $stmt->bindParam(":telefono", $data['telefono'], PDO::PARAM_STR);
            $stmt->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $data['direccion'], PDO::PARAM_STR);
            return $stmt->execute() ? "success" : "error";

        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }
    public static function deleteTrainer($id) {
        try {
            $stmt = Database::getDatabase()->prepare("
                DELETE FROM entrenadores WHERE id = :id
            ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute() ? "success" : "error";
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }
    
    public static function getMetodosPago() {
        try {
            $stmt = Database::getDatabase()->prepare("SELECT * FROM metodos_pago");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return []; 
        }
    }

    public static function createPago(array $data) {
        try {
            $db = Database::getDatabase();
            $db->beginTransaction();
            $stmt = $db->prepare("
                INSERT INTO lista_pagos (nombre, descripcion, monto)
                VALUES (:nombre, :descripcion, :monto)
            ");
            $stmt->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $data["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":monto", $data["monto"], PDO::PARAM_STR);
            $stmt->execute();


            $idPago = $db->lastInsertId();

            if (!empty($data["categorias"]) && is_array($data["categorias"])) {
                $stmtCat = $db->prepare("
                    INSERT INTO pago_categoria (id_pago, id_categoria)
                    VALUES (:id_pago, :id_categoria)
                ");

                foreach ($data["categorias"] as $idCategoria) {
                    $stmtCat->bindParam(":id_pago", $idPago, PDO::PARAM_INT);
                    $stmtCat->bindParam(":id_categoria", $idCategoria, PDO::PARAM_INT);
                    $stmtCat->execute();
                }
            }

            $db->commit();
            return true;
        } catch (PDOException $e) {
            $db->rollBack();
            return "error: " . $e->getMessage();
        }
    }

    public static function getPagos() {
        try {
            $stmt = Database::getDatabase()->prepare("SELECT * FROM lista_pagos");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return []; 
        }
    }

    public static function getpaymentbyId($id){
        try {
            $stmt = Database::getDatabase()->prepare("SELECT p.*, r.nombre_completo  FROM pagos p JOIN representantes r ON r.cedula = p.representante_id JOIN lista_pagos lp on p.id_pago= lp.id WHERE p.id_pago=:id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function getpaymentDetails($id){
        try {
            $stmt = Database::getDatabase()->prepare("SELECT * FROM `pagos` WHERE id=:id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function editpayment($id, $estado){
        try {
            $stmt = Database::getDatabase()->prepare("UPDATE `pagos` SET `estado` = :estado WHERE `pagos`.`id` = :id");
            $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            return $stmt->execute() ? "success" : "error";
        } catch (PDOException $e) {
            return "error: " . $e->getMessage();
        }
    }

    public static function partidos(){
        try{
            $stmt = Database::getDatabase()->prepare("
                SELECT
                    p.id,
                    p.nombre AS NombrePartido,
                    p.fecha_partido AS FechaPartido,
                    GROUP_CONCAT(c.nombre_categoria ORDER BY c.nombre_categoria ASC SEPARATOR ', ') AS CategoriasAplicables
                FROM partidos p
                LEFT JOIN partido_categorias pc ON p.id = pc.id_partido
                LEFT JOIN categorias c ON pc.id_categoria = c.id
                GROUP BY p.id, p.nombre, p.fecha_partido
                ORDER BY p.fecha_partido DESC;
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return "error: " . $e->getMessage();
        }
    }

    public static function nuevopartido($nombre,$descripcion,$fecha, array $categorias_in){
        $stmt = Database::getDatabase();
        try {
            $stmt->beginTransaction();
            $partido = $stmt->prepare("INSERT INTO partidos (nombre, descripcion, fecha_partido)
                VALUES (:nombre,:descripcion,:fecha)");
            $partido->bindParam(":nombre", $nombre, PDO::PARAM_STR);    
            $partido->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);    
            $partido->bindParam(":fecha", $fecha, PDO::PARAM_STR);   
            $partido->execute();
            $id_partido = $stmt->lastInsertId(); 

            $categorias = $stmt->prepare("INSERT INTO partido_categorias (id_partido, id_categoria)
                VALUES (:partido, :categoria)");
            foreach($categorias_in as $categoria){
                $id_val = intval($categoria);
                $categorias->bindParam(":partido", $id_partido, PDO::PARAM_INT); 
                $categorias->bindParam(":categoria", $id_val, PDO::PARAM_INT);
                $categorias->execute();
            }
            $stmt->commit();
            return true;
            
        } catch (PDOException $e) {
            $stmt->rollBack();
            return "error: " . $e->getMessage();
        }
    }

}
?>
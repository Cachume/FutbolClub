<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FutbolClub/assets/css/index.css">
    <link rel="stylesheet" href="/FutbolClub/assets/css/players.css">
    <title>Futbol Club | Panel Administrador</title>
</head>
<body>
     <?php include("vistas/layout/header.php") ?>
    <main class="index-main" id="index-main">
    <?php include('vistas/layout/session.php'); ?>
        <div class="playerlist-container">
            <h2>Representantes Registrados</h2>
            <div class="playerlist-actions">
                <!-- <button id="add-player-button" class="action-button">Añadir Jugador</button> -->
                <input type="text" id="search-player" placeholder="Buscar Representante por Cedula..." onkeyup="filtrarTabla()">
            </div>
            <table class="player-table" id="player-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Posición</th>
                        <th>Cedula</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="player-list">
                    <?php
        if (empty($this->jugadores)) {
            echo '<tr><td colspan="6">No hay jugadores registrados.</td></tr>';
        } else {
            foreach ($this->jugadores as $jugador) {
                $posicion = isset($jugador['posicion']) ? htmlspecialchars($jugador['posicion']) : 'N/A';
                echo '<tr>';
                echo '<td>' . htmlspecialchars($jugador['nombres']) . '</td>';
                echo '<td>' . htmlspecialchars($jugador['apellidos']) . '</td>';
                echo '<td>' . htmlspecialchars($jugador['fecha_nacimiento']) . '</td>';
                echo '<td>' . htmlspecialchars($jugador['categoria']) . '</td>';
                echo '<td>' . htmlspecialchars($jugador['cedula']) . '</td>';
                echo '<td>
                        <button class="edit-button" data-cedula="' . htmlspecialchars($jugador['cedula']) . '">Editar</button>
                        <button class="delete-button" data-cedula="' . htmlspecialchars($jugador['cedula']) . '">Eliminar</button>
                      </td>';
                echo '</tr>';
            }
        }
        ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/players.js"></script>
</body>
</html>
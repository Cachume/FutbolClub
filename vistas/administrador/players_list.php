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
    <div class="barralateral" id="barralateral">
        <div class="logo">
            <img src="/FutbolClub/assets/img/club-brand.png" alt="Logo del Futbol Club">
            <span>FUTBOL CLUB AGUA DULCE</span>
        </div>
        <div class="menu">
            <ul class="menu-items">
                <li class="menu-static">
                    <a href="/FutbolClub/administrador" class="menu-link">
                        <img src="/FutbolClub/assets/img/home-icon.png" alt="Inicio">
                        <span>Inicio</span>
                    </a>
                </li>
                <li class="menu-dropdown" id="menu-dropdown">
                    <a href="#" class="menu-link">
                        <img src="/FutbolClub/assets/img/player.png" alt="Inicio">
                        <span>Jugadores</span>
                        <img src="/FutbolClub/assets/img/arrow.png" alt="Inicio">
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item"><a href="nuevojugador" class="menu-link">Registro</a></li>
                        <li class="submenu-item"><a href="listajugadores" class="menu-link">Jugadores</a></li>
                        <li class="submenu-item"><a href="/admin/players/stats" class="menu-link">Carnet</a></li>
                        
                    </ul>
                </li>
                <li class="menu-dropdown" id="menu-dropdown">
                    <a href="#" class="menu-link">
                        <img src="/FutbolClub/assets/img/trainer.png" alt="Inicio">
                        <span>Entrenadores</span>
                        <img src="/FutbolClub/assets/img/arrow.png" alt="Inicio">
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item"><a href="/admin/players" class="menu-link">Jugadores</a></li>
                        <li class="submenu-item"><a href="/admin/coaches" class="menu-link">Registro</a></li>
                        <li class="submenu-item"><a href="/admin/teams" class="menu-link">Busqueda</a></li>
                        <li class="submenu-item"><a href="/admin/sponsors" class="menu-link">Carnet</a></li>
                    </ul>
                </li>
                <li class="menu-dropdown" id="menu-dropdown">
                    <a href="#" class="menu-link">
                        <img src="/FutbolClub/assets/img/padres.png" alt="Inicio">
                        <span>Representantes</span>
                        <img src="/FutbolClub/assets/img/arrow.png" alt="Inicio">
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item"><a href="/admin/" class="menu-link">Registro</a></li>
                        <li class="submenu-item"><a href="/admin/teams" class="menu-link">Busqueda</a></li>
                        <li class="submenu-item"><a href="/admin/sponsors" class="menu-link">Pagos</a></li>
                    </ul>
                </li>
                <li class="menu-static">
                    <a href="#" class="menu-link">
                        <img src="/FutbolClub/assets/img/config.png" alt="Inicio">
                        <span>Configuración</span>
                    </a>
                </li>
                <li class="menu-static">
                    <a href="/FutbolClub/administrador/salir" class="menu-link">
                        <img src="/FutbolClub/assets/img/logout.png" alt="Inicio">
                        <span>Salir</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <main class="index-main" id="index-main">
        <header class="header-main">
        <img src="/FutbolClub/assets/img/menu.png" alt="" srcset="" id="btn-menu">
    </header>
        <div class="playerlist-container">
            <h2>Jugadores Registrados</h2>
            <div class="playerlist-actions">
                <!-- <button id="add-player-button" class="action-button">Añadir Jugador</button> -->
                <input type="text" id="search-player" placeholder="Buscar Jugador por Cedula..." onkeyup="filtrarTabla()">
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
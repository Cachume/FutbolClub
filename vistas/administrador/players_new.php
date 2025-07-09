<?php
    if (isset($this->erroresf)) {
        var_dump($this->erroresf);
    }
?>

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
                        <li class="submenu-item"><a href="nuevojugador" class="menu-link">Jugadores</a></li>
                        <li class="submenu-item"><a href="listajugadores" class="menu-link">Registro</a></li>
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
                        <li class="submenu-item"><a href="/administrador/nuevojugador" class="menu-link">Registro</a></li>
                        <li class="submenu-item"><a href="/administrador/listajugadores" class="menu-link">Jugadores</a></li>
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
        <div class="newplayers-container">
            <h1>Registro de Jugadores</h1>
            <?php if (!empty($this->erroresf)): ?>
                <div class="alert alert-danger" style="margin-top: 10px;">
                    <ul style="padding-left: 20px; color: red;">
                        <?php foreach ($this->erroresf as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="/FutbolClub/administrador/addPlayer" method="post" enctype="multipart/form-data"class="newplayers-form">
                <div class="np-form-image">
                    <span class="np-form-image-title">Foto Carnet del Jugador</span>
                    <img src="/FutbolClub/assets/img/no-fotos.png" alt="" srcset="" id="np-preview">
                    <span class="np-form-image-note">La imagen debe tener una resolución de 250px x 250px</span>
                    <label for="player-image">Seleccionar Imagen</label>
                    <input type="file" id="player-image" name="player-image" accept="image/*">
                </div>
                <div class="np-form-data">
                    <div class="np-form-group">
                        <label for="player-name">Cedula:</label>
                        <input type="number" id="player-dni" name="player-dni" placeholder="Cedula de Identidad" required>
                    </div>
                    <div class="np-form-group">
                        <label for="player-name">Nombres:</label>
                        <input type="text" id="player-name" name="player-name" placeholder="Nombre Completo" required>
                    </div>
                    <div class="np-form-group">
                        <label for="player-name">Apellidos:</label>
                        <input type="text" id="player-name" name="player-lastname" placeholder="Apellido Completo" required>
                    </div>
                    <div class="np-form-group">
                        <label for="player-name">Fecha de Nacimiento:</label>
                        <input type="date" id="player-birthdate" name="player-birthdate" required>
                    </div>
                    <div class="np-form-group">
                        <label for="player-name">Genero:</label>
                        <select id="player-gender" name="player-gender" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                    <div class="np-form-group">
                        <label for="player-name">Categoria:</label>
                        <select id="player-category" name="player-category" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="Sub-6">Sub-6</option>
                            <option value="Sub-8">Sub-8</option>
                        </select>
                    </div>
                    <div class="np-form-group">
                        <label for="player-name">Nombre de la Camiseta:</label>
                        <input type="text" id="player-shirt" name="player-shirt" placeholder="Nombre de la Camiseta" required>
                    </div>
                    <div class="np-form-group">
                        <label for="player-name">Cedula del Representante:</label>
                        <input type="number" id="player-representative-dni" name="player-representative-dni" placeholder="Cedula de Identidad del Representante" required>
                    </div>
                    <div class="np-form-buttons">
                        <button type="submit" class="np-form-button-save">Guardar</button>
                        <button type="reset" class="np-form-button-reset">Limpiar</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/players.js"></script>
</body>
</html>
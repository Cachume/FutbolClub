<?php
    // if (isset($this->erroresf)) {
    //     var_dump($this->erroresf);
    // }
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
    <?php include("vistas/layout/header.php") ?>
    <main class="index-main" id="index-main">
    <?php include('vistas/layout/session.php'); ?>
        <div class="newplayers-container">
            <h1>Registro de Representantes</h1>
            <?php if (!empty($this->erroresf)): ?>
                <div class="alert alert-danger" style="margin-top: 10px;">
                    <ul style="padding-left: 20px; color: red;">
                        <?php foreach ($this->erroresf as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="/FutbolClub/administrador/addRepresentative" method="post" enctype="multipart/form-data" class="newplayers-form">
                <div class="np-form-image">
                    <legend>Foto Carnet del Representante</legend>
                    <img src="/FutbolClub/assets/img/no-fotos.png" alt="Previsualización de la imagen" id="np-preview">
                    <span class="np-form-image-note">La imagen debe tener una resolución de 250px x 250px</span>
                    <label for="player-image" class="np-form-image-label">Seleccionar Imagen</label>
                    <input type="file" id="player-image" name="representative-image" accept="image/*">
                </div>

                <div class="np-form-data">
                    <div class="np-form-group">
                        <label for="representative-dni">Cédula:</label>
                        <input type="number" id="player-dni" name="representative-dni" placeholder="Cédula de Identidad" required>
                    </div>

                    <div class="np-form-group">
                        <label for="representative-name">Nombres:</label>
                        <input type="text" id="representative-name" name="representative-name" placeholder="Nombre Completo" required>
                    </div>

                    <div class="np-form-group">
                        <label for="representative-lastname">Apellidos:</label>
                        <input type="text" id="representative-lastname" name="representative-lastname" placeholder="Apellido Completo" required>
                    </div>
                    <div class="np-form-group">
                        <label for="representative-email">Correo Electrónico:</label>
                        <input type="email" id="representative-email" name="representative-email" placeholder="correo@ejemplo.com" required>
                    </div>

                    <div class="np-form-group">
                        <label for="representative-phone">Teléfono:</label>
                        <input type="tel" id="representative-phone" name="representative-phone" placeholder="Ej. 04141234567" pattern="[0-9]{11}" required>
                    </div>
                    <div class="np-form-group">
                        <label for="representative-gender">Género:</label>
                        <select id="representative-gender" name="representative-gender" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>

                    <div class="np-form-group">
                        <label for="representative-birthdate">Fecha de Nacimiento:</label>
                        <input type="date" id="representative-birthdate" name="representative-birthdate" required>
                    </div>

                    <div class="np-form-buttons">
                        <button type="submit" class="np-form-button-save">Guardar</button>
                        <button type="reset" class="np-form-button-reset">Limpiar</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script src="/FutbolClub/assets/js/jquery.js"></script>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/players.js"></script>
</body>
</html>
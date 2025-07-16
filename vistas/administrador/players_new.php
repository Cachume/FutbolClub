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
                        <label for="player-name">Cedula del Representante:</label>
                        <input type="number" id="player-representative-dni" name="player-representative-dni" value="<?php echo $_SESSION['cedular'];?>" placeholder="Cedula de Identidad del Representante" required readonly>
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
                        <label for="player-category">Categoría:</label>
                        <input type="text" id="player-category" name="player-category" readonly >
                    </div>
                    <div class="np-form-group">
                        <label for="player-name">Nombre de la Camiseta:</label>
                        <input type="text" id="player-shirt" name="player-shirt" placeholder="Nombre de la Camiseta" required>
                    </div>
                    <div class="np-form-buttons">
                        <button type="submit" class="np-form-button-save">Guardar</button>
                        <button type="reset" class="np-form-button-reset">Limpiar</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script>
        document.getElementById('player-birthdate').addEventListener('change', function () {
            const birthYear = new Date(this.value).getFullYear();
            const categoriaField = document.getElementById('player-category');
            let categoria = "";

            if (birthYear >= 2020 && birthYear <= 2021) categoria = "Sub-5";
            else if (birthYear >= 2018 && birthYear <= 2019) categoria = "Sub-7";
            else if (birthYear >= 2016 && birthYear <= 2017) categoria = "Sub-9";
            else if (birthYear >= 2014 && birthYear <= 2015) categoria = "Sub-11";
            else if (birthYear >= 2012 && birthYear <= 2013) categoria = "Sub-13";
            else if (birthYear >= 2010 && birthYear <= 2011) categoria = "Sub-15";
            else if (birthYear >= 2008 && birthYear <= 2009) categoria = "Sub-17";
            else categoria = "Fuera de rango";

            categoriaField.value = categoria;
        });
    </script>

    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/players.js"></script>
</body>
</html>
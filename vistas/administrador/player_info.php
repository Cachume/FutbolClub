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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Futbol Club | Panel Administrador</title>
</head>
<body>
    <?php include("vistas/layout/header.php") ?>
    <main class="index-main" id="index-main">
    <?php include('vistas/layout/session.php'); ?>
        <div class="container py-4">

        <h1 class="text-center mb-5">Ficha del Jugador</h1>

        <!-- Jugador -->
        <div class="card">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="../<?= $this->jugadores['foto_jugador']?>" alt="Foto del Jugador">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h4 class="card-title"><?= $this->jugadores['nombres_jugador'] . ' ' . $this->jugadores['apellidos_jugador'] ?></h4>
                <p class="card-text"><strong>Cédula:</strong> <?= $this->jugadores['cedula_jugador']?></p>
                <p class="card-text"><strong>Fecha de nacimiento:</strong> <?= $this->jugadores['fecha_nacimiento_jugador']?></p>
                <p class="card-text"><strong>Género:</strong> <?= $this->jugadores['genero']?></p>
                <p class="card-text"><strong>Categoría:</strong> <?= $this->jugadores['categoria']?></p>
                <p class="card-text"><strong>Nombre en Camiseta:</strong> <?= $this->jugadores['nombre_camiseta']?></p>
            </div>
            </div>
        </div>
        </div>
        <br>
        <!-- Representante -->
        <h4 class="section-title">Representante</h4>
        <div class="card">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="../<?= $this->jugadores['foto_representante']?>" alt="Foto del Representante">
            </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= $this->jugadores['nombre_representante']?></h5>
                <p class="card-text"><strong>Cédula:</strong> <?= $this->jugadores['cedula_representante']?></p>
                <p class="card-text"><strong>Teléfono:</strong> <?= $this->jugadores['telefono_representante']?></p>
                <p class="card-text"><strong>Correo:</strong> <?= $this->jugadores['correo_representante']?></p>
                <!-- <p class="card-text"><strong>Dirección:</strong> [Coloca la dirección aquí]</p> -->
            </div>
            </div>
        </div>
        </div>
        <br>
        <!-- Categoría -->
        <h4 class="section-title">Categoría</h4>
        <div class="card p-4">
        <h5 class="card-title"><?= $this->jugadores['categoria']?></h5>
        <p class="card-text"><strong>Periodo:</strong> <?= $this->jugadores['periodo']?></p>
        <p class="card-text"><strong>Horario de Entrenamiento:</strong> <?= $this->jugadores['horario']?></p>
        </div>

    </div>
    </main>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/players.js"></script>
</body>
</html>
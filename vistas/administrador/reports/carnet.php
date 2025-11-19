<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <style>
        body{
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .carnet-container {
            width: 400px;
            margin-top: 30px;
        }

        .carnet-box {
            position: relative;
            width: 400px;
            height: 250px;
            border: 1px solid #ccc;
            margin-bottom: 40px;
        }

        .carnet-img {
            width: 100%;
            height: 100%;
        }

        .foto {
            position: absolute;
            top: 70px;
            left: 30px;
            width: 85px;
            height: 105px;
            border: 1px solid #000;
            overflow: hidden;
        }

        .foto img {
            width: 100%;
            height: 100%;
        }

        .data {
            position: absolute;
            top: 70px;
            left: 135px;
            font-size: 12px;
            line-height: 1.4;
        }

        ul li {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

    <h2>Carnet de Identificación Oficial</h2>

    <p><strong>Estimado(a) <?= $this->jugadores['nombres'] ?>,</strong></p>

    <p>
        Hacemos entrega de tu <strong>Carnet de Identificación Oficial</strong> como 
        miembro activo del <strong>Club Deportivo Agua Dulce</strong>.
    </p>

    <ul>
        <li>
            Certifica tu condición de jugador en la categoría 
            <?= $this->jugadores['nombre_categoria'] ?>, número de camiseta 
            <?= $this->jugadores['nombre_camiseta'] ?>.
        </li>

        <li>
            En el reverso encontrarás la normativa y reglamento interno.
        </li>
    </ul>

    <p style="border-left: 3px solid #000; padding-left: 10px; font-weight: bold;">
        Lleva tu carnet en todas las actividades oficiales del club.
    </p>

    <p>¡Éxitos en esta temporada!</p>

    <p style="text-align:right;">
        <strong>La Directiva</strong><br>
        <strong>Club Deportivo Agua Dulce</strong>
    </p>

    <!-- CARNET FRENTE -->
    <div class="carnet-container">
        <div class="carnet-box">

            <!-- Imagen frontal del carnet -->
            <img src="<?= $this->data['frontal'] ?>" class="carnet-img">

            <!-- FOTO DEL JUGADOR -->
            <div class="foto">
                <img src="<?= $this->data['fotojugador'] ?>" alt="Foto jugador">
            </div>

            <!-- DATOS DEL JUGADOR -->
            <div class="data">
                <div><strong>NOMBRES:</strong> <?= $this->jugadores['nombres'] ?></div>
                <div><strong>APELLIDOS:</strong> <?= $this->jugadores['apellidos'] ?></div>
                <div><strong>F. NAC.:</strong> <?= $this->jugadores['fecha_nacimiento'] ?></div>
                <div><strong>CATEGORÍA:</strong> <?= $this->jugadores['nombre_categoria'] ?></div>
                <div><strong>N° CAMISETA:</strong> <?= $this->jugadores['nombre_camiseta'] ?></div>
                <div><strong>ENTRENADOR:</strong> <?= $this->jugadores['nombre_completo'] ?></div>
            </div>

        </div>

        <!-- CARNET REVERSO -->
        <div class="carnet-box">
            <img src="<?= $$this->data['reverso'] ?>" class="carnet-img">
        </div>
    </div>

</body>
</html>

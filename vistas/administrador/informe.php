<?php 
$totalF = 0;
$totalM = 0;

$categoriasCount = [];


?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Jugadores</title>
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: 20px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #333;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) td {
        background-color: #f9f9f9;
    }

    .totales {
        font-weight: bold;
        background-color: #e0e0e0;
    }

    .categoria-table {
        margin-top: 20px;
    }

    .categoria-table th {
        background-color: #d9edf7;
    }
</style>
</head>
<body>

<div style="text-align: center;">
    <h2 style="margin: 0px; color:#8b51d0; font-size:30px;">FUTBOL CLUB</h2>
    <strong style="color:#188d32;">AGUA DULCE</strong>
</div>
<h2>Reporte de Jugadores Registrados</h2>

<table>
    <thead>
        <tr>
            <th>Nombre Completo</th>
            <th>Cédula</th>
            <th>Género</th>
            <th>Categoría</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->jugadores as $jugador):?>
        <tr>
            <?php
                if ($jugador['genero'] === 'F') $totalF++;
                if ($jugador['genero'] === 'M') $totalM++;
                $cat = $jugador['nombre_categoria'] ?? 'Sin categoría';
            if (!isset($categoriasCount[$cat])) $categoriasCount[$cat] = 0;
            $categoriasCount[$cat]++;
            ?>
            <td><?=$jugador['nombres'].' '.$jugador['apellidos']?></td>
            <td><?=$jugador['cedula']?></td>
            <td><?=$jugador['genero']?></td>
            <td><?=$jugador['nombre_categoria']?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<!-- Totales por género -->
<table>
    <tr class="totales">
        <td colspan="2">Total Femenino: <?=$totalF?></td>
        <td colspan="2">Total Masculino: <?=$totalM?></td>
        <td>Total General: <?=$totalF+$totalM?></td>
    </tr>
</table>

<!-- Tabla por categoría -->
<h3>Jugadores por Categoría</h3>
<table class="categoria-table">
    <thead>
        <tr>
            <th>Categoría</th>
            <th>Cantidad</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categoriasCount as $categoria => $cantidad): ?>
        <tr>
            <td><?= htmlspecialchars($categoria) ?></td>
            <td><?= $cantidad ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>

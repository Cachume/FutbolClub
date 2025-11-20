<?php 
$totalF = 0;
$totalM = 0;

$categoriasCount = [];
if(!empty($this->data)){
    $nombres = array_column($this->data, 'nombre')[0];
}else{
    $nombres = "";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reporte de Cobros</title>
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
<h2>Reporte de Pagos de <?=$nombres?></h2>
<table>
    <thead>
        <tr>
            <th>Nombre Representante</th>
            <th>Telefono</th>
            <th>Jugador</th>
            <th>Categoria</th>
            <th>Estado del Pago</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->data as $jugador):?>
        <tr>
            <td><?=$jugador['nombre_completo']?></td>
            <td><?=$jugador['telefono']?></td>
            <td><?=$jugador['nombres']." ".$jugador['apellidos']?></td>
            <td><?=$jugador['nombre_categoria']?></td>
            <td style="font-weight:bolder; color:<?=($jugador["estado"]=='pendiente' || $jugador["estado"]=='rechazado')?'red':'green';?>;"><?=ucfirst($jugador['estado'])?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FutbolClub/assets/css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Futbol Club | Panel Administrador</title>
</head>
<body>
    <?php include("vistas/layout/header.php") ?>
    <main class="index-main" id="index-main">
   <?php include('vistas/layout/session.php'); ?>
    <div class="estadisticas">
        <h2>Estadistica Jugadores</h2>
    <div class="estadisticas-items">
        <div class="estadistica-item">
            <canvas id="playerChart"></canvas>
        </div>
        <div class="estadistica-item">
            <canvas id="categoriaChart"></canvas>
        </div>
    </div>
    </div>
    </main>
    <script>
        const chartGenerosData = <?php echo json_encode($this->data['chartGeneros']); ?>;
        const chartCategoriasData = <?php echo json_encode($this->data['chartCategorias']); ?>;
    </script>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/indexad.js"></script>
</body>
</html>
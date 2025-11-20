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
   <div class="main-welcome">
            <h3>Bienvenido Nuevamente, Adminstrador</h3>
            <p>Aqui tienes las estadisticas actuales</p>
        </div>
        <div class="main-statistics">
            <div class="statistics-card">
                <div class="statistics-card-titles">
                    <span class="statistics-card-number">23</span>
                    <h5 class="statistics-card-title">Jugadores</h5>
                </div>
                <img src="/FutbolClub/assets/img/futbolista.png" alt="">
            </div>
            <div class="statistics-card">
                <div class="statistics-card-titles">
                    <span class="statistics-card-number">50</span>
                    <h5 class="statistics-card-title">Representantes</h5>
                </div>
                <img src="/FutbolClub/assets/img/familia.png" alt="">
            </div>
            <div class="statistics-card">
                <div class="statistics-card-titles">
                    <span class="statistics-card-number">15</span>
                    <h5 class="statistics-card-title">Entrenadores</h5>
                </div>
                <img src="/FutbolClub/assets/img/entrenadores.png" alt="">
            </div>
        </div>
    </div>    
    <div class="main-data">
        <div class="barras">
            <div class="estadisticas">
                <h2>Estadistica Jugadores</h2>
                <div class="estadisticas-items">
                    <div class="estadistica-item">
                        <h4>Generos</h4><br>
                        <canvas id="playerChart"></canvas>
                    </div>
                    <div class="estadistica-item">
                        <h4>Categorias</h4><br>
                        <canvas id="categoriaChart"></canvas>
                    </div>
                </div>
            </div>    
        </div>
        <div class="top">
            <h2>Top Jugadores</h2>
            <table class="category-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Puntaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($this->top as $tops ):?>
                            <tr>
                                <td><?=$tops['nombres']." ".$tops['apellidos'];?></td>
                                <td><?=$tops['nombre_categoria'];?></td>
                                <td><?=$tops['puntaje_total'];?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
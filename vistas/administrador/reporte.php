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
   <div class="reportes-container">
        <h2>Generar Reportes del Club</h2>

        <div class="selector-reporte">
            <label for="tipoReporte">Selecciona el tipo de Reporte:</label>
            <select id="tipoReporte" onchange="mostrarIndicadores()">
            <option value="">-- Elige una Opción --</option>
            <option value="categoria">Reporte Categorias</option>
            <option value="cobros">Reporte de Cobros</option>
            <option value="pagos">Reporte de Pagos Jugadores</option>
            <option value="partidos">Reporte de Resultados de Partidos</option>
            </select>
        </div>
        <hr>
        <form id="form-pagos" class="reporte-form" style="display:none;" action="/FutbolClub/reportes/pagos" method="POST" target="_blank">
            <h3>Indicadores: Pagos Jugadores</h3>
            <div class="contenedor-indicadores">
                <label for="filtroCategoria">Filtrar por Pago:</label>
                <select id="filtroCategoria" name="pago">
                    <?php foreach ($this->data as $key):?>
                    <option value="<?=$key['id']?>"><?=$key['nombre']?></option>
                    <?php endforeach;?>
                </select>
                <button type="submit" class="btn-generar">Generar Reporte de Pagos Jugadores</button>
            </div>
        </form>

        <form id="form-cobros" class="reporte-form" style="display:none;" 
            action="/FutbolClub/reportes/cobros" method="POST" target="_blank">
            <h3>Indicadores: Cobros Mensuales</h3>
            <div class="contenedor-indicadores">
                <label for="fechaInicio">Desde:</label>
                <input type="month" id="fechaInicio" name="fecha" required>
                <button type="submit" class="btn-generar">Generar Cobros</button>
            </div>
        </form>

        <form id="form-categoria" class="reporte-form" style="display:none;" 
            action="/FutbolClub/reportes/categoria" method="POST" target="_blank">
            <h3>Indicadores: Categorias</h3>
            <div class="contenedor-indicadores">
                <label for="filtroEstado">Categorias:</label>
                <select id="filtroEstado" name="categoria">
                    <?php foreach ($this->categorys as $categoria):?>
                    <option value="<?=$categoria['id']?>"><?=$categoria['nombre_categoria']?></option>
                    <?php endforeach;?>
                    </select>
                <button type="submit" class="btn-generar">Generar Reporte Financiero</button>
            </div>
        </form>
        
        <p id="mensajeInicio">Selecciona un tipo de reporte para configurar los filtros.</p>
        </div>
    </main>
    <script>
        const chartGenerosData = <?php echo json_encode($this->data['chartGeneros']); ?>;
        const chartCategoriasData = <?php echo json_encode($this->data['chartCategorias']); ?>;
    </script>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/jquery.js"></script>
    <script src="/FutbolClub/assets/js/reporte.js"></script>
</body>
</html>
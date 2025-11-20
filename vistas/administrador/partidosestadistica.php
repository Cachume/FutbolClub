<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FutbolClub/assets/css/index.css">
    <link rel="stylesheet" href="/FutbolClub/assets/css/players.css">
    <link rel="stylesheet" href="/FutbolClub/assets/css/toastr.min.css">
    <title>Futbol Club | Panel Administrador</title>
</head>
<body>
    <?php include("vistas/layout/header.php") ?>
    <main class="index-main" id="index-main">
<?php include('vistas/layout/session.php'); ?>
        <div class="list_categorys">
            <div class="list_categorys-titles">
                <h2>Registrar Estadísticas del Partido</h2>

            </div>
            <div class="categorys">
            <form action="/administrador/guardarEstadisticas" method="POST">
                    <input type="hidden" name="partido_id" value="<?= $this->data[0]['categoria']['id_partido'] ?? $this->categoria ?>">
                    <?php foreach ($this->data as $bloque): ?>
                        <h3 style="margin-top:20px;">
                            Categoría: <?= $bloque["categoria"]["nombre_categoria"] ?>
                        </h3>
                        <table border="1" class="category-table" width="100%" style="border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th>Jugador</th>
                                    <th>Goles</th>
                                    <th>Asistencias</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bloque["jugadores"] as $j): ?>
                                    <tr>
                                        <td><?= $j["nombres"] ?></td>
                                        <td class="modal-category-form-field">
                                            <input type="number" 
                                                min="0" value="0"
                                                name="goles[<?= $bloque['categoria']['id'] ?>][<?= $j['id'] ?>]">
                                        </td>
                                        <td class="modal-category-form-field">
                                            <input type="number" 
                                                min="0" value="0"
                                                name="asistencias[<?= $bloque['categoria']['id'] ?>][<?= $j['id'] ?>]">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endforeach; ?>
                    <br>
                    <button type="submit" class="new-button-part">Guardar Estadísticas</button>
                </form>
            </div>
        </div>
    </main>
    <div class="modal-category">
        <div class="modal-bg"></div>
        <form  method="post" class="modal-category-form">
            <div class="modal-category-title">
                <h2>Nuevo Partido</h2>
            </div>
            <br>
            <div class="modal-container">
                <div class="modal-container-one">
                    <div class="modal-category-form-field">
                        <label for="nombre">Nombre del Partido:</label>
                        <input type="text" id="nombre_partido" name="nombre_partido" required>
                        <span class="mensaje-error" id="nombre-error"></span>
                    </div>
                    <div class="modal-category-form-field">
                        <label for="nombre">Descripción del Partido:</label>
                        <textarea id="descripcion_partido" name="descripcion_partido" required></textarea>
                        <span class="mensaje-error" id="nombre-error"></span>
                    </div>
                    <div class="modal-category-form-field">
                        <label for="nombre">Fecha del partido:</label>
                        <input type="date" id="fecha_partido" name="fecha_partido" required>
                        <span class="mensaje-error" id="nombre-error"></span>
                    </div>
                </div>
                <div class="modal-container-two">
                    <fieldset class="category-group">
                        <legend>Seleccionar Categorías Aplicables:</legend>    
                        <div class="category-grid">
                            <?php foreach ($this->categoria as $dato ):?>
                        <div class="category-item">
                            <input type="checkbox" name="categorias[]" value="<?php echo $dato['id']?>" id="">
                            <span><?php echo $dato['nombre_categoria']?></span>
                        </div>
                        <?php endforeach;?>               
                        </div>
                    </fieldset>
                </div>
            </div>
            
            <div class="modal-category-buttons">
                <button type="submit" id="crearpartido">Crear Partido</button>
                <button type="button" class="close-modal">Cerrar</button>
            </div>
        </form>
    </div>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/jquery.js"></script>
    <script src="/FutbolClub/assets/js/categoria.js"></script>
    <script src="/FutbolClub/assets/js/partido.js"></script>
    <script src="/FutbolClub/assets/js/toastr.min.js"></script>
</body>
</html>
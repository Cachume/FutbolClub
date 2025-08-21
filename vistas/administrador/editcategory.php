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
        <div class="list_categorys">
            <div class="list_categorys-titles">
                <h2>Editar la Categoria <?php echo $this->categoria['nombre_categoria']; ?></h2>
                <!-- <button>Añadir Categoria</button> -->
            </div>
            <form action="/FutbolClub/administrador/updateCategory" method="post" class="modal-category-form" id="modal-category-form" style="position: relative;">

                <!-- ID oculto para saber qué categoría editar -->
                <input type="hidden" name="id" value="<?php echo $this->categoria['id']; ?>">

                <div class="modal-category-title">
                    <!-- <h2>Editar Categoria</h2> -->
                </div>

                <!-- Nombre categoría -->
                <label for="nombre_categoria">Nombre Categoría:</label>
                <input 
                    type="text" 
                    id="nombre_categoria" 
                    name="nombre_categoria" 
                    value="<?php echo $this->categoria['nombre_categoria']; ?>" 
                    required
                >

                <!-- Periodo -->
                <label for="periodo">Periodo:</label>
                <select id="periodo" name="periodo" required>
                    <option value="">Seleccione...</option>
                    <option value="2020-2021" <?php echo ($this->categoria['periodo'] == '2020-2021') ? 'selected' : ''; ?>>2020-2021</option>
                    <option value="2018-2019" <?php echo ($this->categoria['periodo'] == '2018-2019') ? 'selected' : ''; ?>>2018-2019</option>
                    <option value="2016-2017" <?php echo ($this->categoria['periodo'] == '2016-2017') ? 'selected' : ''; ?>>2016-2017</option>
                    <option value="2014-2015" <?php echo ($this->categoria['periodo'] == '2014-2015') ? 'selected' : ''; ?>>2014-2015</option>
                    <option value="2012-2013" <?php echo ($this->categoria['periodo'] == '2012-2013') ? 'selected' : ''; ?>>2012-2013</option>
                    <option value="2011-2010" <?php echo ($this->categoria['periodo'] == '2011-2010') ? 'selected' : ''; ?>>2011-2010</option>
                    <option value="2008-2009" <?php echo ($this->categoria['periodo'] == '2008-2009') ? 'selected' : ''; ?>>2008-2009</option>
                </select>

                <!-- Entrenador -->
                <label for="entrenador_id">Entrenador:</label>
                <select id="entrenador_id" name="entrenador_id">
                    <option value="">Sin asignar</option>
                    <?php
                        foreach ($this->trainers as $trainer) {
                            $selected = ($this->categoria['entrenador_id'] == $trainer['id']) ? 'selected' : '';
                            echo "<option value='".$trainer['id']."' $selected>".$trainer['nombre_completo']."</option>";
                        }
                    ?>
                </select>

                <!-- Horario -->
                <label for="horario">Horario:</label>
                <input 
                    type="text" 
                    id="horario" 
                    name="horario" 
                    value="<?php echo $this->categoria['horario']; ?>" 
                    required
                >

                <!-- Botones -->
                <div class="modal-category-buttons">
                    <button type="submit">Editar Categoria</button>
                    <button type="button" onclick="window.history.back()">Regresar</button>
                </div>
            </form>
        </div>
    </main>
    <div class="modal-category">
        <div class="modal-bg"></div>
        
    </div>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/jquery.js"></script>
    <script src="/FutbolClub/assets/js/categoria.js"></script>
</body>
</html>
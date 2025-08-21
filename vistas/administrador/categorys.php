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
                <h2>Categorias</h2>
                <button id="add-category-button">Añadir Categoria</button>
            </div>
            <?php
                if(isset($_GET['success'])) {
                    echo "<p class='success-message'>".$_GET['success']."</p>";
                }elseif(isset($_GET['error'])) {
                    echo "<p class='error-message'>".$_GET['error']."</p>";
                }
            ?>
            <div class="categorys">
                <table class="category-table">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Horario</th>
                            <th>Periodo</th>
                            <th>Entrenador</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($this->categorys as $categoria):?>
                        <tr data-id="<?php echo $categoria['id']?>">
                            <td><?php echo $categoria['nombre_categoria']?></td>
                            <td><?php echo $categoria['horario']?></td>
                            <td><?php echo $categoria['periodo']?></td>
                            <td><?php echo $categoria['nombre_entrenador']?></td>
                            <td>
                                <a class="edit-button" ><img src="/FutbolClub/assets/img/editar.png" alt=""></a>
                                <a class="delete-button" data-id="<?php echo $categoria['id']?>" data-name="<?php echo $categoria['nombre_categoria']?>"><img src="/FutbolClub/assets/img/papelera.png" alt=""></a>
                            </td>
                        </tr>
                        <?php endforeach;
                        ?>
                    </tbody>
                </table>        
            </div>
        </div>
    </main>
    <div class="modal-category">
        <div class="modal-bg"></div>
        <form action="/FutbolClub/administrador/addCategory" method="post" class="modal-category-form" id="modal-category-form">
            <div class="modal-category-title">
                <h2>Añadir Categoria</h2>
            </div>
            <label for="nombre_categoria">Nombre Categoría:</label>
            <input type="text" id="nombre_categoria" name="nombre_categoria" placeholder="Ejemplo: Sub-15" required>

            <label for="periodo">Periodo:</label>
            <select id="periodo" name="periodo" required>
            <option value="">Seleccione...</option>
            <option value="2020-2021">2020-2021</option>
            <option value="2018-2019">2018-2019</option>
            <option value="2016-2017">2016-2017</option>
            <option value="2014-2015">2014-2015</option>
            <option value="2012-2013">2012-2013</option>
            <option value="2011-2010">2011-2010</option>
            <option value="2008-2009">2008-2009</option>
            </select>

            <label for="entrenador_id">Entrenador:</label>
            <select id="entrenador_id" name="entrenador_id">
                <option value="">Sin asignar</option>
                <?php
                    foreach ($this->trainers as $trainer) {
                        echo "<option value='".$trainer['id']."'>".$trainer['nombre_completo']."</option>";
                    }
                ?>
            </select>

            <label for="horario">Horario:</label>
            <input type="text" id="horario" name="horario" placeholder="Ejemplo: 4:00pm - 5:00pm" required>
            <div class="modal-category-buttons">
                <button type="submit">Crear Categoria</button>
                <button type="reset">Limpiar</button>
                <button>Cerrar</button>
            </div>
        </form>
    </div>
    <div id="deleteModal" class="modal" style="display:none;">
        <div class="modal-content">
            <h3>¿Estás seguro de eliminar esta categoría?</h3>
            <p id="categoryName"></p>
            <input type="hidden" id="deleteId">
            <div class="modal-buttons">
            <button id="confirmDelete">Eliminar</button>
            <button id="cancelDelete">Cancelar</button>
            </div>
        </div>
    </div>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/jquery.js"></script>
    <script src="/FutbolClub/assets/js/categoria.js"></script>
</body>
</html>
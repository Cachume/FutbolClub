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
                <h2>Partidos</h2>
                <button class="new-button-part" id="add-category-button">Nuevo Partido</button>
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
                            <th>Nombre</th>
                            <th>Fecha del Partido</th>
                            <th>Categorias</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->data as $dato ):?>
                        <tr>
                            <td><?=$dato['NombrePartido'];?></td>
                            <td><?=$dato['FechaPartido'];?></td>
                            <td><?=$dato['CategoriasAplicables'];?></td>
                            <td>
                            <?php 
                                if($dato['completo']==0){
                                    echo "<a href='/FutbolClub/administrador/partidos/".$dato['id']."' class='new-button-part re'>Completar</a>";
                                }else{
                                    echo "<a href='/FutbolClub/reportes/partidos/".$dato['id']."' class='new-button-part vi'>Visualizar</a>";
                                }
                            
                            ?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>        
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
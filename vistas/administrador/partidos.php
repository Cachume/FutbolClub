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
                        <tr>
                            <td>Sub-23</td>
                            <td>4:00pm - 5:00pm</td>
                            <td>2014-2015</td>
                            <td>
                                <a class="edit-button"><img src="../../assets/img/editar.png" alt=""></a>
                                <a class="delete-button"><img src="../../assets/img/papelera.png" alt=""></a>
                            </td>
                        </tr>
                    </tbody>
                </table>        
            </div>
        </div>
    </main>
    <div class="modal-category">
        <div class="modal-bg"></div>
        <form action="" method="post" class="modal-category-form">
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
                            <div class="category-item">
                                <input type="checkbox" id="sub5" name="categorias[]" value="sub-5">
                                <label for="sub5">Sub-5</label>
                            </div>                    
                            <div class="category-item">
                                <input type="checkbox" id="sub7" name="categorias[]" value="sub-7">
                                <label for="sub7">Sub-7</label>
                            </div>                    
                            <div class="category-item">
                                <input type="checkbox" id="sub9" name="categorias[]" value="sub-9">
                                <label for="sub9">Sub-9</label>
                            </div>                  
                            <div class="category-item">
                                <input type="checkbox" id="sub11" name="categorias[]" value="sub-11">
                                <label for="sub11">Sub-11</label>
                            </div>                 
                            <div class="category-item">
                                <input type="checkbox" id="sub13" name="categorias[]" value="sub-13">
                                <label for="sub13">Sub-13</label>
                            </div>         
                            <div class="category-item">
                                <input type="checkbox" id="sub17" name="categorias[]" value="sub-17">
                                <label for="sub17">Sub-17</label>
                            </div>                  
                            <div class="category-item">
                                <input type="checkbox" id="sub15" name="categorias[]" value="sub-15">
                                <label for="sub15">Sub-15</label>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            
            <div class="modal-category-buttons">
                <button type="submit">Crear Partido</button>
                <button type="button" class="close-modal">Cerrar</button>
            </div>
        </form>
    </div>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/jquery.js"></script>
    <script src="/FutbolClub/assets/js/categoria.js"></script>
</body>
</html>
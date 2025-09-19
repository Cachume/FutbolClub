
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
        <div class="playerlist-container">
            <h2>Metodos de Pago</h2>
            <div class="playerlist-actions">
                <button id="add-metodo-button" class="action-button">Añadir Metodo de Pago</button>
                <input type="text" id="search-player" placeholder="Buscar Metodo de Pago..." onkeyup="filtrarTabla()">
            </div>
            <table class="player-table" id="player-table">
                <thead>
                    <tr>
                        <th>Metodo</th>
                        <th>Titular</th>
                        <th>Numero de Cuenta</th>
                        <th>Banco</th>
                        <th>Detalles</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="player-list">
                    <?php
        if (empty($this->data)) {
            echo '<tr><td colspan="6">No hay Metodos de Pago registrados.</td></tr>';
        } else {
            foreach ($this->data as $metodo) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($metodo['metodo']) . '</td>';
                echo '<td>' . htmlspecialchars($metodo['titular']) . '</td>';
                echo '<td>' . htmlspecialchars($metodo['numero_cuenta']) . '</td>';
                echo '<td>' . htmlspecialchars($metodo['banco']) . '</td>';
                echo '<td>' . htmlspecialchars($metodo['detalles']) . '</td>';
                echo '<td>
                        <a class="edit-representative" data-id="' . htmlspecialchars($metodo['id']) . '"><img src="/FutbolClub/assets/img/editar.png" alt=""></a>
                        <a class="delete-representative" data-id="' . htmlspecialchars($metodo['id']) . '" data-name="' . htmlspecialchars($metodo['metodo']) . '"><img src="/FutbolClub/assets/img/papelera.png" alt=""></a>
                      </td>';
                echo '</tr>';
            }
        }
        ?>
                </tbody>
            </table>
        </div>
    </main>
    <div class="modal-category">
        <div class="modal-bg"></div>
        <form method="post" class="modal-category-form">
            <div class="modal-category-title">
                <h2>Editar Metodo de Pago</h2>
            </div>
            <input type="hidden" name="id" id="metodo-id">
            <div class="modal-category-form-field">
                <label for="metodo">Metodo:</label>
                <input type="text" id="metodo" name="metodo" required>
                <span class="mensaje-error" id="nombre-error"></span>
            </div>
            <div class="modal-category-form-field">
                <label for="cedula">Titular:</label>
                <input type="text" id="titular" name="titular" required>
                <span class="mensaje-error" id="cedula-error"></span>
            </div>
            <div class="modal-category-form-field">
                <label for="fecha_nacimiento">Numero de Cuenta:</label>
                <input type="text" id="numero_cuenta" name="numero_cuenta" required>
                <span class="mensaje-error" id="fecha_nacimiento-error"></span>
            </div>
            <div class="modal-category-form-field">
                <label for="telefono">Banco:</label>
                <input type="text" id="banco" name="banco" maxlength="16" required>
                <span class="mensaje-error" id="telefono-error"></span>
            </div>
            <div class="modal-category-form-field">
                <label for="correo">Detalles:</label>
                <input type="email" id="detalles" name="detalles" required>
                <span class="mensaje-error" id="correo-error"></span>
            </div>            
            <div class="modal-category-buttons">
                <button type="submit">Guardar Cambios</button>
                <button type="button" class="close-modal">Cerrar</button>
            </div>
        </form>
    </div>
    <div id="deleteModal" class="modal" style="display:none;">
        <div class="modal-content">
            <h3>¿Estás seguro de eliminar este metodo de pago?</h3>
            <p id="representativeName"></p>
            <input type="hidden" id="deleteId">
            <div class="modal-buttons">
            <button id="confirmDelete">Eliminar</button>
            <button id="cancelDelete">Cancelar</button>
            </div>
        </div>
    </div>
    <script src="/FutbolClub/assets/js/jquery.js"></script>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/edit_representative.js"></script>
    <script src="/FutbolClub/assets/js/toastr.min.js"></script>
</body>
</html>
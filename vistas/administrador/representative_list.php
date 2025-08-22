
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
            <h2>Representantes Registrados</h2>
            <div class="playerlist-actions">
                <!-- <button id="add-player-button" class="action-button">Añadir Jugador</button> -->
                <input type="text" id="search-player" placeholder="Buscar Representante por Cedula..." onkeyup="filtrarTabla()">
            </div>
            <table class="player-table" id="player-table">
                <thead>
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="player-list">
                    <?php
        if (empty($this->jugadores)) {
            echo '<tr><td colspan="6">No hay jugadores registrados.</td></tr>';
        } else {
            foreach ($this->jugadores as $jugador) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($jugador['nombre_completo']) . '</td>';
                echo '<td>' . htmlspecialchars($jugador['fecha_nacimiento']) . '</td>';
                echo '<td>' . htmlspecialchars($jugador['telefono']) . '</td>';
                echo '<td>' . htmlspecialchars($jugador['correo']) . '</td>';
                echo '<td>' . htmlspecialchars($jugador['direccion']) . '</td>';
                echo '<td>
                        <a class="edit-representative" data-id="' . htmlspecialchars($jugador['id']) . '"><img src="/FutbolClub/assets/img/editar.png" alt=""></a>
                        <a class="delete-representative" data-id="' . htmlspecialchars($jugador['id']) . '"><img src="/FutbolClub/assets/img/papelera.png" alt=""></a>
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
                <h2>Editar Representante</h2>
            </div>
            <input type="hidden" name="id" id="representative-id">
            <div class="modal-category-form-field">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" required>
                <span class="mensaje-error" id="nombre-error"></span>
            </div>
            <div class="modal-category-form-field">
                <label for="cedula">Cedula de Identidad:</label>
                <input type="number" id="cedula" name="cedula" maxlength="8" required>
                <span class="mensaje-error" id="cedula-error"></span>
            </div>
            <div class="modal-category-form-field">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                <span class="mensaje-error" id="fecha_nacimiento-error"></span>
            </div>
            <div class="modal-category-form-field">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" maxlength="16" required>
                <span class="mensaje-error" id="telefono-error"></span>
            </div>
            <div class="modal-category-form-field">
                <label for="correo">Correo Electronico:</label>
                <input type="email" id="correo" name="correo" required>
                <span class="mensaje-error" id="correo-error"></span>
            </div>
            <div class="modal-category-form-field">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" >
                <span class="mensaje-error" id="direccion-error"></span>
            </div>
            
            <div class="modal-category-buttons">
                <button type="submit">Guardar Cambios</button>
                <button type="button" class="close-modal">Cerrar</button>
            </div>
        </form>
    </div>
    <script src="/FutbolClub/assets/js/jquery.js"></script>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/edit_representative.js"></script>
    <script src="/FutbolClub/assets/js/toastr.min.js"></script>
</body>
</html>
<?php
    if (isset($this->erroresf)) {
        var_dump($this->erroresf);
    }
?>

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
    <form action="/FutbolClub/administrador/verificacionRe" method="post" class="verificacion-form">
        <fieldset>
            <legend>Verificación Previa</legend>

            <p class="verificacion-descripcion">
                Antes de registrar a un jugador, asegúrate de que su representante esté registrado en el sistema.
                Ingresa la cédula del representante para continuar.
            </p>

            <label for="cedula-representante">Cédula del Representante:</label>
            <input 
                type="number" 
                id="cedula-representante" 
                name="cedula-representante" 
                placeholder="Ej. 12345678" 
                required 
                maxlength="8"
                inputmode="numeric"
            >

            <p id="mensaje-error" style="display:none; color:red; font-weight:bold; margin-top:10px;"></p>

            <div class="verificacion-botonera">
                <button type="submit" name="vefref">Continuar</button>
                <a href="new_representantes" class="btn-alt">¿No está registrado? Crear representante</a>
            </div>
        </fieldset>
    </form>
    </main>
    </main>
        <script>
    const inputCedula = document.getElementById('cedula-representante');
    const mensajeError = document.getElementById('mensaje-error');

    // Validación en tiempo real: solo números, máximo 8 dígitos
    inputCedula.addEventListener('input', function () {
        // Elimina todo lo que no sea dígito
        this.value = this.value.replace(/[^\d]/g, '');

        // Corta a máximo 8 dígitos
        if (this.value.length > 8) {
            this.value = this.value.slice(0, 8);
        }
    });

    // Validación al enviar
    document.querySelector('.verificacion-form').addEventListener('submit', function (e) {
        const cedula = inputCedula.value.trim();

        if (!/^\d{7,8}$/.test(cedula)) {
            e.preventDefault(); // Detiene el envío si la cédula no es válida
            mensajeError.textContent = "La cédula debe contener entre 7 y 8 dígitos numéricos.";
            mensajeError.style.display = "block";
            inputCedula.classList.add('input-error');
        } else {
            mensajeError.textContent = "";
            mensajeError.style.display = "none";
            inputCedula.classList.remove('input-error');
        }
    });
    </script>
    <script src="/FutbolClub/assets/js/index.js"></script>
    <script src="/FutbolClub/assets/js/players.js"></script>
</body>
</html>


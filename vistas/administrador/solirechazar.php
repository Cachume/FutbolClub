<main class="solicitud-admin">
        <div class="solicitudinfo">
            <h1>Solicitud rechazada exitosamente</h1>
            <img src="assets/icons/error.png" alt="" srcset="">
            <h2>Se ha rechazado la solicitud</h2>
            <span>Motivo: <?php echo $this->motivo; ?></span>
            <p>Se le ha enviado un correo al usuario informando que su solicitud ha sido rechazada</p>
            <a href="index.php?u=administrador&m=solicitudes">Regresar</a>
        </div>
    </main>
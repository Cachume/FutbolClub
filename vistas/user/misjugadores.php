<?php
    require_once 'vistas/layout/user/header.php';
    // var_dump($this->data);
?>

    <section class="content-main">
            <h2>Mis Jugadores</h2>
            <div class="cards-container">
                <?php foreach ($this->data as $jugador): ?>
                    <div class="card-player">
                        <img src="/FutbolClub/<?php echo $jugador['foto']; ?>" alt="<?php echo $jugador['nombres']." ".$jugador['apellidos']; ?>">
                        <h3><?php echo $jugador['nombres']." ".$jugador['apellidos']; ?></h3>
                        <p>Edad: <?php echo $jugador['fecha_nacimiento']; ?> años</p>
                        <p>Posición: <?php echo $jugador['nombre_camiseta']; ?></p>
                    <p>Equipo: Infantil A</p>
                    <button>Ver Más</button>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>    
    <script src="/FutbolClub/assets/js/index.js"></script>
</body>
</html>
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
                        <p><strong>Fecha de Nacimiento:</strong> <?=$jugador['fecha_nacimiento']; ?></p>
                        <p><strong>Genero:</strong> <?=$jugador['genero']; ?></p>
                        <p><strong>Categoria:</strong> <?=$jugador['nombre_categoria']; ?></p>
                        <p><strong>Horario:</strong> <?=$jugador['horario']; ?></p>
                        <p><strong>Entrenador:</strong> <?=$jugador['nombre_completo']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>    
    <script src="/FutbolClub/assets/js/index.js"></script>
</body>
</html>
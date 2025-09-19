<?php
    require_once 'vistas/layout/user/header.php';
    // var_dump($this->data);
?>

    <section class="content-pays">
            <header class="pays-header">
                <h2>Pagos Pendientes</h2>
                <button>Pagar Todos</button>
            </header>
            <table class="player-table" id="player-table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nombre y Apellido</th>
                        <th>Posición</th>
                        <th>Cedula</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="player-list">

                </tbody>
            </table>
        </section>
    </main>    
    <script src="/FutbolClub/assets/js/index.js"></script>
</body>
</html>
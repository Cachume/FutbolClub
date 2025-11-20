<?php
    require_once 'vistas/layout/user/header.php';
?>
    <div class="main-welcome">
            <h3>Bienvenido Nuevamente, <?=$_SESSION["username"];    ?></h3>
            <p>Aqui tienes las estadisticas actuales</p>
    </div>
    <div class="main-statistics">
            <div class="statistics-card" >
                <div class="statistics-card-titles">
                    <span class="statistics-card-number" style="color:#2758ae;">23</span>
                    <h5 class="statistics-card-title">Mis Jugadores</h5>
                </div>
                <img src="/FutbolClub/assets/img/jugadores.png" alt="">
            </div>
            <div class="statistics-card" >
                <div class="statistics-card-titles">
                    <span class="statistics-card-number" style="color:#2758ae;">50</span>
                    <h5 class="statistics-card-title">Pagos Pendientes</h5>
                </div>
                <img src="/FutbolClub/assets/img/cartera.png" alt="">
            </div>
    </div>
        <br>
        <div class="datas">
            <div class="my_players">
                <h3>Mis jugadores</h3>
                <table class="player-table" id="player-table" >
                    <thead>
                        <tr>
                            <th style="background:#2758ae;">Nombre Completo</th>
                            <th style="background:#2758ae;">Categoria</th>
                            <th style="background:#2758ae;">Horario</th>
                        </tr>
                    </thead>
                    <tbody id="player-list">
                        <?php
                            if (empty($this->data)):
                                echo '<tr><td colspan="6">No hay Jugadores registrados.</td></tr>';
                            else:
                                foreach ($this->data as $metodo):?>
                                    <tr>
                                        <td><?php echo $metodo['nombres']." ".$metodo['apellidos']?></td>
                                        <td><?php echo $metodo['nombre_categoria'] ?></td>
                                        <td><?php echo $metodo['horario'] ?></td>   
                                    </tr>
                            <?php endforeach;
                                endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="my_players">
                <h3>Mis Pagos</h3>
                <table class="player-table" id="player-table" >
                    <thead>
                        <tr>
                            <th style="background:#2758ae;">Nombre</th>
                            <th style="background:#2758ae;">Fecha</th>
                            <th style="background:#2758ae;">Estado</th>
                        </tr>
                    </thead>
                    <tbody id="player-list">
                        <?php
                        if (empty($this->data2)):
                            echo '<tr><td colspan="6">No hay Metodos de Pago registrados.</td></tr>';
                        else:
                            foreach ($this->data2 as $metodo):?>
                                <tr>
                                    <td><?php echo $metodo['nombre'] ?></td>
                                    <td><?php echo $metodo['fecha_creacion'] ?></td>
                                    <td><?php echo $value = ($metodo['estado']) ? ucfirst($metodo['estado']) : "Sin Pagar" ; ?></td>                                    
                                </tr>
                        <?php endforeach;
                            endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
        <br><br>
        <div class="my_players2">
                <h3>Proximos Juegos</h3>
                <table class="player-table" id="player-table" >
                    <thead>
                        <tr>
                            <th style="background:#2758ae;">Nombre </th>
                            <th style="background:#2758ae;">Descipcion</th>
                            <th style="background:#2758ae;">Fecha</th>
                        </tr>
                    </thead>
                    <tbody id="player-list">
                        <?php
                            if (empty($this->partido)):
                                echo '<tr><td colspan="6">No hay Jugadores registrados.</td></tr>';
                            else:
                                foreach ($this->partido as $metodo):?>
                                    <tr>
                                        <td><?php echo $metodo['nombre']?></td>
                                        <td style="white-space: pre-wrap;"><?php echo $metodo['descripcion'] ?></td>
                                        <td><?php echo $metodo['fecha_partido'] ?></td>   
                                    </tr>
                            <?php endforeach;
                                endif; ?>
                    </tbody>
                </table>
            </div>
    </main>    
    <script src="/FutbolClub/assets/js/index.js"></script>
</body>
</html>
<?php
    require_once 'vistas/layout/user/header.php';
    //var_dump($this->data);
?>

    <section class="content-pays">
            <header class="pays-header">
                <h2>Historial de Pagos</h2>
            </header>
            <table class="player-table" id="player-table">
                <thead>
                    <tr>
                        <th>Nombre </th>
                        <th>Descripcion</th>
                        <!-- <th>Monto</th> -->
                        <th>Fecha Emitido</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="player-list">
                    <?php
                        if (empty($this->data)):
                            echo '<tr><td colspan="6">No hay Metodos de Pago registrados.</td></tr>';
                        else:
                            foreach ($this->data as $metodo):?>
                                <tr>
                                    <td><?php echo $metodo['nombre'] ?></td>
                                    <td><?php echo $metodo['descripcion'] ?></td>
                                    <td><?php echo $metodo['fecha_creacion'] ?></td>
                                    <td><?php echo $value = ($metodo['estado']) ? ucfirst($metodo['estado']) : "Sin Pagar" ; ?></td>
                                    <?php
                                        if(!$metodo['estado']) {
                                            echo '<td><a href="/FutbolClub/usuario/pago/'.$metodo['pago_id'].'">Pagar</a></td>';
                                        }
                                    ?>
                                    
                                </tr>


                        <?php endforeach;
                            endif; ?>

                        
                </tbody>
            </table>
        </section>
    </main>    
    <script src="/FutbolClub/assets/js/index.js"></script>
</body>
</html>
    <main class="solicitudes-admin">
        <h2>Solicitudes de Carnets</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Cedula de Identidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($this->datos == false){
                    echo '<tr><td colspan="5">No hay solicitudes pendientes</td></tr>';
                }else{
                foreach ($this->datos as $fila){?> 
                <tr>
                    <td><?php echo $fila['id'];?></td>
                    <td><?php echo $fila['nombres'];?></td>
                    <td><?php echo $fila['apellidos'];?></td>
                    <td><?php echo $fila['cdi'];?></td>
                    <td>
                        <form action="index.php?u=administrador&m=solicitud" method="post" class="gestio-form">
                        <input type="hidden" name="idu" value="<?php echo $fila['id'];?>">
                            <button class="gestio-form__boton" type="submit" value="solic">Gestionar</button>
                        </form>
                    </td>
                </tr>

            <?php }}?>
            </tbody>
        </table>
    </main>
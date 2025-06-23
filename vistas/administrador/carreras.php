    <main class="solicitudes-admin">
        <div class="solicitudes_titulo">
        <h2>Carreras Registradas</h2>
         <button id="newuser" onclick="showusers()">Añadir Carrera</button>
        </div>
        <?php
            if(isset($this->mensaje)){
                echo "<div class='".$this->mensaje['pam']."'>";
                echo "<span>".$this->mensaje['mensaje']."</span>
                </div>";
            }
            ?> 
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de la carrera</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
             if($this->datos == false){
                echo '<tr><td colspan="5">No hay Carreras registradas</td></tr>';
            }else{
                foreach ($this->datos as $fila){?> 
                <tr>
                    <td><?php echo $fila['id'];?></td>
                    <td><?php echo $fila['carrera'];?></td>
                    <td>
                        <form action="index.php?u=administrador&m=eliminarcarrera" method="post" class="gestio-form">
                        <input type="hidden" name="idu" value="<?php echo $fila['id'];?>">
                            <button class="gestio-form__boton" type="submit" name="ec" value="solic">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php }}?>
            </tbody>
        </table>
        <div class="form_users" id="userform">
            <div class="fondo_users" onclick="hiddenusers()"></div>
            <div class="main-login__reg" style="position: absolute;background: white;padding: 20px 80px;border-radius: 10px;">
            <h2 class="main-login__reg__title" style="color: #00adb4;">Añadir nueva carrera</h2>
            <?php
                if(isset($this->mensaje)){
                    echo "<div class='".$this->mensaje['pam']."'>";
                    echo "<span>".$this->mensaje['mensaje']."</span>
                    </div>";
                }
            ?>  
             <span>Todos los campos son necesarios.</span>
            <form action="index.php?u=administrador&m=crearcarrera" method="post" class="main-login__reg__form">
               
                <span id="errorf" class="errorf"></span>
                <div class="main-login__reg__form__group">
                    <input type="text" name="carrera" placeholder="Ingresa el nombre de la carrera" id="carrera" oninput="validarCarrera()" required style="width: 280px;">
                </div>
                <button type="submit" name="enviado" id="regenv">Añadir Carrera</button>
            </form>
        </div>
        </div>
    </main>
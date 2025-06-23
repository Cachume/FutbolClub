    <main class="solicitudes-admin">
        <div class="solicitudes_titulo">
        <h2>Usuarios Registrados</h2>
         <button id="newuser" onclick="showusers()">Añadir Usuario</button>
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
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Cedula de Identidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
             if($this->datos == false){
                echo '<tr><td colspan="5">No se ha podido obtener los usuarios</td></tr>';
            }else{
                foreach ($this->datos as $fila){?> 
                <tr>
                    <td><?php echo $fila['id'];?></td>
                    <td><?php echo $fila['nombres'];?></td>
                    <td><?php echo $fila['apellidos'];?></td>
                    <td><?php echo $fila['cdi'];?></td>
                    <td>
                        <form action="index.php?u=administrador&m=editarusuario" method="post" class="gestio-form">
                        <input type="hidden" name="idu" value="<?php echo $fila['id'];?>">
                            <button class="gestio-form__boton" type="submit" name="solic" value="solic">Gestionar</button>
                        </form>
                    </td>
                </tr>
            <?php }}?>
            </tbody>
        </table>
        <div class="form_users" id="userform">
            <div class="fondo_users" onclick="hiddenusers()"></div>
            <div class="main-login__reg" style="position: absolute;background: white;padding: 20px 80px;border-radius: 10px;">
            <h2 class="main-login__reg__title" style="color: #00adb4;">Crear cuenta nueva</h2>
            <?php
                if(isset($this->mensaje)){
                    echo "<div class='".$this->mensaje['pam']."'>";
                    echo "<span>".$this->mensaje['mensaje']."</span>
                    </div>";
                }
            ?>  
             <span>Todos los campos son necesarios.</span>
            <form action="index.php?u=administrador&m=registerus" method="post" class="main-login__reg__form">
               
                <span id="errorf" class="errorf"></span>
                <div class="main-login__reg__form__group">
                    <input type="text" name="nombre" placeholder="Nombres" id="nombre" required>
                    <input type="text" name="apellido" placeholder="Apellidos" id="apellido" required>
                </div>
                <div class="main-login__reg__form__group">
                    <input type="text" name="cdi" id="cedula" oninput="validarCedula()" pattern="\d*" placeholder="Cedula de Identidad" required>
                    <input type="email" name="correo" placeholder="Correo Electronico" id="correo" required>
                </div>
                <script>
                        function limitarCaracteres(input, maxLength) {
                            if (input.value.length > maxLength) {
                                input.value = input.value.slice(0, maxLength);
                            }
                        }
                    </script>
                <div class="main-login__reg__form__group">
                    <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    <input type="password" id="passwordc" name="passwordc" placeholder="Confirmar Contraseña" required>
                </div>
                <div class="main-login__reg__form__check">
                    <input type="checkbox" required>
                    <span>Al registrarme acepto todos los Terminos y condiciones</span>
                </div>
                <button type="submit" name="enviado" id="regenv">Crear Cuenta</button>
            </form>
        </div>
        </div>
    </main>
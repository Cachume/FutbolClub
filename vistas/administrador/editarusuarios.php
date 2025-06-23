    <main class="main-edituser">
        <div class="edicionuser">
            <h2>Edición del usuario <?php echo $this->consulta['nombres']." ".$this->consulta['apellidos']?></h2>
            <span>Los datos que no son sustituidos no se modificaran</span>
            <form method="post" action="index.php?u=administrador&m=edicionus&id=<?php echo $this->consulta['id'];?>">
                <div class="form-group">
                    <label for="nombres">Nombres:</label>
                    <input type="text" name="nombres" id="" value="<?php echo $this->consulta['nombres'];?>">
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" name="apellidos" id="" value="<?php echo $this->consulta['apellidos'];?>">
                </div>
                <div class="form-group">
                    <label for="cedula">Cedula de Identidad:</label>
                    <input type="number" name="cedula" id="" value="<?php echo $this->consulta['cdi'];?>">
                </div>
                <div class="form-group">
                    <label for="correo">Correo Electronico:</label>
                    <input type="email" name="correo" id="" value="<?php echo $this->consulta['correo'];?>">
                </div>
                <div class="form-group">
                    <label for="rol">Rol:</label>
                    <select name="rol" id="">
                        <option value="1">Administrador</option>
                        <option value="2">Estudiante</option>
                    </select>
                </div>
                <button type="submit" name="modifiuser">Modificar Datos</button>
            </form>
        </div>
    </main>
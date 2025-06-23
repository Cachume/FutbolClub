    <main class="solicitud-admin">
        <h1>Solicitud de Carnet</h1>
        <div class="solicitud-admin__user">
            <img src="assets/profile_img/<?php echo $this->inf['imagen'];?>" alt="" srcset="">
            <div class="solicitud-admin__user__title">
                <h4>Quien solicita:</h4><span><?php echo $this->inf['nombres']." ".$this->inf['apellidos'];?></span>
            </div>
            <div class="solicitud-admin__user__info">
                <div class="solicitud-admin__user__info__item">
                    <h5>Cedula de Identidad:</h5>
                    <span><?php echo $this->inf['cdi'];?></span>
                </div>
                <div class="solicitud-admin__user__info__item">
                    <h5>Fecha de Nacimiento:</h5>
                    <span><?php echo $this->inf['fecha'];?></span>
                </div>
                <div class="solicitud-admin__user__info__item">
                    <h5>Correo Electronico:</h5>
                    <span><?php echo $this->inf['correo'];?></span>
                </div>
                <div class="solicitud-admin__user__info__item">
                    <h5>Direccion:</h5>
                    <span><?php echo $this->inf['direccion'];?></span>
                </div>
                <div class="solicitud-admin__user__info__item">
                    <h5>Rol:</h5>
                    <span><?php echo $rol = ($_SESSION['rol'] != 1) ? "Estudiante" : "Administrador" ;?></span>
                </div>
                <div class="solicitud-admin__user__info__item">
                    <h5>Sexo:</h5>
                    <span><?php echo $this->inf['sexo'];?></span>
                </div>
                <div class="solicitud-admin__user__info__item">
                    <h5>Carrera</h5>
                    <span><?php echo $this->carre['carrera']." ".$this->inf['tramo'];?></span>
                </div>
            </div>
            <form class="solicitud-admin__user__accions" method="post" action="index.php?u=administrador&m=csolicitud">
                <input type="hidden" name="iduser" value="<?php echo $this->inf['id'];?>">
                <div class="solicitud-admin__user__accions__title" id="check">
                    <input type="checkbox" name="condiciones" id="">
                    <label for="condiciones">Acepto que el usuario cumple todos los requisitos.</label>
                </div>
                <div class="solicitud-admin__user__accions__buttons" id="buttons">
                <button type="submit" class="boton_verde" name="accion" value="aceptar">Aceptar</button>
                <a class="boton_rojoa" id="mostrar" onclick="mostrar()">Rechazar</a>
                </div>
                <div class="rechazar_solicitud" id="rechazo" style="display: none;">
                    <span>Ingresa el motivo de rechazo de la solicitud</span>
                    <input type="text" placeholder="¿Porque vas a recharzar la solicitud?" name="motivo">
                    <button class="boton_rojo" id="mostrar" name="accion" value="rechazar">Rechazar</button>
                </div>
            </form>
        </div>
    </main>
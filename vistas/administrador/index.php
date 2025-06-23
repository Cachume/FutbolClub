
    <main class="main-admin">
        <div class="main-admin__welcome">
            <p>Bienvenido al panel <br> administrativo</p>
            <span><?php echo $_SESSION['nombres']." ".$_SESSION['apellidos'];?></span>
            <img src="assets/profile_img/<?php echo $_SESSION['imagen'];?>" alt="">
        </div>
        <form class="main-admin__system" style="display:none;">
            <h4>El sistema se encuentra</h4>
            <button>Activado</button>
        </form>
    </main>
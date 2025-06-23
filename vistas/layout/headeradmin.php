<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vistas/administrador/css/index.css">
    <link rel="stylesheet" href="vistas/administrador/css/solicitudes.css">
    <link rel="stylesheet" href="vistas/administrador/css/solicitud.css">
    <link rel="stylesheet" href="vistas/administrador/css/solinoti.css">
    <link rel="stylesheet" href="vistas/administrador/css/user.css">
    <link rel="stylesheet" href="vistas/css/index.css">
    <link rel="stylesheet" href="vistas/css/login.css">
    <title>Panel Administrativo</title>
</head>
<body>
    <header class="header-admin">
    <div class="header-desktop__title">
                <img src="assets/icons/imagenuni.png" alt="">
                <span style="color:white;">Panel Administrativo</span>
            </div>
        <ul class="header-admin__lista">
            <li class="header-admin__lista__link"><a href="index.php?u=administrador&m=solicitudes">Solicitudes  </a><span><?php echo $this->soli["COUNT(*)"];?></span></li>
            <li class="header-admin__lista__link"><a href="index.php?u=administrador&m=usuarios">Usuarios  </a><span><?php echo $this->soli2["COUNT(*)"];?></span></li>
            <li class="header-admin__lista__link"><a href="index.php?u=administrador&m=carreras">Carreras  </a></li>
        </ul>
        <?php $rol = ($_SESSION['rol']==1) ? "Administrador" : "Estudiante" ;?>
                    <div class="user_log">
                    <div class="user_log_img">
                    <img src="assets/profile_img/<?php echo $_SESSION['imagen'];?>" alt="">
                    </div>
                    <div class="user_log_data">
                        <a href="index.php?u=perfil" style="color: white;"><?php echo $_SESSION['nombres'].' '.$_SESSION['apellidos'];?></a>
                        <div class="user_logbu">
                        <span class="<?php echo $rol; ?>"><?php echo $rol; ?></span>
                        <a href="index.php?u=perfil"><img src="assets/icons/cerrar-sesion2.png"></a>
                        </div>
                    </div>
                </div>
    </header>
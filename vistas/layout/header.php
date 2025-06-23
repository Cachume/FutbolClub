<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="vistas/css/index.css">
    <link rel="stylesheet" href="vistas/css/login.css">
    <link rel="stylesheet" href="vistas/css/perfil.css">
    <link rel="stylesheet" href="vistas/css/completar.css">
    <link rel="stylesheet" href="vistas/css/carnet.css">
    <title>Carnets | Systems</title>
</head>
<body>
    <header class="headers" <?php if(isset($_GET['m']) && $_GET['m']== "imprimir"){echo "style='display:none;'";}?>>
        <div class="header-mobile">
            <img src="assets/icons/menu-hamburguesa.png" alt="" class="header-mobile__img" id="toggleButton">
            <div class="header-mobile__title">
                <img src="assets/icons/imagenuni.png" alt="" style="width: 30px;">
                <span>Identificacion Estudiantil</span>
            </div>
            <div class="header-mobile__menu hidden" id="header-mobile__menu">
                <?php
                    if(!isset($_SESSION['id'])){
                        echo '
                            <div class="header-mobile__menu__reg">
                                <a href="index.php?u=login">Iniciar Sesion</a>
                            </div>
                        ';
                    }else{
                        echo '
                            <div class="header-mobile__menu__user">
                                <img src="assets/profile_img/'.$_SESSION['imagen'].'" alt="">
                                <span class="header-mobile__menu__user_name">'.$_SESSION['nombres']." ".$_SESSION['apellidos'].'</span>
                                <div class="header-mobile__menu__user_buttons">
                                    <a href="index.php?u=perfil">Perfil</a>
                                    <a href="index.php?u=salir">Cerrar Sesion</a>
                                </div>
                            </div>';
                    }

                ?>
                
                
                <ul class="header-mobile__menu__list">
                    <li class="header-mobile__menu__list__item"><a href="index.php">Inicio</a></li>
                    <li class="header-mobile__menu__list__item"><a href="#Mision">Mision</a></li>
                    <li class="header-mobile__menu__list__item"><a href="#Beneficios">Beneficios</a></li>
                    <li class="header-mobile__menu__list__item"><a href="">Soporte</a></li>
                    <?php if(isset($_SESSION['id'])){
                            if($_SESSION['rol']==1){
                                echo '<li class="header-mobile__menu__list__item"><a href="index.php?u=administrador">Administrador</a></li>';
                            }
                    }?>
                </ul>
            </div>
        </div>
        <div class="header-desktop">
            <div class="header-desktop__title">
                <img src="assets/icons/imagenuni.png" alt="">
                <span>Identificacion Estudiantil</span>
            </div>
            <ul class="header-desktop__list">
                <li class="header-desktop__list__link"><a href="index.php">Inicio</a></li>
                <li class="header-desktop__list__link"><a href="#Beneficios">Beneficios</a></li>
                <li class="header-desktop__list__link"><a href="#Mision">Mision</a></li>
                <li class="header-desktop__list__link"><a href="">Soporte</a></li>
                <?php if(isset($_SESSION['id'])){
                            if($_SESSION['rol']==1){
                                echo '<li class="header-desktop__list__link"><a href="index.php?u=administrador">Administrador</a></li>';
                            }
                    }?>
                
            </ul>
            <?php  
                if(!isset($_SESSION['id'])){
                    echo '
                    <div class="header-desktop__reg">
                    <a href="index.php?u=login">Iniciar Sesion</a>
                    </div>';
                }else{
                    $rol = ($_SESSION['rol']==1) ? "Administrador" : "Estudiante" ;
                    echo '
                    <div class="user_log">
                    <div class="user_log_img">
                    <img src="assets/profile_img/'.$_SESSION['imagen'].'" alt="">
                    </div>
                    <div class="user_log_data">
                        <a href="index.php?u=perfil">'.$_SESSION['nombres'].' '.$_SESSION['apellidos'].'</a>
                        <div class="user_logbu">
                        <span class="'.$rol.'">'.$rol.'</span>
                        <a href="index.php?u=salir"><img src="assets/icons/cerrar-sesion.png"></a>
                        </div>
                    </div>
                </div>';
                }
            ?>

        </div>
    </header>
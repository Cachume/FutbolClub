<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FutbolClub/assets/css/index.css">
    <link rel="stylesheet" href="/FutbolClub/assets/css/myplayers.css">
    <link rel="stylesheet" href="/FutbolClub/assets/css/payments.css">
    <title>Futbol Club | Panel Representante</title>
</head>
<body>
    <div class="barralateral" id="barralateral">
        <div class="logo">
            <img src="/FutbolClub/assets/img/club-brand.png" alt="Logo del Futbol Club">
            <span>FUTBOL CLUB AGUA DULCE </span>
        </div>
        <div class="menu">
            <ul class="menu-items">
                <li class="menu-static">
                    <a href="/FutbolClub/usuario" class="menu-link">
                        <img src="/FutbolClub/assets/img/home-icon.png" alt="Inicio">
                        <span>Inicio</span>
                    </a>
                </li>
                <li class="menu-static">
                    <a href="/FutbolClub/usuario/misJugadores" class="menu-link">
                        <img src="/FutbolClub/assets/img/player.png" alt="Mis Jugadores">
                        <span>Mis Jugadores</span>
                    </a>
                </li>
                <li class="menu-dropdown" id="menu-dropdown">
                    <a href="#" class="menu-link">
                        <img src="/FutbolClub/assets/img/pagos.png" alt="Inicio">
                        <span>Pagos</span>
                        <img src="/FutbolClub/assets/img/arrow.png" alt="Inicio">
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item"><a href="/FutbolClub/usuario/pagar" class="menu-link">Pendientes</a></li>
                        <li class="submenu-item"><a href="/FutbolClub/usuario/historial" class="menu-link">Historial</a></li>
                    </ul>
                </li>
                <!-- <li class="menu-static">
                    <a href="#" class="menu-link">
                        <img src="/FutbolClub/assets/img/config.png" alt="Inicio">
                        <span>Configuración</span>
                    </a>
                </li> -->
                <li class="menu-static">
                    <a href="/FutbolClub/administrador/salir" class="menu-link">
                        <img src="/FutbolClub/assets/img/logout.png" alt="Inicio">
                        <span>Salir</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <main class="index-main" id="index-main">
   <?php include('vistas/layout/user/session.php'); ?>

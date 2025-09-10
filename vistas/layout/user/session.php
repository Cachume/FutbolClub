    <header class="header-main representative">
        <img src="/FutbolClub/assets/img/menu.png" alt="" srcset="" id="btn-menu">
        <div class="profile-admin">
            <img src="/FutbolClub/<?php echo $_SESSION["foto"]; ?>" alt="">
            <div class="profile-data">
                <span><?php echo $_SESSION["username"]; ?></span>
                <span><?php echo $_SESSION["email"]; ?></span>
            </div>
        </div>
    </header>
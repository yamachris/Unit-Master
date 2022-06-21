<header class="navigation">
    <a href="index.php"><img class="logoHeader" src="../logo/logo.svg" alt=""></a>
    <ul>
        <li class="list<?= $activePage === 'home' ? ' active' : '' ?>">
            <a href="index.php">
                <span class="icon">
                    <ion-icon name="home-outline"></ion-icon>
                </span>
                <span class="text">Accueil</span>
            </a>
        </li>
        <li class="list<?= $activePage === 'about' ? ' active' : '' ?>">
            <a href="about.php">
                <span class="icon">
                    <ion-icon name="information-circle-outline"></ion-icon>
                </span>
                <span class="text">À propos</span>
            </a>
        </li>
        <li class="list<?= $activePage === 'message' ? ' active' : '' ?>">
            <a href="chat.php">
                <span class="icon">
                    <ion-icon name="chatbubble-outline"></ion-icon>
                </span>
                <span class="text">Message</span>
            </a>
        </li>
        <li class="list<?= $activePage === 'store' ? ' active' : '' ?>">
            <a href="shop.php">
                <span class="icon">
                    <ion-icon name="cart-outline"></ion-icon>
                </span>
                <span class="text">Boutique</span>
            </a>
        </li>
        <?php
        if (!isset($userVerify)) {
        ?>
        <li class="list<?= $activePage === 'login' ? ' active' : '' ?>">
            <a href="loginAndRegistration.php">
                <span class="icon">
                    <ion-icon name="log-in-outline"></ion-icon>
                </span>
                <span class="text">Login</span>
            </a>
        </li>
        <?php
        } else {
        ?>
        <li class="listactive">
            <a href="logout.php">
                <span class="icon">
                    <ion-icon name="log-out-outline"></ion-icon>
                </span>
                <span class="text">Logout</span>
            </a>
        </li>
        <li class="list<?= $activePage === 'profile' ? ' active' : '' ?>">
            <a href="profile.php">
                <span class="icon">
                    <ion-icon name="person-outline"></ion-icon>
                </span>
                <span class="text">Mon profile</span>
            </a>
        </li>
        <?php } ?>
        <li class="list<?= $activePage === 'play' ? ' active' : '' ?>">
            <a href="loading.php">
                <span class="icon">
                    <ion-icon name="game-controller-outline"></ion-icon>
                </span>
                <span class="text">Jouer</span>
            </a>
        </li>
        <?php

            if (isset($isAdmin) && $isAdmin) {
        ?>
            <li class="list<?= $activePage === 'admin' ? ' active' : '' ?>">
            <a href="admin.php">
                <span class="icon">
                    <ion-icon name="cog-outline"></ion-icon>
                </span>
                <span class="text">Admin</span>
            </a>
        </li>
        <?php
            }

        ?>
        <!-- <div class="indicator"></div> -->
    </ul>
</header>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
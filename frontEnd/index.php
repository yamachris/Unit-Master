<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8" />
        <title>Unit Card Game</title>
        <meta name="description" content="Les régles du jeu" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link rel="icon" type="image/svg+xml" href="../logo/logoBlack.svg" />
    </head>
    
    <!--    Cette page représente la partie page accueil de mon site internet Mon site sera séparer en deux partie avec des points d'ancrage -->

    <body class="body">

        <nav class="navbar">
            <h1 class="title">Sommaire</h1>
            <div class="nav">
                <ul class="navList">
                    <li class="navListItem">
                        <a href="index.php" class="navListLink">Accueil</a>
                    </li>
                    <li class="navListItem">
                        <a href="gameMechanics.php" class="navListLink">Règle du jeu</a>
                    </li>
                    <li class="navListItem">
                        <a href="trashClen.php" class="navListLink">Trash-clen</a>
                    </li>
                    <li class="navListItem">
                        <a href="shuffle.php" class="navListLink">Shuffle</a>
                    </li>
                    <li class="navListItem">
                        <a href="king.php" class="navListLink">King</a>
                    </li>
                    <li class="navListItem">
                        <a href="queen.php" class="navListLink">Queen</a>
                    </li>
                    <li class="navListItem">
                        <a href="jack.php" class="navListLink">Jack</a>
                    </li>
                    <li class="navListItem">
                        <a href="joker.php" class="navListLink">Joker</a>
                    </li>
                    <li class="navListItem">
                        <a href="ten.php" class="navListLink">10 Revolution</a>
                    </li>
                    <li class="navListItem">
                        <a href="seven.php" class="navListLink">7 Chance</a>
                    </li>
                    <li class="navListItem">
                        <a href="unit.php" class="navListLink">Unit</a>
                    </li>
                    <li class="navListItem">
                        <a href="loading.php" class="navListLink">Jeu en construction</a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="content">
            <section class="section first">
                <!-- Logo du 10 -->

                    <div class="TenWrapper">
                        <a class="crossLink" href="ten.php" title="icon 10">
                            <img class="crossImage" src="../icones/TenRevolutionary.svg" alt="icone 10" />
                        </a>
                    </div>

                <div class="unitLogo">
                    <a href="unit.php"><img src="../logo/locoAcceuil.svg" alt="Logo Unit"></a>
                </div>

                <div class="cross">
                    <div class="crossRow">
                        <a class="crossLink" href="king.php" title="icon Roi">
                            <img class="crossImage" src="../icones/King.svg" />
                        </a>
                    </div>

                    <div class="crossRow threeLinks">
                        <a class="crossLink" href="jack.php" title="icon Jack">
                            <img class="crossImage" src="../icones/Jack.svg" />
                        </a>
                        <a class="crossLink" href="joker.php" title="icon JOKER">
                            <img class="crossImage" src="../icones/JOKER.svg" />
                        </a>
                        <a class="crossLink" href="queen.php" title="icon Dame">
                            <img class="crossImage" src="../icones/Queen.svg" />
                        </a>
                    </div>

                    <div class="crossRow">
                        <a class="crossLink" href="seven.php" title="icon 7">
                            <img class="crossImage" src="../icones/SevenLucky.svg" />
                        </a>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
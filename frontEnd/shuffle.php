<?php
    include 'checkUser.php';
    $pageName = 'Mélange des cartes';
    $pageFile = "shuffle.php";

    include 'head.php';
?>

<section class="section">

    <div class="PageLayoutTitle">
    <h1>Mélanger son jeu de carte</h1>
    </div>
        <p>
            Les joueurs on l’a possibilité de mélanger et remélanger leurs jeux entre la pioche propre
            fermé et leur fosse de carte pour se reconstituer un nouveau Deck à tout moment du jeu
            autant de fois que les joueurs le veulent mais oblige les joueurs de se débarrasser des 5
            cartes dans la main pour un mélange complet, et seul les 2 cartes en réserve fermé et posé
            sur la table peuvent être conserver.
        </p>
        <p>
            Par contre si un joueur épuise la totalité de sa pioche de cartes qui renouvelle sa main, il
            doit obligatoire mélanger son jeu de carte pour recréer un nouveau Deck propre, car cela
            évite qu’un joueur retient l’ordre des cartes qui sait défausser sauf que terminer la pioche de
            carte qui renouvelle la main des joueur permet de conserver les 5 cartes qu'ils possèdent en
            main
        </p>
</section>
<section class="comments">
    <?php include 'commentaires.php'; ?>
</section>
        
<?php include 'foot.php'; ?>
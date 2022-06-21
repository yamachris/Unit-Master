<?php
    include 'checkUser.php';
    $pageTitle = 'King';
    $pageFile = "king.php";

    include 'head.php';
?>

<section class="section">
    <div class="PageLayoutTitle">
        <img class="logoPage" src="../icones/King.svg" alt="">
    </div>
    <p>
        Les <span class="importantElement">roi</span> du jeu protège les <span class="importantElement">points de vie ❤️</span> 
        en fonction de leurs <span class="importantElement">enseigne</span> <span class="red">coeur ♥️</span> <span class="red">carreau ♦️</span> 
        <span class="black">trèfles ♣️</span> ou <span class="black">pique ♠️</span>
    </p>
    <p>
        Le <span class="importantElement">roi</span> bloque jusqu’à <span class="importantElement">6 unités</span> 
        de cartes monté sur le terrain de l’adversaire
    </p>
    <p>
        Le <span class="importantElement">roi</span> peut être invoqué sur le jeu avec un <span class="importantElement">7 de chance 🍀</span> 
        ou en sacrifice de <span class="importantElement">3 unités</span> ou avec la carte du <span class="importantElement">JOKER</span> 
        seulement si la carte du <span class="importantElement">roi</span> est possédé dans la main du joueur où ça réserve de 2 cartes fermées
    </p>
    <p>
        Le <span class="importantElement">7 de chance 🍀</span> le <span class="importantElement">JOKER</span> 
        ou les <span class="importantElement">unités</span> sacrifié retourne automatiquement dans la “<span class="importantElement">fosse aux cartes</span>” une fois l’action effectué sur le terrain de jeu
    </p>
</section>
<section class="comments">
    <?php include 'commentaires.php'; ?>
</section>

<?php include 'foot.php'; ?>
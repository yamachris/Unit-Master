<?php
    include 'checkUser.php';
    $pageName = 'Keen';
    $pageFile = "keen.php";

    include 'head.php';
?>

<section class="section">

    <div class="PageLayoutTitle">
        <img class="logoPage" src="../icones/Queen.svg" alt="">
    </div>
        <p>
            Les <span class="importantElement">dame</span> redonne <span class="importantElement">2 point de vie </span> ❤️ 
            à chaque utilisation sur un seul usage possible de la carte et ensuite la carte retourne immédiatement dans 
            la <span class="importantElement">“fosse des cartes”</span>
        </p>
        <p>
            Faire intervenir une <span class="importantElement">dame</span> est considéré comme une action du joueur
        </p>
        <p>
            La <span class="importantElement">dame</span> peut être invoquée sur le jeu avec un <span class="importantElement">7 de chance 🍀</span> 
            ou un sacrifice de <span class="importantElement">2 unités</span> ou avec le<span class="importantElement">JOKER</span> 
            seulement si la carte de la <span class="importantElement">dame</span> est possédé dans la main du joueur où ça réserve de 2 cartes fermées
        </p>
        <p>
            Le <span class="importantElement">7 de chance 🍀</span> le <span class="importantElement">JOKER</span> ou les <span class="importantElement">unités</span> 
            sacrifié retourne automatiquement dans la “<span class="importantElement">fosse des carte</span>” une fois l’action effectuée sur le terrain de jeu
        </p>
</section>
<section class="comments">
    <?php include 'commentaires.php'; ?>
</section>

<?php include 'foot.php'; ?>
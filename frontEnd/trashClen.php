<?php
    include 'checkUser.php';
    $pageName = 'Système de pioche';
    $pageFile = "trashClen.php";

    include 'head.php';
?>

<section class="section">

    <div class="PageLayoutTitle">
    <h1>Le système des pioches des cartes des joueurs</h1>
    </div>
        <p>
            Il existe deux types de pioches, la principale qu’on appelle la  “Pioche fermé” qui
            permet de renouveler sa main de nouvelle cartes au début de chaque tour et la secondaire le "fosse" ou les cartes
            vont quand on se défausse durant les tours pour maintenir toujours un maximum de 5 cartes en main avec 2 cartes en réserve fermé
        </p>
        <p>
            Les joueurs ne peuvent pas dépasser les 5 cartes dans leur main avec 2 cartes en réserve
            fermées sur la table. Les 2 carte fermé en réserve permet de les conserver en cas de
            mélange de son jeu
        </p>
        <p>
            On est obligé de se défaire et d’envoyer des cartes dans la fosse des cartes pour maintenir
            un maximum 5 cartes dans la main et 2 en réserve fermé par tour
        </p>
        <p>
            <strong class="importantElement">Exemple</strong> : Si le joueur a joué 2 cartes, sur le terrain comme (<strong class="importantElement">AS ♠️</strong> avec un <strong class="importantElement">7</strong> ♥️ 
            <strong class="importantElement">de chance</strong> 🍀 )  au tour suivant, il peut récupérer un maximum de 5 cartes dans la main et deux
            en réserve fermé par tour.
        </p>
        <p>
            Le joueur doit se défausser au début de chaque tour que d'une carte qui vient de sa main où ça
            réserve de carte fermé et ne peut en récupérer qu’une seule carte pour la remettre
            dans sa main où ça réserve de carte fermé au tour suivant

        </p>
</section>
<section class="comments">
    <?php include 'commentaires.php'; ?>
</section>

<?php include 'foot.php'; ?>
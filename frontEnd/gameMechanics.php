<?php
    include 'checkUser.php';
    $pageName = 'Régle du jeu';
    $pageFile = "gameMechanics.php";

    include 'head.php';
?>

<section class="section">
    <div class="PageLayoutTitle">
    <h1>Règle de jeu</h1>
    </div>
        <p>
            UNIT est un jeu de <span class="importantElement">carte classique de 54</span>  dont l'objectif est de faire perdre les <span class="importantElement">10 points de
                vie ❤️</span>  de son adversaire
        </p>
        <p>
            Chaque joueur doit avoir leur propre jeu de <span class="importantElement">54 cartes</span> 
        </p>
        <p>
            Le jeu se déroule avec 2 joueurs minimum
        </p>
        <p>
            Pour gagner il faut faire tomber les <span class="importantElement">10 points de
                vie ❤️</span> de l'adversaire (de <span class="importantElement">10</span> au départ) à <span class="importantElement">0</span>
        </p>
        <p>
            Pour attaquer son adversaire, il faut monter les <span class="importantElement">unités</span> de cartes les unes après les autres.
            AS, 2, 3, 4, 5, 6, 7, 8, 9, le 10 qui forme une <span class="importantElement">Révolution</span> au bout de la 10ème carte d’unité
        </p>
        <p>
            Chaque <span class="importantElement">unités</span> doit être monté en fonction de 
            l’<span class="importantElement">enseigne</span> de la carte qui sont <span class="red">cœur ♥️</span>,
            <span class="red">carreau ♦️</span> <span class="black">trèfle ♣️</span> & <span class="black">pique ♠️</span>
        </p>
        <p>
            Il y a <span class="importantElement">4 Unités</span> qui peuvent être en monté
        </p>
        <p>
            AS, 2, 3, 4, 5, 6, 7, 8, 9, 10 <span class="red">cœur ♥️</span>
        </p>
        <p>
            AS, 2, 3, 4, 5, 6, 7, 8, 9, 10 <span class="red">carreau ♦️</span>
        </p>
        <p>
            AS, 2, 3, 4, 5, 6, 7, 8, 9, 10 <span class="black">trèfle ♣️</span>
        </p>
        <p>
            AS, 2, 3, 4, 5, 6, 7, 8, 9, 10 <span class="black">pique ♠️</span>
        </p>
        <p>
            Seul les <span class="importantElement">Rois</span>  peuvent protège intégralement les <span class="importantElement">points de vie ❤️</span> 
            en fonction de leur l'<span>enseigne</span> “<span class="red">cœur ♥️</span> <span class="red">carreau ♦️</span> <span class="black">trèfle ♣️</span> ou <span class="black">pique ♠️</span>”
        </p>
        <p>
            Monter toutes les <span class="importantElement">unités</span> en même temps n’est pas une bonne stratégie de jeu car cela
            retire des <span class="importantElement">7 de chance 🍀</span> dans votre jeu qui vous est nécessaire pour effectuer des actions
            car chaque unité monté vous retire un <span class="importantElement">7 de chance 🍀</span> dans votre réserve 
            <span class="importantElement">deck</span>
        </p>
        <p>
            Il ne peut y avoir qu’une action qui peut être effectuée par tour de joueur avec la possibilité
            de se défausser d'une carte à jouer qui vient de sa main ou de sa réserve en début de tour
        </p>
        <p>
            Une carte qui vient d'être déposée sur le terrain ne peut pas effectuer d’action
            immédiatement et le joueur doit attendre le prochain tour excepté la <span class="importantElement">Dame</span> 
            qui accorde <span class="importantElement">2 points de vie ❤️</span> immédiatement et 
            qui retourne dans la fausse des cartes qui est
            considéré comme une action du joueur.
        </p>
        <p>
            Le <span class="importantElement">Joker</span> possède quelques caractéristiques bien particulières à lui.
        </p>
        <p>
            Il y a seulement le <span class="importantElement">7 de chance 🍀</span> qui permet de jouer une seconde carte qui est
            comptabilisée comme une ensemble d’action.
        </p>
        <p>
            Le jeu carte se compose en deux parties importantes avec les tête de jeu & les Unité
        </p>

        <table class="">
            <thead>
                <tr>
                    <th>Tête de jeu</th>
                    <th>Unité</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Roi</td>
                    <td>AS, 2, 3, 4, 5, 6, 7, 8, 9, 10 <span class="red">cœur ♥️</span> </td>
                </tr>
                <tr>
                    <td>Dame</td>
                    <td>AS, 2, 3, 4, 5, 6, 7, 8, 9, 10 <span class="red">carreau ♦️</span> </td>
                </tr>
                <tr>
                    <td>Valet</td>
                    <td>AS, 2, 3, 4, 5, 6, 7, 8, 9, 10 <span class="black">trèfle ♣️</span> </td>
                </tr>
                <tr>
                    <td>7 de chance 🍀</td>
                    <td>AS, 2, 3, 4, 5, 6, 7, 8, 9, 10 <span class="black">pique ♠️</span>
                </tr>
                <tr>
                    <td>10 REVOLUTION</td>
                </tr>
                <tr>
                    <td>Joker</td>
                </tr>
            </tbody>
        </table>
        <p>
            Les <span class="importantElement">Unités</span> permettent d’attaquer les <span class="importantElement">points de vie ❤️</span>  de l’adversaire si les conditions sont
            favorables
        </p>
        <p>
            Une <span class="importantElement">Unité</span> monté jusqu'à <span class="importantElement">10 cartes</span> forme une <span class="importantElement">Révolution</span> avec les dix cartes monté au
            maximum. 
        </p>
        <p>
            Et le <span class="importantElement">7 de chance 🍀</span> permet de sortir systématiquement son jeu de carte sur le terrain
        </p>
</section>
<section class="comments">
    <?php include 'commentaires.php'; ?>
</section>
  
<?php include 'foot.php'; ?>
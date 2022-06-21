
<?php
include 'checkUser.php';
$pageName = 'Jack';
$pageFile = "jack.php";

include 'head.php';
?>

<section class="section">

    <div class="PageLayoutTitle">
        <img class="logoPage" src="../icones/Jack.svg" alt="">
    </div>
        <p>
            Les <span class="importantElement">valets</span> sont des cartes offensif qui permettent de détruire les cartes d’<span class="importantElement">unités</span> adversaire
            en fonction de la même <span class="importantElement">enseigne</span> quel attaque d’Unité <span class="red">coeur ♥️</span> <span class="red">carreau ♦️</span> 
            <span class="black">trèfles ♣️</span> ou <span class="black">pique ♠️</span>  
        </p>
        <p>
            Elle permet de détruire l’<span class="importantElement">unité 9</span> et ensuite l<span class="importantElement">’unité 8</span> un tour sur 2. Une fois mis sur le terrain
            le <span class="importantElement">valet</span> doit attendre le tour suivant pour attaquer
        </p>
        <p>
            Seul le <span class="importantElement">7 de chance 🍀</span> ne peut pas être détruit et donne la chance d'arrêter une action du
            <span class="importantElement">valet</span> pour protéger les Unité monter jusqu'a <span class="importantElement">6</span> si elle appartient à la bonne <span class="importantElement">Enseigne</span>  
            <span class="red">coeur ♥️</span> <span class="red">carreau ♦️</span> 
            <span class="black">trèfles ♣️</span> ou <span class="black">pique ♠️</span>
        </p>
        <P>
            Si elle attaque l’<span class="importantElement">unité 6</span> toute l'<span class="importantElement">unité</span> entière est détruite et le
            <span class="importantElement">7 de chance 🍀</span> retourne dans la pioche et le Valet est détruit également. 
            Il ne peut détruire que les Unité que de la colone
            que de sa propre <span class="importantElement">enseigne</span> <span class="red">coeur ♥️</span> <span class="red">carreau ♦️</span> 
            <span class="black">trèfles ♣️</span> ou <span class="black">pique ♠️</span>
        </P>
        <P>
            Le Valet peut être invoqué sur le jeu avec un <span class="importantElement">7 de chance 🍀</span> ou le sacrifice d’une unité
            supérieur de <span class="importantElement">6, 8 ou 9</span> ou avec le <span class="importantElement">JOKER</span>
        </P>
        <p>
            Les <span class="importantElement">unités</span> sacrifiées permet que le <span class="importantElement">valet</span> 
            attaque directement dans le même tour
        </p>
        <P>
            Le <span class="importantElement">7 de chance 🍀</span> le <span class="importantElement">JOKER</span> ou 
            les<span class="importantElement">unités</span> 
            sacrifié retourne automatiquement dans la <span class="importantElement">“fosse
            des cartes”</span> une fois l’action effectué sur le terrain de jeu
        </P>
</section>
<section class="comments">
    <?php include 'commentaires.php'; ?>
</section>

<?php include 'foot.php'; ?>
<html>
<head>
	<link rel="icon" type="Création-sans-titre.svg" href="../images/favicon-32x32.ico" />
</head>
<body>
		<meta charset="utf-8" />
		<?php
		$bdd = new PDO('mysql:host=localhost;dbname=Unit;charset=utf8', 'root', 'root');

		if(isset($_GET['id']) AND !empty($_GET['id'])) {
		
			$getid = htmlspecialchars($_GET['id']);

			$article = $bdd->prepare('SELECT * FROM article WHERE id = ?');
			$article->execute(array($getid));
			$article = $article->fetch();
			
			if(isset($_POST['submit_commentaire'])) {
				if(isset($_POST['pseudo'],$_POST['commentaire']) AND !empty($_POST['pseudo']) AND !empty($_POST['commentaire'])) {
					$pseudo = htmlspecialchars($_POST['pseudo']);
					$commentaire = htmlspecialchars($_POST['commentaire']);
					if(strlen($pseudo) < 255) {

						$insert = $bdd->prepare('INSERT INTO commentaire (pseudo, commentaire, id_article, date_time_post) VALUES(?, ?, ?, NOW())');
						$insert->execute(array($pseudo, $commentaire, $getid));
						$c_msg = "<span style='color:green'> Votre commentaire a bien été posté </span>!";

					} else {
						$c_msg = "Erreur: Votre pseudo ne doit pas dépasser 255 caractères !";
					}
				} else {
					$c_msg = "Erreur: Tous les champs doivent être complétés !";
				}
			}
			
			$commentaire = $bdd->prepare('SELECT * FROM commentaire WHERE id_article = ? ORDER BY id DESC');
			$commentaire->execute(array($getid));

		?>

		<h2>Article</h2>
		<p><?php echo $article['contenu']; ?></p>

		<br>

		<h2>Commentaires</h2>
			<form method="POST" action="ton_script_recup_data_form.php">
				<input type="text" name="pseudo" placeholder="Votre pseudo" value="" />
				<textarea name="commentaire" placeholder="Votre commentaire..." rows="60" cols="80"></textarea>
				<input type="submit" value="Poster mon commentaire" name="submit_commentaire"  />
				<input type="submit" value="Envoyer" />
			</form>
		<?php if(isset($c_msg)) { echo  $c_erreur; } ?>
		<br> <br>
		<?php while($c = $commentaires->fetch()) { ?>
			<b><?= $c['pseudo'] ?>:</b> : <?= $c['commentaire'] ?><br>
		<?php } ?>


		<?php
		}
		?>
</body>
</html>
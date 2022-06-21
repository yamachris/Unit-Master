<?php
require("../php/config.php");
if (isset($_POST['resetPWD'])) {
    if (isset($_POST['email_reset']) && !empty($_POST['email_reset']) && isset($_POST['pass_reset']) && !empty($_POST['pass_reset']) && isset($_POST['confirm_reset']) && !empty($_POST['confirm_reset'])) {
        $email = addslashes($_POST['email_reset']);
        $pass = addslashes($_POST['pass_reset']);
        $confirm = addslashes($_POST['confirm_reset']);
        
        
        $get_user = $db->prepare("SELECT * FROM `users` WHERE `email` = '$email'");
        $get_user->execute();
        $row_user = $get_user->rowCount();
        if ($row_user === 1) {
            if ($pass === $confirm) {
                $passwordCrypt = password_hash($pass, PASSWORD_BCRYPT, ["cost" => 14]);
                
                $update_pass = $db->prepare("UPDATE `users` SET `pass` = '$passwordCrypt' WHERE `email` = '$email'");
                $update_pass->execute();
                header("Location: logout.php");
                exit();
            }else $err = '<div class="err"><span>Vos mot de passe doivent être identique.</span></div>';
        }else $err = '<div class="err"><span>Veuillez remplire tout les champs s\'il vous plaît.</span></div>';
    }else $err = '<div class="err"><span>Veuillez remplire tout les champs s\'il vous plaît.</span></div>';
}
?>
<!DOCTYPE html>
<html lang="en fr">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Réinitialiser votre mot de passe</title>
    <link href="../css/forgotPassword.css" rel="stylesheet" type="text/css"  />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="icon" type="Création-sans-titre.svg" href="../images/favicon-32x32.ico" />
    <link href="../css/loginAndRegistration.css" rel="stylesheet" >
</head>	
<body>

<div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Reset mot de passe</span>
                <?php
                if (isset($err)) {
                    echo $err;
                }
                ?>
                <form action="#" method="POST">
                    <div class="input-field">
                        <input type="text" name="email_reset" placeholder="Votre adresse email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="pass_reset" placeholder="Nouveau mot de passe" required>
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="confirm_reset" placeholder="Confirmer" required>
                        <i class="uil uil-lock icon"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="resetPWD" value="Envoyer">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- http://talkerscode.com/webtricks/password-reset-system-using-php.php -->
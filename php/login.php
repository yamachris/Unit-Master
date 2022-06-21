<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
include_once('cookieconnect.php');
if(isset($_POST['formconnexion']))
{
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if(!empty($mailconnect) AND !empty($mdpconnect))
   {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1)
      {
         if(isset($_POST['rememberme'])) {
            setcookie('email',$mailconnect,time()+365*24*3600,null,null,false,true);
            setcookie('password',$mdpconnect,time()+365*24*3600,null,null,false,true);
         }
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         header("Location: profil.php?id=".$_SESSION['id']);
      }
      else
      {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   }
   else
   {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
 

<?php
    if(isset($erreur))
    {
        echo '<font color="red">'.$erreur."</font>";
    }
?>

<!-- https://www.primfx.com/tuto-php-bouton-souvenir-moi-186/ -->

<!-------------------------------------------- Deux façons différentes -------------------------------------------- >

<?php
    if(isset($_GET['erreur'])){
        $err = $_GET['erreur'];
        if($err==1 || $err==2)
            echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
    }
?>



<!---------------------------- Troisième manière ----------------------------->

<!-- https://www.youtube.com/watch?v=jEgzxXCB9-w -->

<?php
   session_start();
   require_once 'config.php';

   if(isset($_POST['email']) && isset($_POST['password'])) {
       $email = htmlspecialchars($_POST['email']);
       $password = htmlspecialchars($_POST['password']);
      
      $check = $bdd->prepare('SELECT pseudo, email, password FROM  WHERE email = ? AND motdepasse = ?');
      $check -> execute(array($email));
      $data = $check -> fetch();
      $row = $check -> rowCount();

      if($row == 1)
      {
         if(filter_var($email, FILTER_VALIDATE_EMAIL))
         {   
            $password = hash('sha512', $password);
            if($data['password'] === $password)
            {
               $_SESSION['user'] = $data['pseudo'];
               header('Location:../connexion.php');
            } else header('Location:../connexion.php?login_error=password');
         } else header("Location:../login.php?login_error=email");
      } else header("Location:../login.php?login_err=already");
   } else header("Location:../login.php");
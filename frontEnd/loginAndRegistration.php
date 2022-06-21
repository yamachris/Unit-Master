<?php
require("../php/config.php");
session_start();
if (isset($_SESSION['tkn']) && !empty($_SESSION['tkn']) || isset($_COOKIE['tkn']) && !empty($_COOKIE['tkn'])) {
    if (isset($_SESSION['tkn'])) {
        $tkn = $_SESSION['tkn'];
    }elseif (isset($_COOKIE['tkn'])) {
        $tkn = $_COOKIE['tkn'];
    }

    
    $get_user = $db->prepare("SELECT `token` FROM `users` WHERE `token` = :userToken");
    $get_user->bindParam(':userToken', $tkn, PDO::PARAM_STR);
    $get_user->execute();
    
    $row_user = $get_user->rowCount();
    if ($row_user === 1) {
        header("Location: index.php");
        exit();
    }
}

if(isset($_POST['log'])){
    if (isset($_POST['email_log']) && !empty($_POST['email_log']) && isset($_POST['pass_log']) && !empty($_POST['pass_log'])) {
        $email = addslashes($_POST['email_log']);
        $pass = addslashes($_POST['pass_log']);

        
        $get_user = $db->prepare("SELECT `token`, `email`, `pass` FROM `users` WHERE `email` = :userLogin OR `name` = :userLogin");
        $get_user->bindParam(':userLogin', $email, PDO::PARAM_STR);
        $get_user->execute();
        
        $row_user = $get_user->rowCount();
        if ($row_user === 1) {
            $fetch_user = $get_user->fetch();
            if (password_verify($pass, $fetch_user['pass'])) {
                if (isset($_POST['remember_me_log']) && $_POST['remember_me_log'] === "yes") {
                    setcookie("tkn", $fetch_user['token'], time()+3600);
                }else $_SESSION['tkn'] = $fetch_user['token'];

                header("Location: index.php");
                exit();
            }else $err = '<div class="err"><span>Votre mot de pass est incorrect.</span></div>';
        }else $err = '<div class="err"><span>Votre email ou mot de pass est incorrect.</span></div>';
    }else $err = '<div class="err"><span>Veuillez remplire tout les champs s\'il vous plaît.</span></div>';
}
if (isset($_POST['regist'])) {
    if(isset($_POST['name_regist']) && !empty($_POST['name_regist']) && isset($_POST['email_regist']) && !empty($_POST['email_regist']) && isset($_POST['pass_regist']) && !empty($_POST['pass_regist']) && isset($_POST['confirm_pass_regist']) && !empty($_POST['confirm_pass_regist'])){
        $name = addslashes($_POST['name_regist']);
        $email = addslashes($_POST['email_regist']);
        $pass = addslashes($_POST['pass_regist']);
        $confirm = addslashes($_POST['confirm_pass_regist']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, "@yopmail") === false) {
            
            $get_email = $db->prepare("SELECT `email` FROM `users` WHERE `email` = :userLogin");
            $get_email->bindParam(':userLogin', $email, PDO::PARAM_STR);
            $get_email->execute();
            
            $row_email = $get_email->rowCount();
            if ($row_email === 0) {
                if (strlen($pass) >= 10) {
                    if ($pass === $confirm) {
                        $token = md5(uniqid(rand(), true));
                        $passwordCrypt = password_hash($pass, PASSWORD_BCRYPT, ["cost" => 14]);
                        
                        $insert_user = $db->prepare("INSERT INTO `users` (`name`,`email`,`pass`,`token`,`role`) VALUES (:userName, :userLogin, :userPassword, :userToken, 'user')");
                        $insert_user->bindParam(':userName', $name, PDO::PARAM_STR);
                        $insert_user->bindParam(':userLogin', $email, PDO::PARAM_STR);
                        $insert_user->bindParam(':userPassword', $passwordCrypt, PDO::PARAM_STR);
                        $insert_user->bindParam(':userToken', $token, PDO::PARAM_STR);
                        $insert_user->execute();
                        
                        if (isset($_POST['remember_me_regist']) && $_POST['remember_me_regist'] === "yes") {
                            setcookie("tkn", $token, time()+3600);
                        }else $_SESSION['tkn'] = $token;

                        header("Location: index.php");
                        exit();
                    }else $err = '<div class="err"><span>Vos mot de passes ne sont pas égeaux.</span></div>';
                }else $err = '<div class="err"><span>Votre mot de passe doit être supérieur ou égale à 10 caractères.</span></div>';
            }else $err = '<div class="err"><span>Votre email est déjà utilisé.</span></div>';
        }else $err = '<div class="err"><span>Veuillez entrer une email valid s\'il vous plaît.</span></div>';
    }else $err = '<div class="err"><span>Veuillez remplire tout les champs s\'il vous plaît.</span></div>';
}
?>
<!DOCTYPE html>
<!-- === Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link href="../css/loginAndRegistration.css" rel="stylesheet" >
         
    <!--<title>Login & Registration Form</title>-->
</head>
<body>
    
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>
                <?php
                if (isset($err)) {
                    echo $err;
                }
                ?>
                <form action="#" method="POST">
                    <div class="input-field">
                        <input type="text" name="email_log" placeholder="Enter your email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="pass_log" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck" name="remember_me_log" value="yes">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                        
                        <a href="./resetPass.php" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="log" value="Login Now">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Pas encore membre?
                        <a href="#" class="text signup-link">Signup now</a>
                    </span>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="form signup">
                <span class="title">Registration</span>
                <?php
                if (isset($err)) {
                    echo $err;
                }
                ?>
                <form action="#" method="POSt">
                    <div class="input-field">
                        <input type="text" placeholder="Enter your name" name="name_regist" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your email" name="email_regist" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="pass_regist" placeholder="Create a password" required>
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="confirm_pass_regist" placeholder="Confirm a password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="sigCheck" name="remember_me_regist" value="yes">
                            <label for="sigCheck" class="text">Remember me</label>
                        </div>
                        
                        <a href="./resetPass.php" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="regist" value="Login Now">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Déjà membre?
                        <a href="#" class="text login-link">Login</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<script src="../js/loginAndRegistration.js"></script>
<?php
    require_once 'config.php';
    if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_confirm = htmlspecialchars($_POST['password_confirm']);

        $check = $bdd -> prepare('SELECT pseudo, email, password FROM untilisateur WHERE email = ?');
        $check -> execute(array($email));
        $check_result = $check -> fetch();
        $row = $check -> rowCount();

        if ($row == 0) {
            if(strlen($pseudo) <= 100)
            {
                if(strlen($email) <= 100)
                {
                    if(filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                        if($password == $password_confirm)
                        {
                        $password = hash('sha512', $password);
                        $ip = $_SERVER['REMOTE_ADDR'];

                            $insert = $bdd -> prepare('INSERT INTO utilisateur(pseudo, email, password, ip) VALUES(:pseudo, :email, :password, :ip)');
                            $insert -> execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password,
                                'ip' => $ip
                            ));
                            header('Location:../registration.php?reg_error=success');

                        } else header('Location:../registration.php?reg_err=password');
                    } else header('Location:../registration.php?reg_err=email');
                } else header('Location:../registration.php?reg_err=email_length');
            } else header('Location:../registration.php?reg_error=pseudo_lenght');
        } else header('Location;../registration.html?reg_err=already');
    }
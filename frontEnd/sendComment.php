<?php
require("../php/config.php");
session_start();
if (isset($_POST['file']) && !empty($_POST['file'])) {
    $file = $_POST['file'];
    $date = date("Y-m-d");
    if (isset($_POST['comment']) && !empty($_POST['comment'])) {
        $comment = $_POST['comment'];
        if (isset($_SESSION['tkn']) || isset($_COOKIE['tkn']) || isset($_SESSION['player'])) {
            if (isset($_SESSION['tkn'])) {
                $tkn = $_SESSION['tkn'];
            }elseif (isset($_COOKIE['tkn'])) {
                $tkn = $_COOKIE['tkn'];
            }elseif (isset($_SESSION['player'])) {
                $tkn = 0;
            }else 
            {
                $tkn = 0;
                $_SESSION['player'] = "player".rand(1,99999);
            }
        
            
            $check_user = $db->prepare("SELECT `ID`, `name` FROM `users` WHERE `token` = '$tkn'");
            $check_user->execute();
            $row_user = $check_user->rowCount();
            if ($row_user == 1) {
                $fetch_user = $check_user->fetch();
                $user = $fetch_user['ID'];
            }else {
                $user = null;
            }
        }else{
            $user = null;
        }

        
        $add_comment = $db->prepare("INSERT INTO `comments` (`comments`,`comment_by`,`comment_date`,`comment_on`) VALUES (?,?,?,?)");
        // Protection contre les injections SQL 
        $add_comment->bindParam(1, $comment);
        $add_comment->bindParam(2, $user);
        $add_comment->bindParam(3, $date);
        $add_comment->bindParam(4, $file);
        $add_comment->execute();
        $db = null;
        header("Location: ".$file);
        exit();
    }else{
        $_SESSION['commentErr'] = '<div class="err"><span>Vous n\'avez rien écrit !</span></div>';
        header("Location: ".$file);
        exit();
    }
}else{
    header("Location: index.php");
    exit();
}
?>
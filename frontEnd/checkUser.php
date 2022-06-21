<?php
require("../php/config.php");
session_start();
if (isset($_SESSION['tkn']) || isset($_COOKIE['tkn'])) {
    if (isset($_SESSION['tkn'])) {
        $tkn = $_SESSION['tkn'];
    }elseif (isset($_COOKIE['tkn'])) {
        $tkn = $_COOKIE['tkn'];
    }

    $check_user = $db->prepare("SELECT `token` FROM `users` WHERE `token` = '$tkn'");
    $check_user->execute();
    $row_user = $check_user->rowCount();
    if ($row_user < 1) {
        header("Location: index.php");
        die();
    }else $userVerify = true;
}
?>
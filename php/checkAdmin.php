<?php
    $verify_admin = $db->prepare("SELECT `role` FROM `users` WHERE `token` = '$tkn'");
    $verify_admin->execute();
    $row_admin = $verify_admin->fetch();
    if ($row_admin["role"] !== "admin") {
        header("Location: index.php");
        die();
    }
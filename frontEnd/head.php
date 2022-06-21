<?php 

    require("../php/config.php");
    if (isset($_SESSION["tkn"])) {
        $get_user = $db->prepare("SELECT `role` FROM `users` WHERE token = :userToken");
        $get_user->bindParam(':userToken', $_SESSION["tkn"], PDO::PARAM_STR);
        $get_user->execute();
        $isAdmin = $get_user->fetch()["role"] === "admin" ? true : false;
    }

?>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Jeu de l'Unité - <?= $pageName ?></title>
        <meta name="description" content="Les régles de du jeu" />
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link href="../css/header.css" rel="stylesheet" type="text/css" />
        <link href="../css/footer.css" rel="stylesheet" type="text/css" />
        <link href="../css/chat.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
        <link rel="icon" type="image/svg+xml" href="../logo/logoBlack.svg" />
    </head>

    <body class="body">
        <?php include 'menu.php'; ?>

        <div class="wrapper">
            <?php include 'header.php' ?>

            <main class="content">
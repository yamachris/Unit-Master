<?php 

    require("../php/config.php");
    if (isset($_SESSION["tkn"])) {
        $get_user = $db->prepare("SELECT `role` FROM `users` WHERE token = :userToken");
        $get_user->bindParam(':userToken', $_SESSION["tkn"], PDO::PARAM_STR);
        $get_user->execute();
        $isAdmin = $get_user->fetch()["role"] === "admin" ? true : false;
        echo $isAdmin;
    }

?>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Jeu de l'Unité - Admin</title>
        <meta name="description" content="Les régles de du jeu" />
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link href="../css/header.css" rel="stylesheet" type="text/css" />
        <link href="../css/footer.css" rel="stylesheet" type="text/css" />
        <link href="../css/chat.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <link rel="icon" type="image/svg+xml" href="../images/logoblack.svg" />
    </head>

    <body class="body">
    	<nav class="admin-navbar">
    		<div class="admin-navbar-title">
            	<h1 class="title">Admin</h1>
        	</div>
            <div class="nav">
                <ul class="navList">
                	<li class="navListItem">
                        <a href="./admin.php" class="navListLink"><ion-icon name="cog-outline" style="width: 20px;height:20px;"></ion-icon></ion-icon> Admin</a>
                    </li>
                	<li class="navListItem">
                        <a href="./adminUser.php" class="navListLink"><ion-icon name="people-outline" style="width: 20px;height:20px;"></ion-icon> Utilisateurs</a>
                    </li>
                    <li class="navListItem">
                        <a href="./adminComments.php" class="navListLink"><ion-icon name="chatbubbles-outline" style="width: 20px;height:20px;"></ion-icon> Commentaires</a>
                    </li>
                    <li class="navListItem">
                        <a href="./adminMessages.php" class="navListLink"><ion-icon name="chatbubble-ellipses-outline" style="width: 20px;height:20px;"></ion-icon> Messages</a>
                    </li>
                </ul>
            </div>
        </nav>
    	<div class="wrapper">
            <?php include 'header.php' ?>

            <main class="content-admin">
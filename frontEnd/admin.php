<?php
    include 'checkUser.php';
    require("../php/config.php");
    require("../php/checkAdmin.php");
    $pageName = 'Admin';
    $pageFile = "admin.php";

    include 'adminNav.php';
?>

<section class="section">
    <?php

        $get_users_count = $db->prepare("SELECT COUNT(*) 'count_users' FROM users");
        $get_users_count->execute();
        $userCount = $get_users_count->fetch()["count_users"];

        $get_comments_count = $db->prepare("SELECT COUNT(*) 'count_comments' FROM comments");
        $get_comments_count->execute();
        $commentsCount = $get_comments_count->fetch()["count_comments"];

        $get_messages_count = $db->prepare("SELECT COUNT(*) 'count_messages' FROM messages");
        $get_messages_count->execute();
        $messageCount = $get_messages_count->fetch()["count_messages"];

    ?>
    <div style="width: 100%;display: flex;">
        <div id="userSquare" style="width: 33vw;height: 22vw;text-align: center;border-right: solid 2px #000;border-top: solid 2px #000;border-bottom: solid 2px #000;border-left: solid 2px #000;">
            <ion-icon name="person-circle-outline" style="width: 10vw;height: 10vw;margin: auto;"></ion-icon><br/>
            <p><b>Nombre d'utilisateurs inscrit :</b></p><br/>
            <h2><b><?php echo $userCount; ?></b></h2>
        </div>
        <div id="commentsSquare" style="width: 33vw;height: 22vw;text-align: center;border-right: solid 2px #000;border-top: solid 2px #000;border-bottom: solid 2px #000;border-left: solid 0px #000;">
            <ion-icon name="chatbubbles-outline" style="width: 10vw;height: 10vw;margin: auto;"></ion-icon><br/>
            <p><b>Nombre de commentaires postés :</b></p><br/>
            <h2><b><?php echo $commentsCount; ?></b></h2>
        </div>
        <div id="messagesSquare" style="width: 33vw;height: 22vw;text-align: center;border-right: solid 2px #000;border-top: solid 2px #000;border-bottom: solid 2px #000;border-left: solid 0px #000;">
            <ion-icon name="chatbubble-ellipses-outline" style="width: 10vw;height: 10vw;margin: auto;"></ion-icon><br/>
            <p><b>Nombre de messages envoyés :</b></p><br/>
            <h2><b><?php echo $messageCount; ?></b></h2>
        </div>
    </div>
</section>
<?php include 'foot.php'; ?>
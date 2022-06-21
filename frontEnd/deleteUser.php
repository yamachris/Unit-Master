<?php
require("../php/config.php");
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $get_comments = $db->prepare("DELETE FROM `users` WHERE `ID` = '$id'");
    $get_comments->execute();
    $db = null;
    header("Location: adminUser.php");
    exit();
}else {
    header("Location: admin.php");
    exit();
}
?>
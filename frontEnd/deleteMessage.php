<?php
require("../php/config.php");
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $get_message = $db->prepare("DELETE FROM `messages` WHERE `id_message` = '$id'");
    $get_message->execute();
    $db = null;
    header("Location: adminMessages.php");
    exit();
}else {
    header("Location: admin.php");
    exit();
}
?>
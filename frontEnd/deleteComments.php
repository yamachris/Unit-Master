<?php
require("../php/config.php");
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $get_comments = $db->prepare("DELETE FROM `comments` WHERE `id_comments` = '$id'");
    $get_comments->execute();
    $db = null;
    header("Location: adminComments.php");
    exit();
}else {
    header("Location: admin.php");
    exit();
}
?>
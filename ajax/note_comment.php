<?php
require("../php/config.php");
if (isset($_POST["comment_id"]) && isset($_POST["note"])) {
	$add_comment_note = $db->prepare("INSERT INTO comments_notes(note, comment_id) VALUES(:userNote, :commentId)");
    $add_comment_note->bindParam(':userNote', $_POST["note"], PDO::PARAM_INT);
    $add_comment_note->bindParam(':commentId', $_POST["comment_id"], PDO::PARAM_INT);
    $add_comment_note->execute();
    $add_comment_note->debugDumpParams();
    print_r($add_comment_note);
}
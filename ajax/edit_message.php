<?php
require("../php/config.php");
if (isset($_POST["message_id"]) && isset($_POST["content"]) && $_POST["user"]) {
	$get_user = $db->prepare("SELECT * FROM users WHERE token = :userToken");
	$get_user->bindParam(':userToken', $_POST["user"], PDO::PARAM_STR);
	$get_user->execute();
	if ($get_user->rowCount() > 0) {
		$userId = $get_user->fetch()["ID"];
		$messageContent = nl2br($_POST["content"]);
		$edit_comment_content = $db->prepare("UPDATE messages m SET m.message = :messageContent WHERE m.id_message = :messageId AND m.id_user = :userId");
	    $edit_comment_content->bindParam(':messageContent', $messageContent, PDO::PARAM_STR);
	    $edit_comment_content->bindParam(':messageId', $_POST["message_id"], PDO::PARAM_INT);
	    $edit_comment_content->bindParam(':userId', $userId, PDO::PARAM_INT);
	    $edit_comment_content->execute();
	    $edit_comment_content->debugDumpParams();
	    print_r($edit_comment_content);
	}
}
<?php
require("../php/config.php");
if (isset($_POST["message_id"]) && $_POST["user"]) {
	$get_user = $db->prepare("SELECT * FROM users WHERE token = :userToken");
	$get_user->bindParam(':userToken', $_POST["user"], PDO::PARAM_STR);
	$get_user->execute();
	if ($get_user->rowCount() > 0) {
		$userId = $get_user->fetch()["ID"];

		$remove_comment = $db->prepare("DELETE FROM messages WHERE id_message = :messageId AND id_user = :userId");
	    $remove_comment->bindParam(':messageId', $_POST["message_id"], PDO::PARAM_INT);
	    $remove_comment->bindParam(':userId', $userId, PDO::PARAM_INT);
	    $remove_comment->execute();
	    $remove_comment->debugDumpParams();
	    print_r($remove_comment);
	}
}
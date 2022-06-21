<?php
require("../php/config.php");
if (isset($_POST["comment_id"]) && $_POST["user"]) {
	$get_user = $db->prepare("SELECT * FROM users WHERE token = :userToken");
	$get_user->bindParam(':userToken', $_POST["user"], PDO::PARAM_STR);
	$get_user->execute();
	if ($get_user->rowCount() > 0) {
		$user = $get_user->fetch();
		$userId = $user["ID"];
		$remove_comment_notes = $db->prepare("DELETE FROM comments_notes WHERE comment_id = :commentId");
		$remove_comment_notes->bindParam(':commentId', $_POST["comment_id"], PDO::PARAM_INT);
		$remove_comment_notes->execute();

		if ($user["role"] === "admin") {
			$remove_comment = $db->prepare("DELETE FROM comments WHERE id_comments = :commentId");
		} else {
			$remove_comment = $db->prepare("DELETE FROM comments WHERE id_comments = :commentId AND comment_by = :userId");
			$remove_comment->bindParam(':userId', $userId, PDO::PARAM_INT);
		}
		
	    $remove_comment->bindParam(':commentId', $_POST["comment_id"], PDO::PARAM_INT);
	    $remove_comment->execute();
	    $remove_comment->debugDumpParams();
	    print_r($remove_comment);
	}
}
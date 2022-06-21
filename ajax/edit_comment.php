<?php
require("../php/config.php");
if (isset($_POST["comment_id"]) && isset($_POST["content"]) && $_POST["user"]) {
	$get_user = $db->prepare("SELECT * FROM users WHERE token = :userToken");
	$get_user->bindParam(':userToken', $_POST["user"], PDO::PARAM_STR);
	$get_user->execute();
	if ($get_user->rowCount() > 0) {
		$userId = $get_user->fetch()["ID"];
		$commentContent = $_POST["content"];
		$edit_comment_content = $db->prepare("UPDATE comments c SET c.comments = :commentContent WHERE c.id_comments = :commentId AND c.comment_by = :userId");
	    $edit_comment_content->bindParam(':commentContent', $commentContent, PDO::PARAM_STR);
	    $edit_comment_content->bindParam(':commentId', $_POST["comment_id"], PDO::PARAM_INT);
	    $edit_comment_content->bindParam(':userId', $userId, PDO::PARAM_INT);
	    $edit_comment_content->execute();
	    $edit_comment_content->debugDumpParams();
	    print_r($edit_comment_content);
	}
}
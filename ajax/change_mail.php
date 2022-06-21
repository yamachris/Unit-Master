<?php
require("../php/config.php");
if (isset($_POST["email"]) && $_POST["user"]) {
	$edit_user_email = $db->prepare("UPDATE users SET email = :newEmail WHERE token = :userToken");
	$edit_user_email->bindParam(':newEmail', $_POST["email"], PDO::PARAM_STR);
	$edit_user_email->bindParam(':userToken', $_POST["user"], PDO::PARAM_STR);
	$edit_user_email->execute();
	$edit_user_email->debugDumpParams();
	print_r($edit_user_email);
}
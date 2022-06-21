<?php
require("../php/config.php");
if (isset($_POST["password"]) && isset($_POST["passwordConfirmation"]) && $_POST["user"]) {
	if ($_POST["password"] === $_POST["passwordConfirmation"]) {
		$newPassword = password_hash($_POST["password"], PASSWORD_BCRYPT, ["cost" => 14]);
		$edit_user_password = $db->prepare("UPDATE users SET pass = :newPassword WHERE token = :userToken");
		$edit_user_password->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
		$edit_user_password->bindParam(':userToken', $_POST["user"], PDO::PARAM_STR);
		$edit_user_password->execute();
		$edit_user_password->debugDumpParams();
		print_r($edit_user_password);
	}
}
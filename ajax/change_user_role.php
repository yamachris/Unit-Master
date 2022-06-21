<?php
require("../php/config.php");
if (isset($_POST["target_id"]) && $_POST["user"] && $_POST["role"]) {
	$get_user = $db->prepare("SELECT * FROM users WHERE token = :userToken");
	$get_user->bindParam(':userToken', $_POST["user"], PDO::PARAM_STR);
	$get_user->execute();
	if ($get_user->rowCount() > 0) {
		$user = $get_user->fetch();
		$userId = $user["ID"];

		if ($user["role"] === "admin") {
			$change_role = $db->prepare("UPDATE users SET role = :targetRole WHERE ID = :targetId");
			$change_role->bindParam(':targetRole', $_POST["role"], PDO::PARAM_STR);
			$change_role->bindParam(':targetId', $_POST["target_id"], PDO::PARAM_INT);
		    $change_role->execute();
		    $change_role->debugDumpParams();
		    print_r($change_role);
		}
	}
}
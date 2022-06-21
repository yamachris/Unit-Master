<?php
require("../php/config.php");
if (isset($_POST["user"]) && isset($_POST['msg'])) {
    $get_user = $db->prepare("SELECT `ID` FROM `users` WHERE `token` = :userToken");
   	$get_user->bindParam(':userToken', $_POST["user"], PDO::PARAM_STR);
	$get_user->execute();
	$get_user->debugDumpParams();
	$userId = $get_user->fetch()['ID'];
    
    $message = htmlspecialchars($_POST['msg']);
	$newmessage = str_replace('_', ' ', $message);
	if (strlen($newmessage) > 0) {
		$sendMessage = $db->prepare("INSERT INTO `messages` (`id_user`,`message`) VALUES (:userId, :messageContent)");
		$sendMessage->bindParam(':userId', $userId, PDO::PARAM_STR);
		$sendMessage->bindParam(':messageContent', $newmessage, PDO::PARAM_STR);
		$sendMessage->execute();
		$sendMessage->debugDumpParams();
	}
    
}

?>
<?php
require("../php/config.php");
session_start();
$selectMessages = $db->prepare("SELECT m.id_message, m.id_user, m.message, u.token, u.name FROM messages m JOIN users u ON u.ID = m.id_user");
$selectMessages->execute();
$fetchMessages = $selectMessages->fetchAll();
$rowMessages = $selectMessages->rowCount();
if($rowMessages > 0){
    foreach($fetchMessages as $fetch){
?>
<?php echo '<div id="messages' . $fetch['id_message'] . '" class="comments__container">'; ?>
        <div class="comments__box">
            <?php echo '<span id="messageSection' . $fetch['id_message'] . '" style="display: block;"> ' . htmlspecialchars($fetch['message']) . '</span>'; ?>
        </div>
        <?php
            echo '<div id="messageEdit' . $fetch['id_message'] . '" style="display: none;"><textarea class="comment-section-txtarea" id="messageSectionTextarea' . $fetch['id_message'] . '" style="width:100%;resize: none;">' . htmlspecialchars($fetch['message']) . '</textarea><button id="messageEditValidate" class="edit-btn" onclick="editMessage(' . $fetch['id_message'] . ', \'' . ($_SESSION["tkn"] ?? "") . '\')">Valider</button><button id="messageEditCancel" class="edit-btn" onclick="closeEdit(' . $fetch['id_message'] . ')">Annuler</button></div>'
        ?>
        <div class="comments__box comments__box--upload">
            <span><?php echo $fetch['name'];?></span>
        </div>
        <?php

        	if (isset($_SESSION["tkn"]) && $fetch['token'] === $_SESSION["tkn"]) {
                echo '
                <div class="comments__box comments__box--date">
                    <span onclick="showEdit(' . $fetch['id_message'] . ')" class="hoverable-labels">modifier</span>
                </div>
                <div class="comments__box comments__box--date">
                    <span onclick="deleteMessage(' . $fetch['id_message'] . ', \'' . ($_SESSION["tkn"] ?? '') . '\')" class="hoverable-labels">supprimer</span>
                </div>
                ';
            }

        ?>
</div>
<!--<div id="chatMessage"><span class="usrnm"><?php echo $fetch['name'];?></span><span>: <?php echo $fetch['message'];?></span></div>-->
<?php
    }
}else{
?>
<div>Aucun message</div>
<?php
}
?>

<script>
	
	function editMessage(message_id, user_tkn) {
            let itemContent = document.getElementById("messageSectionTextarea" + message_id).value;
            itemContent = encodeURIComponent(itemContent);
            xhr = new XMLHttpRequest();

            xhr.open('POST', '../ajax/edit_message.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById("messageSection" + message_id).innerHTML = decodeURIComponent(itemContent);
                    closeEdit(message_id);
                }
            };
            xhr.send('message_id='+message_id+'&content='+itemContent+'&user='+user_tkn);
            console.log(itemContent);
        }

        function deleteMessage(message_id, user_tkn) {
            if (confirm("Voulez-vous vraiment supprimer ce message ?")){
                xhr = new XMLHttpRequest();

                xhr.open('POST', '../ajax/delete_message.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        document.getElementById("messages" + message_id).remove();
                    }
                };
                xhr.send('message_id='+message_id+'&user='+user_tkn);
            }
        }

        function showEdit(message_id) {
        	editing = true;
            document.getElementById("messageEdit"+message_id).style.display = "block";
            document.getElementById("messageSection"+message_id).style.display = "none";
        }

        function closeEdit(message_id) {
            document.getElementById("messageEdit"+message_id).style.display = "none";
            document.getElementById("messageSection"+message_id).style.display = "block";
            editing = false;
        }

</script>
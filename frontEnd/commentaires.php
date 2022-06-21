<?php
require("../php/config.php");
$nbr_elements_page = 5;
if (isset($_GET['comment']) && !empty($_GET['comment'])) {
    $page = $_GET['comment'];
}else $page = 1;
$begin = ($page-1) * $nbr_elements_page;


$get_comments = $db->prepare("SELECT `id_comments` FROM `comments` WHERE `comment_on` = '$pageFile'");
$get_comments->execute();
$row_comments = $get_comments->rowCount();
?>
<h2>Commentaires (<?php echo $row_comments?>):</h2>
<?php
if (isset($_SESSION['commentErr'])) {
    echo $_SESSION['commentErr'];
    unset($_SESSION['commentErr']);
}
?>
<form action="sendComment.php" method="post">
    <input type="hidden" name="file" value="<?php echo $pageFile?>">
    <textarea id="message" type="text" name="comment" placeholder="Commentaire...."></textarea><button id="btnMessage" class="btn btn-success">Send</button>
</form>
<div>
    <?php
    if ($row_comments >= 1) {
        
        $get_comments = $db->prepare("SELECT c.id_comments, u.name, u.profile_picture, u.token, c.comments, c.comment_by, c.comment_date FROM comments c LEFT JOIN users u ON c.comment_by = u.ID WHERE c.comment_on = '$pageFile'
        ORDER BY c.id_comments DESC LIMIT $begin,$nbr_elements_page");
        $get_comments->execute();
        $fetch_comments = $get_comments->fetchAll();
        $nbr_pages = ceil($row_comments/$nbr_elements_page);


        for ($i=0; $i < sizeof($fetch_comments); $i++) { 
            $get_comment_note = $db->prepare("SELECT AVG(note) 'avgNote' FROM `comments_notes` WHERE `comment_id` = :commentId");
            $get_comment_note->bindParam(':commentId', $fetch_comments[$i]['id_comments'], PDO::PARAM_INT);
            $get_comment_note->execute();
            $note = round($get_comment_note->fetch()["avgNote"]);
    ?>
    <?php echo '<div id="comments' . $fetch_comments[$i]['id_comments'] . '" class="comments__container">'; ?>
        <div class="comments__box">
            <?php 
                $comment = htmlspecialchars($fetch_comments[$i]['comments']);
                $fetch_comments[$i]['comments'] = nl2br(htmlspecialchars($fetch_comments[$i]['comments']));
            ?>
            <?php echo '<span id="commentSection' . $fetch_comments[$i]['id_comments'] . '" style="display:block;">' . $fetch_comments[$i]['comments'] . '</span>'; ?>
            <?php
                echo '<div id="commentEdit' . $fetch_comments[$i]['id_comments'] . '" style="display: none;"><textarea class="comment-section-txtarea" id="commentSectionTextarea' . $fetch_comments[$i]['id_comments'] . '" style="width:100%;resize: none;">' . $comment . '</textarea><button id="commentEditValidate" class="edit-btn" onclick="editComment(' . $fetch_comments[$i]['id_comments'] . ', \'' . ($_SESSION["tkn"] ?? "") . '\')">Valider</button><button id="commentEditCancel" class="edit-btn" onclick="closeEdit(' . $fetch_comments[$i]['id_comments'] . ')">Annuler</button></div>'
            ?>
            <!-- Protection XSSS -->
        </div>
        <div class="comments__box comments__box--upload">
        <?php
                if (isset($fetch_comments[$i]["profile_picture"]) && $fetch_comments[$i]["profile_picture"] !== null) {
                    echo "<img src='../profile_pictures/" . $fetch_comments[$i]["profile_picture"] . "' width='50px' height='50px' style='border-radius:50%;'/>";
                }
            ?>
        </div>
        <div class="comments__box comments__box--upload">
            <span><?php echo $fetch_comments[$i]['name'] ?? 'Anonyme' ?></span>
        </div>
        <div class="comments__box comments__box--date">
            <span><?php echo $fetch_comments[$i]['comment_date']?></span>
        </div>
        <div class="stars">
          <?php
                for($k=1; $k < 6; $k++) {
                    echo '<input type="hidden" id="asp' . $k . $fetch_comments[$i]['id_comments'] . '_hidden" value="' . $k . '">';
                    if ($note >= $k) {
                        echo '<img src="../images/star2.png" onmouseover="change(this.id, ' . $fetch_comments[$i]['id_comments'] . ');" onmouseout="getNote(this.id, ' . $fetch_comments[$i]['id_comments'] . ', ' . $note . ')" onclick="sendNote(this.id, ' . $fetch_comments[$i]['id_comments'] . ', ' . $k . ')" width="15px" height="15px" id="asp'. $k . $fetch_comments[$i]['id_comments'] . '" class="asp">';
                    } else {
                        echo '<img src="../images/star1.png" onmouseover="change(this.id, ' . $fetch_comments[$i]['id_comments'] . ');" onmouseout="getNote(this.id, ' . $fetch_comments[$i]['id_comments'] . ', ' . $note . ')" onclick="sendNote(this.id, ' . $fetch_comments[$i]['id_comments'] . ', ' . $k . ')" width="15px" height="15px" id="asp'. $k . $fetch_comments[$i]['id_comments'] . '" class="asp">';
                    }
                    
                }
            ?>
        </div>
        <?php

            if (isset($_SESSION["tkn"]) && $fetch_comments[$i]['token'] === $_SESSION["tkn"]) {
                echo '
                <div class="comments__box comments__box--date">
                    <span onclick="showEdit(' . $fetch_comments[$i]['id_comments'] . ')" class="hoverable-labels">modifier</span>
                </div>
                <div class="comments__box comments__box--date">
                    <span onclick="deleteComment(' . $fetch_comments[$i]['id_comments'] . ', \'' . $_SESSION["tkn"] . '\')" class="hoverable-labels">supprimer</span>
                </div>
                ';
            }

        ?>
    </div>
    <?php
        }

        for ($i=1; $i <= $nbr_pages; $i++) { 
            if ($i != $page) {
                echo '<a class="commentLink" href="?comment='.$i.'">'.$i.'</a>&nbsp;';
            }else echo '<span class="commentLink activeComment">'.$i.'</span>&nbsp;';
        }
    }else{
    ?>
    <span>Aucun commentaire sur cette page.</span>
    <?php
    }
    ?>
    <script>
        function change(id, comment_id)
        {
            var cname = document.getElementById(id).className;
            var ab = document.getElementById(id+"_hidden").value;

            for(var i = ab;i >= 1;i--)
            {
                document.getElementById(cname+i+comment_id.toString()).src="../images/star2.png";
            }

            var id=parseInt(ab)+1;
            for(var j = id;j <= 5;j++)
            {
                document.getElementById(cname+j+comment_id.toString()).src="../images/star1.png";
            }
        }

        function sendNote(id, comment_id, note) {
            var cname = document.getElementById(id).className;
            xhr = new XMLHttpRequest();

            xhr.open('POST', '../ajax/note_comment.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    for(var i=1;i < 6;i++)
                    {
                        document.getElementById(cname+i+comment_id.toString()).removeAttribute("onmouseover");
                        document.getElementById(cname+i+comment_id.toString()).removeAttribute("onmouseout");
                        document.getElementById(cname+i+comment_id.toString()).removeAttribute("onclick");
                    }
                }
            };
            xhr.send('comment_id='+comment_id+'&note='+note);
        }

        function getNote(id, comment_id, note) {
            var cname = document.getElementById(id).className;
            for(var i=1;i < 6;i++)
            {
                if (note >= i) {
                    document.getElementById(cname+i+comment_id.toString()).src="../images/star2.png";
                } else {
                    document.getElementById(cname+i+comment_id.toString()).src="../images/star1.png";
                }
                
            }
        }

        function editComment(comment_id, user_tkn) {
            let itemContent = document.getElementById("commentSectionTextarea" + comment_id).value;
            itemContent = encodeURIComponent(itemContent);
            xhr = new XMLHttpRequest();

            xhr.open('POST', '../ajax/edit_comment.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById("commentSection" + comment_id).innerHTML = nl2br(decodeURIComponent(itemContent));
                    closeEdit(comment_id);
                }
            };
            xhr.send('comment_id='+comment_id+'&content='+itemContent+'&user='+user_tkn);
            console.log(itemContent);
        }

        function deleteComment(comment_id, user_tkn) {
            if (confirm("Voulez-vous vraiment supprimer ce commentaire ?")){
                xhr = new XMLHttpRequest();

                xhr.open('POST', '../ajax/delete_comment.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        document.getElementById("comments" + comment_id).remove();
                    }
                };
                xhr.send('comment_id='+comment_id+'&user='+user_tkn);
            }
        }

        function showEdit(comment_id) {
            document.getElementById("commentEdit"+comment_id).style.display = "block";
            document.getElementById("commentSection"+comment_id).style.display = "none";
        }

        function closeEdit(comment_id) {
            document.getElementById("commentEdit"+comment_id).style.display = "none";
            document.getElementById("commentSection"+comment_id).style.display = "block";
        }

        function nl2br (str, is_xhtml) {
            if (typeof str === 'undefined' || str === null) {
                return '';
            }
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }

    </script>
</div>
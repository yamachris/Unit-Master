<?php
require("../php/config.php");
include 'checkUser.php';
require("../php/checkAdmin.php");

include 'adminNav.php';

$nbr_elements_page = 5;
if (isset($_GET['comment']) && !empty($_GET['comment'])) {
    $page = $_GET['comment'];
}else $page = 1;
$begin = ($page-1) * $nbr_elements_page;


$get_comments = $db->prepare("SELECT c.id_comments FROM comments c LEFT JOIN users u ON u.ID = c.comment_by");
$get_comments->execute();

$row_comments = $get_comments->rowCount();
?>
<section class="section">
    <h2>Commentaires (<span id="commentsCount"><?php echo $row_comments?></span>):</h2>
    <div>
        <?php
        if ($row_comments >= 1) {
            
            $get_comments = $db->prepare("SELECT * FROM comments c LEFT JOIN users u ON u.ID = c.comment_by
            ORDER BY c.id_comments DESC LIMIT $begin,$nbr_elements_page");
            $get_comments->execute();
            
            $fetch_comments = $get_comments->fetchAll();
            $nbr_pages = ceil($row_comments/$nbr_elements_page);


            for ($i=0; $i < sizeof($fetch_comments); $i++) { 
        ?>
        <?php echo '<div id="comments' . $fetch_comments[$i]['id_comments'] . '" class="comments__container">'; ?>
            <div class="comments__box">
                <span><?php echo $fetch_comments[$i]['comments']?></span>
            </div>
            <div class="comments__box comments__box--upload">
                <span><?php echo $fetch_comments[$i]['name'] ?? 'Anonyme' ?></span>
            </div>
            <div class="comments__box comments__box--date">
                <span><?php echo $fetch_comments[$i]['comment_date']?></span>
            </div>
            <div class="comments__box comments__box--date">
                <span><?php echo $fetch_comments[$i]['comment_on']?></span>
            </div>
            <div>
                <?php echo '<a onclick="deleteComment(' . $fetch_comments[$i]['id_comments'] . ', \'' . ($_SESSION["tkn"] ?? "") . '\')" class="a">Delete</a>'; ?>
            </div>
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
    </div>
</section>

<script>
    function deleteComment(comment_id, user_tkn) {
            if (confirm("Voulez-vous vraiment supprimer ce commentaire ?")){
                xhr = new XMLHttpRequest();

                xhr.open('POST', '../ajax/delete_comment.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        document.getElementById("comments" + comment_id).remove();
                        let nbComments = document.getElementById("commentsCount").innerHTML;
                        console.log(nbComments);
                        document.getElementById("commentsCount").innerHTML = parseInt(document.getElementById("commentsCount").innerHTML, 10) - 1;
                    }
                };
                xhr.send('comment_id='+comment_id+'&user='+user_tkn);
            }
        }
</script>
<?php include 'foot.php'; ?>
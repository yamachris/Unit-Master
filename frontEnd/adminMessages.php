<?php
require("../php/config.php");
include 'checkUser.php';
require("../php/checkAdmin.php");

include 'adminNav.php';

$nbr_elements_page = 5;
if (isset($_GET['message']) && !empty($_GET['message'])) {
    $page = $_GET['message'];
}else $page = 1;
$begin = ($page-1) * $nbr_elements_page;


$get_messages = $db->prepare("SELECT m.id_message FROM messages m JOIN users u ON u.ID = m.id_user");
$get_messages->execute();
;
$row_messages = $get_messages->rowCount();
?>
<section class="section">
    <h2>Messages (<?php echo $row_messages?>):</h2>
    <div>
        <?php
        if ($row_messages >= 1) {
            
            $get_messages = $db->prepare("SELECT * FROM messages m JOIN users u ON u.ID = m.id_user ORDER BY m.id_message DESC LIMIT $begin,$nbr_elements_page");
            $get_messages->execute();
            ;
            $fetch_comments = $get_messages->fetchAll();
            $nbr_pages = ceil($row_messages/$nbr_elements_page);


            for ($i=0; $i < sizeof($fetch_comments); $i++) { 
        ?>
        <div id="comments" class="comments__container">
            <div class="comments__box">
                <span><?php echo $fetch_comments[$i]['message']?></span>
            </div>
            <div class="comments__box comments__box--upload">
                <span><?php echo $fetch_comments[$i]['name']?></span>
            </div>
            <div>
                <a href="deleteMessage.php?id=<?php echo $fetch_comments[$i]['id_message']?>" class="a">Delete</a>
            </div>
        </div>
        <?php
            }

            for ($i=1; $i <= $nbr_pages; $i++) { 
                if ($i != $page) {
                    echo '<a class="commentLink" href="?message='.$i.'">'.$i.'</a>&nbsp;';
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
<?php include 'foot.php'; ?>
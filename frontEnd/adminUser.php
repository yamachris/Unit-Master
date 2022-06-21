<?php
require("../php/config.php");
include 'checkUser.php';
require("../php/checkAdmin.php");
$pageName = 'Régle du jeu';
$pageFile = "gameMechanics.php";

include 'adminNav.php';

$nbr_elements_page = 5;
if (isset($_GET['user']) && !empty($_GET['user'])) {
    $page = $_GET['user'];
}else $page = 1;
$begin = ($page-1) * $nbr_elements_page;

$roles = ["user", "admin"];

$get_users = $db->prepare("SELECT `ID` FROM `users`");
$get_users->execute();
$row_users = $get_users->rowCount();
?>
<section class="section">
    <h2>Utilisateurs (<?php echo $row_users?>):</h2>
    <div>
        <?php
        if ($row_users >= 1) {
            $get_comments = $db->prepare("SELECT * FROM `users`
            ORDER BY `ID` DESC LIMIT $begin,$nbr_elements_page");
            $get_comments->execute();
            $fetch_comments = $get_comments->fetchAll();
            $nbr_pages = ceil($row_users/$nbr_elements_page);


            for ($i=0; $i < sizeof($fetch_comments); $i++) { 
        ?>
        <div id="comments" class="comments__container">
            <div class="comments__box">
                <span><?php echo $fetch_comments[$i]['name']?></span>
            </div>
            <div class="comments__box comments__box--upload">
                <span><?php echo $fetch_comments[$i]['email']?></span>
            </div>
            <div class="comments__box comments__box--date">
                <!--<span><?php echo $fetch_comments[$i]['role']?></span>-->
                <?php if ($_SESSION["tkn"] !== $fetch_comments[$i]['token']) { 
                echo '<select name="roles" id="roles' . $fetch_comments[$i]["ID"] . '" value="" style="margin-top: 1%;" onchange="changeUserRole(' . $fetch_comments[$i]["ID"] . ', \'' . $_SESSION["tkn"] . '\');">';

                        foreach($roles as $role) {
                            if ($fetch_comments[$i]['role'] === $role) {
                                echo '<option selected="selected">' . $role . '</option>';
                            } else {
                                echo '<option>' . $role . '</option>';
                            }
                        }

                    ?>
                </select>
                <?php } ?>
            </div>
            <div>
                <a href="deleteUser.php?id=<?php echo $fetch_comments[$i]['ID']?>" class="a">Delete</a>
            </div>
        </div>
        <?php
            }

            for ($i=1; $i <= $nbr_pages; $i++) { 
                if ($i != $page) {
                    echo '<a class="commentLink" href="?user='.$i.'">'.$i.'</a>&nbsp;';
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

<script type="text/javascript">
    function changeUserRole(target_id, user_tkn) {
        let selectedRole = document.getElementById("roles"+target_id).value;
        console.log(selectedRole);
        xhr = new XMLHttpRequest();

        xhr.open('POST', '../ajax/change_user_role.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                
            }
        };
        xhr.send('target_id='+target_id+'&user='+user_tkn+'&role='+selectedRole);
    }
</script>
<?php include 'foot.php'; ?>
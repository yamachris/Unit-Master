<?php
    include 'checkUser.php';
    if (!isset($_SESSION["tkn"])) {
        header('Location: ./index.php');
        die();
    }
    if (isset($_FILES) && isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["size"] > 0) {
        $target_dir = "../profile_pictures/";
        $target_file = $target_dir . basename($_SESSION['tkn'] . ".png");
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        if($imageFileType != "png") {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
          // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $set_user_picture = $db->prepare("UPDATE users SET profile_picture = :profilePicture WHERE token = :userToken");
                $imageName = $_SESSION['tkn'] . ".png";
                $set_user_picture->bindParam(':profilePicture', $imageName, PDO::PARAM_STR);
                $set_user_picture->bindParam(':userToken', $_SESSION["tkn"], PDO::PARAM_STR);
                $set_user_picture->execute();
                header("Refresh:0");
            }
          }
    }
    require("../php/config.php");
    include 'head.php';
?>
<section class="section">
    <div style="width: 50%;margin:auto;margin-left: 17%;background: #FFF;border-radius: 5px;padding:3%;">
        <div class="PageLayoutTitle">
            <?php
                $get_user = $db->prepare("SELECT * FROM users WHERE token = :userToken");
                $get_user->bindParam(':userToken', $_SESSION["tkn"], PDO::PARAM_STR);
                $get_user->execute();
                $user = $get_user->fetch();
                echo "<b><h1>" . $user['name'] . "</h1></b>";
            ?>
        </div>
        <div style="width:100%;display: flex;justify-content: center;">
            <div id="editCredentials" style="margin-top: 2%;width: 100%;text-align: center;">
                <div id="showMail" style="display: block;">
                    <input type="mail" placeholder="email" id="email" value="<?php echo $user['email'] ?>" class="profile-input-text" disabled/><ion-icon name="create-outline" onclick="editEmail()" style="cursor: pointer;"></ion-icon>
                </div>
                <div id="editMail" style="display: none;">
                    <input type="mail" placeholder="email" id="emailModif" value="<?php echo $user['email'] ?>" class="profile-input-text"/><ion-icon name="checkmark-outline" style="cursor: pointer;" onclick="validateEmail()"></ion-icon><ion-icon name="close-outline" style="cursor: pointer;" onclick="closeEditEmail()"></ion-icon>
                </div><br/>
                <div id="showPassword" style="display: block;">
                    <input type="password" id="password" placeholder="mot de passe" value="" class="profile-input-text" disabled/><ion-icon name="create-outline" style="cursor: pointer;" onclick="editPassword()"></ion-icon>
                </div>
                <div id="editPassword" style="display: none;">
                    <input type="password" id="passwordModif" placeholder="Mot de passe" value="" class="profile-input-text"/><ion-icon name="checkmark-outline" style="cursor: pointer;" onclick="validatePassword()"></ion-icon><ion-icon name="close-outline" style="cursor: pointer;" onclick="closeEditPassword()"></ion-icon><br/>
                    <input type="password" style="margin-left: -4.5%;" id="passwordModifConfirmation" placeholder="Confirmer le mot de passe" value="" class="profile-input-text"/>
                </div><br/>
                <hr style="height: 1px;background-color: rgba(20, 20, 20, 0.2);border: none;margin-top: 4%;">
                <div style="margin-top: 2%;">
                    <form action="./profile.php" id="create-giveaway-form" method="post" class="create-giveaway" enctype="multipart/form-data">
                        <?php 
                            if (!isset($user["profile_picture"]) || $user["profile_picture"] === null) {
                                echo "<p>Définir une image de profil</p>";
                            } else {
                                echo "<div style='width:100%;text-align:center;'><img src='../profile_pictures/" . $user["profile_picture"] . "' style='margin-bottom:2%;' width='200px' height='200px'/></div>";
                            }
                        ?>
                        <input type="file" name="fileToUpload"  class="form-giveaway-inputs" style="" id="fileToUpload"><br/>
                        <input type="submit" class="profile-btn" value="Envoyer l'image" style="margin-top: 2%;">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function editEmail () {
        document.getElementById("showMail").style.display = "none";
        document.getElementById("editMail").style.display = "block";
    }
    function closeEditEmail () {
        document.getElementById("showMail").style.display = "block";
        document.getElementById("editMail").style.display = "none";
    }
    function validateEmail () {
        let newMail = document.getElementById("emailModif").value;
        if (confirm("Voulez-vous vraiment modifier votre adresse mail pour : " + newMail + " ?")){
            xhr = new XMLHttpRequest();


            xhr.open('POST', '../ajax/change_mail.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById("email").value = newMail;
                    closeEditEmail();
                }
            };
            let userToken = '<?php echo ($_SESSION["tkn"] ?? "") ?>';
            xhr.send("email="+encodeURIComponent(newMail)+"&user="+userToken);
        }
    }
    function validatePassword () {
        let newPassword = document.getElementById("passwordModif").value;
        let newPasswordConfirmation = document.getElementById("passwordModifConfirmation").value;
        if (newPassword !== newPasswordConfirmation) {
            alert("Les 2 mot de passe doivent être identiques.");
            return;
        }
        if (newPassword.length < 10 || newPasswordConfirmation.length < 10) {
            alert("Votre mot de passe doit faire au moins 10 caractères.");
            return;
        }
        if (confirm("Voulez-vous vraiment modifier votre mot de passe ?")){
            xhr = new XMLHttpRequest();


            xhr.open('POST', '../ajax/change_password.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    closeEditPassword();
                }
            };
            let userToken = '<?php echo ($_SESSION["tkn"] ?? "") ?>';
            xhr.send("password="+encodeURIComponent(newPassword)+"&passwordConfirmation="+encodeURIComponent(newPasswordConfirmation)+"&user="+userToken);
        }
    }
    function editPassword () {
        document.getElementById("showPassword").style.display = "none";
        document.getElementById("editPassword").style.display = "block";
    }
    function closeEditPassword () {
        document.getElementById("showPassword").style.display = "block";
        document.getElementById("editPassword").style.display = "none";
    }
</script>

<?php include 'foot.php'; ?>
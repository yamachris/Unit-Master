<?php
    include 'checkUser.php';
    $pageName = 'Conversation Générale';
    include 'head.php';
?>
    <section>
    <div class="PageLayoutTitle">
        <h1>Chat Général</h1>
    </div>
        <div id="MessageBox">
            <div id="Messages">
            </div>
            <?php
                if (isset($_SESSION["tkn"])) {
                    echo '
                        <div id="send_message_box">
                            <input id="message" type="text" name="txtMessage" placeholder="Message...."><button id="btnMessage" class="btn btn-success">Send</button>
                        </div>
                    ';
                }
            ?>
            <div id="ifErr">
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var editing = false;
        $('#btnMessage').on("click", function(){
            var message = $("#message").val();
            var newStr = message.replace(/\s/g, "_");
            newStr = encodeURIComponent(newStr);
            var getMsgField = document.getElementById("message").value = "";
            xhr = new XMLHttpRequest();

            xhr.open('POST', '../ajax/sendMessages.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log(xhr);
                }
            };
            let userToken = '<?php echo ($_SESSION["tkn"] ?? "") ?>';
            xhr.send("msg="+newStr+"&user="+userToken);
        })

        setInterval(viewMessage, 1000);
        function viewMessage(){
            if (!editing) {
                $("#Messages").load("allMessages.php");
            }
        }
    </script>

<?php include 'foot.php'; ?>
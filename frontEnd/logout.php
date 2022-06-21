<?php
session_start();
if (isset($_COOKIE['tkn'])) {
    unset($_COOKIE['tkn']);
}
session_destroy();
header("Location: index.php");
exit();
?>
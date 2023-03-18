<?php
if (!isset($_SESSION['ic']) || isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
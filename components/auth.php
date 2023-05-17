<?php
// Check if IC is stored in the session
if (!isset($_SESSION['ic'])) {
    header('Location: login.php');
}
?>
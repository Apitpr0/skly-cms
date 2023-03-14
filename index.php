<?php
session_start();

if (!isset($_SESSION['ic'])) {
    header('Location: login.php');
    exit;
}
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
// Rest of the code for the protected page goes here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    HOME
    <form method="post">
    <input type="submit" name="logout" value="Logout">
</form>
</body>
</html>
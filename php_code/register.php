<?php
require('db_connection.php'); //pointing to our db connection
$msg="";
if(isset($_POST['submit'])) //if someone press submit
{

    $id=$_POST['id'];
    $ic=$_POST['ic'];
    $password=$_POST['password'];
    $cPass=$_POST['cpass'];

if($password != $cPass)
{
    $msg="Please check your password";
}
else
{
    //hash password
    $passwordHash=password_hash($password,PASSWORD_DEFAULT);
    $query="INSERT INTO USERS (name,email,password) VALUES ('$id','$ic','$passwordHash')";
    mysqli_query($connection,$query) or die(mysqli_error($connection));
    $msg="Register Successful";
}
}
?>


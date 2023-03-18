<?php
$connection=mysqli_connect('localhost','root',''); //connection with db
if(!$connection)
{
    die("Database connection failed".mysqli_error($connection)); //failed statement
}
$select_db=mysqli_select_db($connection,'skly_cms'); //db name
if(!$select_db)
{
    die("Database selection failed".mysqli_error($connection)); //failed statement
}
?>
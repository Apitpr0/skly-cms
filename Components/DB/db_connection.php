<?php
$host = 'localhost';
$username = 'root';
$password = ''; 
$dbname = 'skly_cms';

$connection = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    error_log('Database connection failed: ' . mysqli_connect_error());
    die('Database connection failed. Please try again later.');
}
?>
<?php
include "components/db/db_connection.php";
$id = $_REQUEST['appt_id'];
echo $id;
$query="DELETE FROM appointment WHERE appt_id='$id'";
$result = mysqli_query($connection,$query);
header("Location: dashboard_admin.php"); 

// echo "<script>window.location='dashboard_admin.php'</script>";
?>

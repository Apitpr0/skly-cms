<?php
include "components/db/db_connection.php";
$id = $_GET['delete_id'];
$result = mysqli_query($con,"DELETE FROM appointment WHERE appt_id='$id'");
 echo "<script>window.location='admin.php'</script>";
?>

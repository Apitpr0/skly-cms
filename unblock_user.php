<?php
include("components/db/db_connection.php");

if(isset($_POST['id'])) {
    $user_id = $_POST['id'];
    
    // Update the user's is_blocked status to 0 to unblock the user
    $query = "UPDATE users SET is_blocked = 0 WHERE id = $user_id";
    $result = mysqli_query($connection, $query);
    
    if($result) {
        // Notify the admin that the user has been unblocked
        echo '<script>alert("User has been unblocked successfully!");</script>';
    } else {
        // Notify the admin that an error occurred while unblocking the user
        echo '<script>alert("Error: User could not be unblocked!");</script>';
    }
    
    // Redirect back to the blocked users page
    header("Location: blocked_users.php");
    exit();
} else {
    // Redirect back to the blocked users page
    header("Location: blocked_users.php");
    exit();
}

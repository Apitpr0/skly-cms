<?php
session_start();
include('components/header.php');
include('components/db/db_connection.php');

// Check if user is logged in
if (!isset($_SESSION['ic'])) {
    header('Location: login.php');
    exit;
}

// Get current user's IC number
$ic = $_SESSION['ic'];

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get form data
    $current_password = mysqli_real_escape_string($connection, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($connection, $_POST['new_password']);
    $confirm_new_password = mysqli_real_escape_string($connection, $_POST['confirm_new_password']);

    // Get the user's current password from the database
    $sql = "SELECT password FROM users WHERE ic='$ic'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_hashed_password = $row['password'];
    $passDB = $row['password'];

    // Check if the current password matches the one in the database
    if ($current_hashed_password === $passDB) {
        $error_message = "Kata laluan semasa tidak tepat";
    } else {
        // Check if the new passwords match
        if ($new_password != $confirm_new_password) {
            $error_message = "Kata laluan baharu tidak sepadan";
        } else {
            // Hash the new password using SHA512
            $hashed_password = hash('sha512', $new_password);

            // Update the user's password in the database
            $sql = "UPDATE users SET password='$hashed_password' WHERE ic='$ic'";
            if (mysqli_query($connection, $sql)) {
                $success_message = "Kata laluan berjaya dikemaskini";
            } else {
                $error_message = "Kata laluan tidak berjaya dikemaskini" . mysqli_error($connection);
            }
        }
    }
    // Debugging statement to check current password entered by user
    echo "Current Password: " . $current_password . "<br>";

    // Debugging statement to check current hashed password in database
    echo "Current Hashed Password: " . $current_hashed_password . "<br>";

    // Debugging statement to check if password_verify returns true or false
    if (password_verify($current_password, $current_hashed_password)) {
        echo "Password Verify: True<br>";
    } else {
        echo "Password Verify: False<br>";
    }
}

mysqli_close($connection);
?>
<div class="max-w-md mx-auto my-8">
    <h1 class="text-2xl font-bold mb-4">Kemaskini Kata Laluan</h1>
    <form action="" method="post" class="space-y-4">
        <?php if (isset($error_message)) : ?>
            <div class="bg-red-500 text-white font-bold py-2 px-4 rounded mb-4"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <?php if (isset($success_message)) : ?>
            <div class="bg-green-500 text-white font-bold py-2 px-4 rounded mb-4"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <div>
            <label for="current_password" class="block font-medium">Kata Laluan Semasa:</label>
            <input type="password" id="current_password" name="current_password" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <label for="new_password" class="block font-medium">Kata Laluan Baharu:</label>
            <input type="password" id="new_password" name="new_password" required class="w-full px-4 py-2 border-gray-300 rounded-md">
        </div>
        <div>
            <label for="confirm_new_password" class="block font-medium">Sahkan Kata Laluan Baharu:</label>
            <input type="password" id="confirm_new_password" name="confirm_new_password" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <button type="submit" name="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Kemaskini</button>
        </div>
    </form>

</div>
<?php include('components/footer.php'); ?>
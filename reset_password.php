<?php
include('components/header.php');
include('components/db/db_connection.php');

if (isset($_POST['submit'])) {
    $ic = mysqli_real_escape_string($connection, $_POST['ic']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);

    // Check if the passwords match
    if ($password != $confirm_password) {
        echo "Passwords do not match";
        exit;
    }

    // Hash the password using SHA-512
    $hashed_password = hash('sha512', $password);

    // Update the user's password in the database
    $sql = "UPDATE users SET password='$hashed_password' WHERE ic='$ic'";
    if (mysqli_query($connection, $sql)) {
        echo '<div class="bg-green-500 text-white font-bold py-2 px-4 rounded mb-4">Kata Laluan Berjaya Dikemaskini</div>';
    } else {
        echo '<div class="bg-red-500 text-white font-bold py-2 px-4 rounded mb-4">Kata Laluan Tidak Berjaya Dikemaskini</div>' . mysqli_error($connection);
    }
    
}

mysqli_close($connection);
?>
<div class="max-w-md mx-auto my-8">
    <h1 class="text-2xl font-bold mb-4">Lupa Kata Laluan?</h1>
    <form action="" method="post" class="space-y-4">
        <div>
            <label for="ic" class="block font-medium">Nombor IC:</label>
            <input type="text" id="ic" name="ic" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <label for="password" class="block font-medium">Kata Laluan baharu:</label>
            <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>
        <div>
            <label for="confirm_password" class="block font-medium">Sahkan Kata Laluan baharu:</label>
            <input type="password" id="confirm_password" name="confirm_password" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>
        <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Set Semula Kata Laluan</button>
    </form>
    <div class="mt-4 text-center">
        <a href="login.php" class="text-blue-500 hover:text-blue-700 font-medium">Kembali ke Log Masuk</a>
    </div>

</div>

<?php
include('components/footer.php');
?>
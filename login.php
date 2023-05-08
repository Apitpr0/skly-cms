<?php
include('Components/db/db_connection.php');
include('Components/header.php');

if (isset($_POST['submit'])) {
    $ic = mysqli_real_escape_string($connection, $_POST['ic']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * FROM users WHERE ic='$ic'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $passDB = $row['password'];
        $is_admin = $row['is_admin'];
        $login_attempts = $row['login_attempts'];
        $is_blocked = $row['is_blocked'];

        if ($is_blocked == 1) {
            $msg = "Akaun anda telah diblok. Sila hubungi pentadbir sistem.";
        } else {
            $hashed_password = hash('sha512', $password);
            if ($hashed_password === $passDB) {
                // Reset login attempts if user logs in successfully
                $reset_query = "UPDATE users SET login_attempts = 0 WHERE ic='$ic'";
                mysqli_query($connection, $reset_query);

                // Get the user's profile picture data
                $picture_data = $row['profile_picture'];

                session_start();
                $_SESSION['ic'] = $ic;
                $_SESSION['is_admin'] = $is_admin;
                $_SESSION['profile_picture'] = base64_encode($picture_data); // Store the picture data as a session variable

                if ($is_admin == 1) {
                    header('Location: dashboard_admin.php');
                } else {
                    header('Location: index.php');
                }
                exit;
            } else {
                // Increment login attempts if user enters incorrect password
                $login_attempts++;

                if ($login_attempts >= 3) {
                    // Block the user if they have exceeded the maximum number of login attempts
                    $query = "UPDATE users SET is_blocked = 1 WHERE ic='$ic'";
                    mysqli_query($connection, $query) or die(mysqli_error($connection));
                    $msg = "Kata laluan salah. Anda telah mencuba untuk log masuk lebih daripada 3 kali dan akaun anda telah diblok.";
                } else {
                    $msg = "Kata laluan salah. Sila cuba lagi.";

                    // Update the login_attempts column in the database
                    $query = "UPDATE users SET login_attempts = $login_attempts WHERE ic='$ic'";
                    mysqli_query($connection, $query) or die(mysqli_error($connection));
                }
            }
        }
    } else {
        $msg = "No Kad Pengenalan atau Kata Laluan salah. Sila cuba lagi.";

        // Block the user if they do not exist in the database
        $query = "SELECT * FROM users WHERE ic='$ic'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        $count = mysqli_num_rows($result);

        if ($count == 0) {
            $query = "UPDATE users SET is_blocked = 1 WHERE ic='$ic'";
            mysqli_query($connection, $query) or die(mysqli_error($connection));
            $msg = "No Kad Pengenalan atau Kata Laluan salah";
            echo "<script>
                    document.getElementById('username').disabled = true;
                    document.getElementById('password').disabled = true;
                </script>";
        }
    }
}
?>
<div class="mt-10 flex justify-center">
    <div class="text-center">
        <div class="w-64 mx-auto">
            <img src="Components/assets/img/school_logo.png" alt="Logo">
        </div>
        <br>
        <h4 class="text-lg font-bold">Selamat Kembali, sila daftar masuk</h4><br>
        <?php
        if (isset($msg)) {
            echo '<div class="text-red-500">' . $msg . '</div>';
        }
        ?>
        <form method="post" action="login.php">
            <input class="border border-gray-300 p-2 rounded-md w-64" type="" name="ic" placeholder="No Kad Pengenalan" required><br>
            <input class="border border-gray-300 p-2 rounded-md w-64 mt-2" type="password" name="password" placeholder="Kata Laluan" required><br>
            <input class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2" type="submit" name="submit" value="Log Masuk"><br>
            <a href="register.php" class="mt-2 inline-block">Belum mempunyai akaun? Daftar di sini.</a>
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ic = trim(filter_var($_POST['ic'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $password = trim($_POST['password']);
            // further processing
        }
        ?>
    </div>
</div>

<?php
include('Components/footer.php');
?>
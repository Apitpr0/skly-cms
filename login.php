<?php
include 'Components\DB\db_connection.php';
include 'Components\layout\header.php';

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
                    $_SESSION['is_admin'] = $is_admin; //1
                    header('Location: dashboard_admin.php');
                } else {
                    $_SESSION['is_admin'] = $is_admin; //0
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

<section class="bg-background dark:background">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="w-8 h-8 mr-2" src="Assets/Image/school_logo.png" alt="logo">
          SKLY Counselling Management System    
      </a>
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Sign in to your account
              </h1>
              <form method="post" class="space-y-4 md:space-y-6">
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your ic</label>
                      <input type="text" name="ic" id="ic" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="880812121234" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <div class="flex items-center justify-between">
                      <a href="reset_password.php" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                  </div>
                  <button type="submit" name="submit" class="w-full text-white bg-card hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      Don’t have an account yet? <a  href="register.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                  </p>
              </form>
          </div>
      </div>
  </div>
</section>
<?php
include 'Components\layout\footer.php';
?>
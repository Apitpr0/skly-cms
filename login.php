<?php
include('Components/db/db_connection.php');
include('Components/header.php');

if (isset($_POST['submit'])) {
    $ic = mysqli_real_escape_string($connection, $_POST['ic']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    
    $query = "SELECT * FROM users WHERE ic='$ic'";
    $result = mysqli_query($connection, $query) or die (mysqli_error($connection));
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $passDB = $row['password'];
        $is_admin = $row['is_admin'];
        
        $hashed_password = hash('sha512', $password);
        if ($hashed_password === $passDB) {
            // Get the user's profile picture data
            $picture_data = $row['profile_picture'];
        
            session_start();
            $_SESSION['ic'] = $ic;
            $_SESSION['is_admin'] = $is_admin;
            $_SESSION['profile_picture'] = base64_encode($picture_data); // Store the picture data as a session variable
        
            if ($is_admin == 1) {
                header('Location: admin.php');
            } else {
                header('Location: index.php');
            }
            exit;
        }
        else {
            $msg = "Salah, periksa kembali";
        }
    } else {
        $msg = "Salah, periksa kembali";
    }
}
?>
<div class="mt-10 flex justify-center">
  <div class="text-center">
    <img src="" alt="Logo"><br><br>
    <h4 class="text-lg font-bold">Selamat Kembali, sila daftar masuk</h4><br>
    <?php 
     if(isset($msg)) {
        echo '<div class="text-red-500">'.$msg.'</div>';
     }
    ?> 
    <form method="post" action="login.php">
     <input class="border border-gray-300 p-2 rounded-md w-64" type="" name="ic" placeholder="No Kad Pengenalan" required><br>
     <input class="border border-gray-300 p-2 rounded-md w-64 mt-2" type="password" name="password" placeholder="Kata Laluan" required><br>
     <input class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2" type="submit" name="submit" value="Login"><br>
     <a href="register.php" class="mt-2 inline-block">Belum mempunyai akaun? Daftar di sini.</a>
    </form>
   </div>
</div>

 <?php
include('Components/header.php');
?>
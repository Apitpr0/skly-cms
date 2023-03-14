<?php
include('db_connection.php');
$msg = "";

if (isset($_POST['submit'])) {  
    $ic = $_POST['ic'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE ic='$ic'";
    $result = mysqli_query($connection, $query) or die (mysqli_error($connection));
    $count = mysqli_num_rows($result);

    // fetch data from DB
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $passDB = $row['password'];
    $is_admin = $row['is_admin'];
    if ($count == 1) {
        // verify password here with SHA512 hash
        $hashed_password = hash('sha512', $password);
        if ($hashed_password === $passDB) {
            $msg = "Berjaya log masuk, Selamat datang";
            session_start();
            $_SESSION['ic'] = $ic;
            $_SESSION['is_admin'] = $is_admin;
            $msg = "Berjaya log masuk, Selamat datang";
            
            // redirect to the appropriate page based on user's admin status
            if ($is_admin == 1) {
                header('Location: admin.php');
            } else {
                header('Location: index.php');
            }
            exit;
        } else {
            $msg = "Salah, periksa kembali";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
 <title>Daftar Masuk</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
 <div class="container" style="margin-top: 100px">
  <div class="row justify-content-center">
   <div class="col-md-6 col-md-offset-3" align="center">
    
    <img src=""><br><br>

    <h4>Selamat Kembali, sila daftar masuk</h4><br>

    <?php 
     if($msg != "")
      echo $msg; 

    ?> 

    <form method="post" action="login.php">
     <input class="form-control" type="" name="ic" placeholder="No Kad Pengenalan"><br>
     <input class="form-control" type="password" name="password" placeholder="Kata Laluan"><br>
     <input class="btn btn-primary" type="submit" name="submit" placeholder="Login"><br>
    </form>
    <a href="register.php">REGISTER?</a>
   </div>
  </div>
 </div>

</body>
</html>
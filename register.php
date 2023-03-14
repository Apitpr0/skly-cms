<?php
require('components/db_connection.php'); //pointing to our db connection
$msg = "";
if(isset($_POST['submit'])) {
    $ic = ($_POST['ic']);
    $password = $_POST['password'];
    $cPass = $_POST['cpass'];

    // Check if passwords match
    if($password != $cPass) {
        $msg = "Passwords do not match";
    }
    // Check password length and complexity
    elseif(strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-zA-Z]+#", $password)) {
        $msg = "Password must be at least 8 characters long and contain at least one letter and one number";
    }
    else {
        // Hash password
        $hashed_password = hash('sha512', $password);

        // Insert user data into database
        $query = "INSERT INTO USERS (ic, password) VALUES ('$ic', '$hashed_password')";
        mysqli_query($connection, $query) or die(mysqli_error($connection));

        $msg = "Registration successful";
        header("Location: login.php");
    }
    echo $msg;
}
?>

<!DOCTYPE html>
<html>
<head>
 <title>Pendaftaran</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
 <div class="container" style="margin-top: 100px">
  <div class="row justify-content-center">
   <div class="col-md-8 col-md-offset-3" align="center">
    

    <h4>Register</h4><br>

    <?php 
     if($msg != "")
      echo $msg; 

    ?>

    <form method="post" action="register.php">
     <input class="form-control" type="textbox" name="ic" placeholder="No Kad Pengenalan" required="true"><br>
     <input class="form-control" type="password" name="password" placeholder="Kata Laluan" required="true"><br>
     <input class="form-control" type="password" name="cpass" placeholder="Sahkan Kata Laluan" required="true"><br>
     <input class="btn btn-primary" type="submit" name="submit" placeholder="Submit"><br>
    </form>

   </div>
  </div>
 </div>

</body>
</html>


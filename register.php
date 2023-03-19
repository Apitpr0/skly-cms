<?php
require('components/db/db_connection.php'); //pointing to our db connection
$msg = "";
if (isset($_POST['submit'])) {
    $ic = $_POST['ic'];
    $password = $_POST['password'];
    $cPass = $_POST['cpass'];

    // Check if passwords match
    if ($password != $cPass) {
        $msg = "Passwords do not match";
    }
    // Check password length and complexity
    elseif (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-zA-Z]+#", $password)) {
        $msg = "Password must be at least 8 characters long and contain at least one letter and one number";
    } else {
        // Hash password
        $hashed_password = hash('sha512', $password);

        // Handle profile picture upload
        if (isset($_FILES['profile_picture'])) {
            $file = $_FILES['profile_picture'];
            $fileName = basename($file['name']);
            $fileTmpName = $file['tmp_name'];
            $fileError = $file['error'];

            if ($fileError === 0) {
                // Generate a unique filename to avoid overwriting existing files
                $fileNameNew = uniqid('', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                // Specify the directory where the file should be moved to
                $fileDestination = 'uploads/' . urlencode($fileNameNew);
                // Move the uploaded file to its new location
                move_uploaded_file($fileTmpName, realpath(dirname(__FILE__)) . '/' .  ltrim($fileDestination,'/'));
                
                // Insert user data into database with profile picture path
                mysqli_query(
                    $connection,
                    "INSERT INTO USERS (ic, password, profile_picture) VALUES ('$ic', '$hashed_password', '$fileDestination')"
                ) or die(mysqli_error($connection));
                
                header("Location: login.php");
            } else {
                // Handle file upload errors
                switch ($fileError) {
                    case UPLOAD_ERR_INI_SIZE:
                        throw new RuntimeException('Exceeded filesize limit.');
                    case UPLOAD_ERR_FORM_SIZE:
                        throw new RuntimeException('Exceeded filesize limit.');
                    case UPLOAD_ERR_PARTIAL:
                        throw new RuntimeException('File upload was interrupted.');
                    case UPLOAD_ERR_NO_FILE:
                        throw new RuntimeException('No file sent.');
                    case UPLOAD_ERR_NO_TMP_DIR:
                        throw new RuntimeException('Missing a temporary folder.');
                    case UPLOAD_ERR_CANT_WRITE:
                        throw new RuntimeException('Failed to write file to disk.');
                    case UPLOAD_ERR_EXTENSION:
                        throw new RuntimeException('A PHP extension stopped the file upload.');
                    default:
                        throw new RuntimeException('Unknown errors');
                }
            }
        } else {
            // Insert user data into database without profile picture path
            mysqli_query(
                $connection,
                "INSERT INTO USERS (ic, password) VALUES ('$ic', '$hashed_password')"
            ) or die(mysqli_error($connection));
            
            header("Location: login.php");
        }
        
        exit;
    }
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
    <input class="form-control" type="file" name="profile_picture" accept="image/*">
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


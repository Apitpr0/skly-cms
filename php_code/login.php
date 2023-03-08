<?php
    include('db_connection.php');
    $msg="";

    if(isset($_POST['submit'])) //if someone press submit
    {  
        $ic=$_POST['ic'];
        $password=$_POST['password'];

        $query="SELECT * FROM USERS WHERE ic='$ic'";
        $result=mysqli_query($connection,$query) or die (mysqli_error($connection));
        $count=mysqli_num_rows($result);

        //fetch data from DB
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
            $passDB=$row['password'];
        
        if($count==1)
        {
            //verify password here with hash
            if(password_verify($password,$passDB))
            {
                $msg="Berjaya log masuk, Selamat datang";
            }
        }
        else
        {
            $msg="Salah, periksa kembali";
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
     <input class="form-control" type="" name="ic" placeholder="IC"><br>
     <input class="form-control" type="password" name="password" placeholder="Password"><br>
     <input class="btn btn-primary" type="submit" name="submit" placeholder="Login"><br>
    </form>

   </div>
  </div>
 </div>

</body>
</html>

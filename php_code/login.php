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
                $msg="Log In !";
            }
        }
        else
        {
            $msg="Check Your Input";
        }
    } 
?>


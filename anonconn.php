<?php
include "components/db_connection.php";
include "components/navbar.php";
$anonmsg = "";

// Start the session before any output is sent to the browser
if(isset($_POST['submit'])){
  // Get the submitted confession message from the POST request
  $confession = mysqli_real_escape_string($connection,$_POST['confession']);
  //Insert into db
  $sql = "INSERT INTO anonymous_confession (message) VALUES ('$confession')";
  if (mysqli_query($connection, $sql)) {
    // Set a session variable to store the success message
    $_SESSION['success_message'] = "Confession submitted successfully!";
} else {
    // Set a session variable to store the error message
    $_SESSION['error_message'] = "Error submitting confession: " . mysqli_error($connection);
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>SKLY-CMS - Anonymous Confession</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        h1 {
            font-size: 36px;
            margin-top: 20px;
            text-align: center;
        }
        form {
            max-width: 500px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
        }
        input[type=text] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 18px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button[type=submit] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 18px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        button[type=submit]:hover {
            background-color: #0062cc;
        }
        p.success-message {
            color: green;
        }
        p.error-message {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Ruang Pengakuan</h1>
    <form method="post" action="anonconn.php">
        <label for="confession">Pengakuan anda:</label>
        <input type="text" id="confession" name="confession">
        <?php
        // Check if there is a success message in the session, and display it if it exists
        if(isset($_SESSION['success_message'])) {
            echo "<p class='success-message'>" . $_SESSION['success_message'] . "</p>";
            unset($_SESSION['success_message']); // Clear the success message from the session
        }
        // Check if there is an error message in the session, and display it if it exists
        if(isset($_SESSION['error_message'])) {
            echo "<p class='error-message'>" . $_SESSION['error_message'] . "</p>";
            unset($_SESSION['error_message']); // Clear the error message from the session
        }
        ?>
        <button type="submit" name="submit">Hantar</button>
    </form>
</body>
</html>
<?php
// Select all the records from the anonymous_confession table
$sql = "SELECT * FROM anonymous_confession";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
    // Output each record as a list item
    echo "<ul>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["message"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No messages found.";
}
// Close the database connection
mysqli_close($connection);
?>


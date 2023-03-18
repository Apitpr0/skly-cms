<?php
include('Components/db/db_connection.php');
include('Components/header.php');
include('Components/navbar.php');
include('Components/auth.php');

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

<div class="container mx-auto px-4">
  <h1 class="text-4xl font-bold mt-8 mb-4">Ruang Pengakuan</h1>

  <form method="post" action="anonconn.php">
    <label for="confession" class="block mb-2 font-bold">Pengakuan anda:</label>
    <textarea id="confession" name="confession" class="block w-full px-3 py-2 border rounded-md mb-4" placeholder="Tulis pengakuan anda di sini..."></textarea>

    <?php
    // Check if there is a success message in the session, and display it if it exists
    if(isset($_SESSION['success_message'])) {
      echo "<p class='text-green-500 mb-4'>" . $_SESSION['success_message'] . "</p>";
      unset($_SESSION['success_message']); // Clear the success message from the session
    }
    // Check if there is an error message in the session, and display it if it exists
    if(isset($_SESSION['error_message'])) {
      echo "<p class='text-red-500 mb-4'>" . $_SESSION['error_message'] . "</p>";
      unset($_SESSION['error_message']); // Clear the error message from the session
    }
    ?>

    <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Hantar</button>
  </form>

  <?php
  // Select all the records from the anonymous_confession table
  $sql = "SELECT * FROM anonymous_confession";
  $result = mysqli_query($connection, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    // Output each record as a list item
    echo "<ul class='list-disc pl-4 mt-4'>";
    while($row = mysqli_fetch_assoc($result)) {
      echo "<li class='mb-2'>" . $row["message"] . "</li>";
    }
    echo "</ul>";
  } else {
    echo "<p class='mt-4'>Tiada pengakuan yang dijumpai.</p>";
  }
  
  // Close the database connection
  mysqli_close($connection);
  ?>
</div>

<?php
include('Components/footer.php');
?>

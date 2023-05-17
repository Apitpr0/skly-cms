<?php
include('Components/db/db_connection.php');
include('Components/header.php');
include('Components/navbar.php');

// Define variables for form data
$confession = '';
$confessionError = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Sanitize and validate the confession message
  $confession = sanitizeInput($_POST['confession']);
  if (empty($confession)) {
    $confessionError = 'Sila isi ruangan pengakuan.';
  }

  // If there are no errors, insert the confession into the database
  if (empty($confessionError)) {
    $sql = "INSERT INTO anonymous_confession (message) VALUES ('$confession')";
    if (mysqli_query($connection, $sql)) {
      $_SESSION['success_message'] = '<strong>Pengakuan anda telah berjaya dihantar.</strong>';
    } else {
      $_SESSION['error_message'] = 'Maaf, terdapat masalah dalam memproses pengakuan anda.';
    }
  }
}

// Function to sanitize user input
function sanitizeInput($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<div class="container mx-auto px-4">
  <h1 class="text-4xl font-bold mt-8 mb-4">Ruang Pengakuan</h1>

  <form method="post" action="anonconn.php">
    <label for="confession" class="block mb-2 font-bold">Pengakuan anda:</label>
    <textarea id="confession" name="confession" class="block w-full px-3 py-2 border rounded-md mb-4" placeholder="Tulis pengakuan anda di sini..."><?php echo htmlspecialchars($confession); ?></textarea>

    <?php if (!empty($confessionError)) : ?>
      <p class="text-red-500 mb-4"><?php echo $confessionError; ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])) : ?>
      <p class="text-green-500 mb-4"><?php echo $_SESSION['success_message']; ?></p>
      <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])) : ?>
      <p class="text-red-500 mb-4"><?php echo $_SESSION['error_message']; ?></p>
      <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Hantar</button>
  </form>

  <?php
  // Select all the records from the anonymous_confession table
  $sql = "SELECT * FROM anonymous_confession";
  $result = mysqli_query($connection, $sql);

  if (mysqli_num_rows($result) > 0) {
    // Output each record as a list item
    echo "<div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8'>";
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class='bg-white rounded-lg shadow-md p-6'>";
      echo "<p class='text-gray-700'>" . htmlspecialchars($row["message"]) . "</p>";
      echo "</div>";
    }
    echo "</div>";
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
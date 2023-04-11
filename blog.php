<?php
// Include database connection code
include('Components/db/db_connection.php');
//include('Components/auth.php');

// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get values from form
  $post_title = $_POST['post_title'];
  $post_content = $_POST['post_content'];
  $date_published = date("Y-m-d H:i:s");

  // Insert new blog post into database
  $query = "INSERT INTO blog_posts (post_title, post_content, date_published) 
            VALUES ('$post_title', '$post_content', '$date_published')";
  mysqli_query($connection, $query);
}

// Fetch blog posts from database
$query = "SELECT * FROM blog_posts ORDER BY date_published";
$result = mysqli_query($connection, $query);
// Include header and navbar
include('Components/header.php');
include('Components/navbar.php');
?>

<!-- Blog submission form -->
<form method="post" class="my-8 mx-auto max-w-lg">
  <div class="mb-4">
    <label for="post_title" class="block text-gray-700 font-bold mb-2">Tajuk</label>
    <input type="text" id="post_title" name="post_title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
  </div>

  <div class="mb-6">
    <label for="post_content" class="block text-gray-700 font-bold mb-2">Mesej</label>
    <textarea id="post_content" name="post_content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
  </div>
  
  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
    Submit
  </button>
</form>

<!-- Blog posts section -->
<div class="my-8 mx-auto max-w-4xl">
  <div>
    <h2 class="text-3xl font-bold mb-4">Blog Kaunseling</h2>
    <p class="text-gray-700">Informasi dari Unit Kaunseling</p>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
      <a href="#" class="block">
        <img class="h-48 w-full object-cover object-center" src="https://source.unsplash.com/featured/?nature" alt="<?php echo $row['post_title']; ?>">
      </a>
      <div class="p-6">
        <a href="#" class="block text-blue-500 font-semibold mb-2"><?php echo $row['post_title']; ?></a>
        <p class="text-gray-700 mb-4"><?php echo substr($row['post_content'], 0, 150); ?>...</p>
        <div class="flex justify-between items-center">
          <span class="text-gray-600 text-sm"><?php echo date('d M Y', strtotime($row['date_published'])); ?></span>
          <a href="#" class="text-blue-500 text-sm font-semibold hover:text-blue-600">Read more</a>
        </div>
      </div>
    </div>
    <?php } // end while loop ?>
    <?php if (mysqli_num_rows($result) == 0) {
      echo "<p class='text-center text-gray-600'>No blog posts found.</p>";
    } ?>
  </div>
</div>


<?php
  // Close the database connection
  mysqli_close($connection);
?>

<?php
// Include database connection code
include('Components/db/db_connection.php');
include('Components/auth.php');

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
    <label for="post_title" class="block text-gray-700 font-bold mb-2">Post Title</label>
    <input type="text" id="post_title" name="post_title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
  </div>

  <div class="mb-6">
    <label for="post_content" class="block text-gray-700 font-bold mb-2">Post Content</label>
    <textarea id="post_content" name="post_content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
  </div>
  
  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
    Submit
  </button>
</form>

<!-- Blog posts section -->
<div class="my-8 mx-auto max-w-4xl">
  <div>
    <div>
      <h2 class="text-3xl font-bold mb-4">Blog Kaunseling</h2>
      <p class="text-gray-700">Informasi dari Unit Kaunseling</p>
    </div>
    <div>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <article class="my-4">
          <div class="border-b-2 border-gray-300 mb-4 pb-4">
            <h3 class="text-2xl font-bold mb-2">
              <a href="#" class="text-blue-500 hover:text-blue-700">
                <?php echo $row['post_title']; ?>
              </a>
            </h3>
            <p class="text-gray-700"><?php echo $row['post_content']; ?></p>
          </div>
          <div>
            <p class="text-gray-600"><?php echo $row['date_published']; ?></p>
          </div>
        </article>
      <?php } ?>
    </div>
  </div>
</div>

<?php
  // Close the database connection
  mysqli_close($connection);
?>

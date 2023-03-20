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
    <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-y-16 gap-x-8 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
      <article class="flex max-w-xl flex-col items-start justify-between">
        <div class="flex items-center gap-x-4 text-xs">
        </div>
        <div class="group relative">
          <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
            <a href="#">
              <span class="absolute inset-0"></span>
              Info Terkini
            </a>
          </h3>
          <p class="mt-5 text-sm font-semibold leading-6 text-gray-700 line-clamp-3">Cara Rawatan Penyakit Mental </p>
          <p class="mt-5 text-sm leading-6 text-gray-600 line-clamp-3">Jenis-Jenis Penyakit Mental Yang Perlukan Rawatan:- Neurosis & Psikosis Penyakit mental organik seperti nyanyuk Gangguan personaliti Psikiatri di kalangan kanak-kanak seperti autism dan hipe... </p>
        </div>
        <div class="relative mt-8 flex items-center gap-x-4">
          <div class="text-sm leading-6">
            <p class="font-semibold text-gray-900">
            <a href="https://mmha.org.my/article-listing/bahasa-malaysia/cara-rawatan-penyakit-mental"> Read more..</a>
            </p>

            <p class="mt-5 text-sm font-semibold leading-6 text-gray-700 line-clamp-3">About Mental Health </p>
          <p class="mt-5 text-sm leading-6 text-gray-600 line-clamp-3">What is Mental Health? </p>
          <iframe width="420" height="345" src="https://www.youtube.com/embed/tgbNymZ7vqY">
          </iframe>

        </div>
        <div class="relative mt-8 flex items-center gap-x-4">
          <div class="text-sm leading-6">
            <p class="font-semibold text-gray-900">
            </p>

          </div>
          <div>
            <p class="text-gray-600"><?php echo $row['date_published']; ?></p>
          </div>
        </article>
      <?php 
      ?>
    </div>
  </div>
</div>

<?php
  // Close the database connection
  mysqli_close($connection);
?>

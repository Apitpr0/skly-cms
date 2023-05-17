<?php
// Include database connection code
include('Components/db/db_connection.php');
// Include header and navbar
include('Components/header.php');
include('Components/navbar.php');


// Fetch blog posts from database
$query2 = "SELECT * FROM blog_posts ORDER BY date_published";
$result2 = mysqli_query($connection, $query2);

?>


<!-- Blog posts section -->
<div class="my-8 mx-auto max-w-4xl">
  <div>
    <h2 class="text-3xl font-bold mb-4">Blog Kaunseling</h2>
    <p class="text-gray-700">Informasi dari Unit Kaunseling</p>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
    <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <a href="#" class="block">
          <img class="h-48 w-full object-cover object-center" src="uploads/<?php echo $row2['post_image']; ?>" alt="<?php echo $row2['post_title']; ?>">
        </a>

        <div class="p-6">
          <a href="#" class="block text-blue-500 font-semibold mb-2"><?php echo $row2['post_title']; ?></a>
          <p class="text-gray-700 mb-4"><?php echo substr($row2['post_content'], 0, 150); ?>...</p>
          <div class="flex justify-between items-center">
            <span class="text-gray-600 text-sm"><?php echo date('d M Y', strtotime($row2['date_published'])); ?></span>
            <a href="blog_post.php?id=<?php echo $row2['id']; ?>" class="text-blue-500 text-sm font-semibold hover:text-blue-600">Baca lagi</a>
          </div>

        </div>
      </div>
    <?php } // end while loop 
    ?>
    <?php if (mysqli_num_rows($result2) == 0) {
      echo "<p class='text-center text-gray-600'>No blog posts found.</p>";
    } ?>
  </div>
</div>


<?php
// Close the database connection
mysqli_close($connection);
include('Components/footer.php');
?>
<?php
// Include database connection code
include('Components/db/db_connection.php');
// Include header and navbar
include('Components/header.php');
include('Components/navbar.php');

// Check if form has been submitted
// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from form
    $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
    $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
    $date_published = date("Y-m-d H:i:s");

    // Handle uploaded image file
    $target_dir = "uploads/"; // Change this to the directory where you want to save the images
    $target_file = $target_dir . basename($_FILES["post_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $new_file_name = uniqid('', true) . '.' . $imageFileType;
    $target_file = $target_dir . $new_file_name;

    if (move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)) {
        // Insert new blog post into database
        $query = "INSERT INTO blog_posts (post_title, post_content, date_published, post_image) 
                VALUES ('$post_title', '$post_content', '$date_published', '$new_file_name')";
        mysqli_query($connection, $query);
        echo '<p class="text-green-700 font-bold my-4 text-center">Blog berjaya diposkan!</p>';
    } else {
        echo '<p class="text-red-700 font-bold my-4 text-center">Gagal memuatnaik gambar.</p>';
    }
}


// Fetch blog posts from database
$query2 = "SELECT * FROM blog_posts ORDER BY date_published";
$result2 = mysqli_query($connection, $query2);

?>

<!-- Blog submission form -->
<form method="post" enctype="multipart/form-data" class="my-8 mx-auto max-w-lg">
    <div class="mb-4">
        <label for="post_title" class="block text-gray-700 font-bold mb-2">Tajuk</label>
        <input type="text" id="post_title" name="post_title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="mb-6">
        <label for="post_content" class="block text-gray-700 font-bold mb-2">Mesej</label>
        <textarea id="post_content" name="post_content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
    </div>

    <div class="mb-6">
        <label for="post_image" class="block text-gray-700 font-bold mb-2">Gambar</label>
        <input type="file" id="post_image" name="post_image" accept="image/*">
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Hantar
    </button>
</form>


<!-- Blog posts section -->
<div class="my-8 mx-auto max-w-4xl">
    <div>
        <h2 class="text-3xl font-bold mb-4">Selamat Datang Pentadbir ke Blog</h2>
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
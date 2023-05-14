<?php
// Include database connection code
include('Components/db/db_connection.php');
//include('Components/auth.php');

// Get post ID from URL parameter
if (!isset($_GET['id'])) {
    header("Location: blog.php");
    exit();
}
$post_id = $_GET['id'];

// Fetch blog post from database
$query = "SELECT * FROM blog_posts WHERE id = $post_id LIMIT 1";
$result = mysqli_query($connection, $query);

// Redirect to blog page if post not found
if (mysqli_num_rows($result) == 0) {
    header("Location: blog.php");
    exit();
}

// Get post data
$row = mysqli_fetch_assoc($result);
$post_title = $row['post_title'];
$post_content = $row['post_content'];
$date_published = date('d M Y', strtotime($row['date_published']));

// Include header and navbar
include('Components/header.php');
include('Components/navbar.php');
?>

<div class="my-8 mx-auto max-w-4xl">
    <div>
        <h2 class="text-3xl font-bold mb-4 leading-tight text-black"> <?php echo $post_title; ?></h2>
        <p class="text-gray-700 text-sm">Published on <?php echo $date_published; ?></p>
    </div>
    <div class="mt-8">
        <p class="text-gray-700 leading-relaxed"><?php echo $post_content; ?></p>
    </div>
</div>


<?php
// Close the database connection
mysqli_close($connection);
?>
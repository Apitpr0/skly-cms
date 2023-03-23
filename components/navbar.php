<?php
include('Components/db/db_connection.php');
session_start();

$links = array(
  array("name" => "Laman Utama", "url" => "index.php"),
  array("name" => "Tempah", "url" => "booking.php"),
  array("name" => "Pengakuan", "url" => "anonconn.php"),
  array("name" => "Blog", "url" => "blog.php"),
  array("name" => "Hubungi Kami", "url" => "contact_us.php")
);
?>

<nav class="">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <!-- Logo and company name -->
      <div class="flex-shrink-0 flex items-center">
        <img class="h-8 w-8" src="Components/assets/img/school_logo.png" alt="Logo">
        <span class="text-black font-bold ml-2">SKLY Counselling Management System</span>
      </div>
      <!-- Link and profile picture -->
      <div class="flex items-center bg-white p-1 rounded">
        <?php foreach($links as $link) { ?>
          <a href="<?php echo $link['url']; ?>" class="text-black hover:bg-gray-700 hover:text-white px-1 py-2 rounded-md text-sm font-medium mr-4"><?php echo $link['name']; ?></a>
        <?php } 
          $ic = $_SESSION["ic"];
          $result = mysqli_query($connection, "SELECT * FROM users WHERE ic='$ic'");
          $row = mysqli_fetch_assoc($result);
          $picture_base64 = !empty($row['profile_picture']) ? $row['profile_picture'] : "Components/assets/img/emptyprofilepicture.jpg";
        ?>
        <a href="profile.php">
          <img class="w-10 h-10 rounded-full" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($picture_base64); ?>" alt="Profile Picture">
        </a>
      </div>
    </div>
  </div>
</nav>

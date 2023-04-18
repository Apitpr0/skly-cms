<?php
include('Components/db/db_connection.php');
session_start();

$links = array(
  array("name" => "Laman Utama", "url" => "index.php"),
  array("name" => "Tempah", "url" => "booking.php"),
  array("name" => "Pengakuan", "url" => "anonconn.php"),
  array("name" => "Kuiz ", "url" => "quiz.php"),
  array("name" => "Blog", "url" => "blog.php"),
  array("name" => "Hubungi Kami", "url" => "contact_us.php")
);
?>

<nav class="w-full">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <!-- Logo and company name -->
      <div class="flex-shrink-0 flex items-center">
        <img class="h-12 w-12" src="components/assets/img/school_logo.png" alt="Logo">
        <span class="text-black font-bold ml-2">Sistem Pengurusan Kaunseling</span>
      </div>
      <!-- Link and profile picture -->
      <div class="flex items-center p-1 rounded">
        <?php foreach($links as $link) { ?>
          <a href="<?php echo $link['url']; ?>" class="text-black hover:bg-gray-700 hover:text-white px-1 py-2 rounded-md text-sm font-medium mr-4"><?php echo $link['name']; ?></a>
        <?php } 
          $ic = $_SESSION["ic"];
          $result = mysqli_query($connection, "SELECT * FROM users WHERE ic='$ic'");
          $row = mysqli_fetch_assoc($result);
          $picture_base64 = !empty($row['profile_picture']) ? 'data:image/jpg;charset=utf8;base64,' . base64_encode($row['profile_picture']) : "components/assets/img/emptyprofilepicture.jpg";
        ?>
        <a href="profile.php">
          <img class="w-10 h-10 rounded-full" src="<?php echo $picture_base64; ?>" alt="Profile Picture">
        </a>
      </div>
    </div>
  </div>
</nav>



<?php
include('Components/db/db_connection.php');
session_start();
$ic = $_SESSION["ic"];
$result = mysqli_query($connection, "SELECT * FROM users WHERE ic='$ic'");
while ($res = mysqli_fetch_array($result)) {
  $NAME = $res["name"];
}
$links = array(
  array("name" => "Laman Utama", "url" => "index.php"),
  array("name" => "Tempah", "url" => "booking.php"),
  array("name" => "Pengakuan", "url" => "anonconn.php"),
  array("name" => "Blog", "url" => "blog.php"),
  array("name" => "Hubungi Kami", "url" => "contact_us.php")
);
$picture_base64 = !empty($row['profile_picture']) ? 'data:image/jpg;charset=utf8;base64,' . base64_encode($row['profile_picture']) : "components/assets/img/emptyprofilepicture.jpg";
?>
<nav class="w-full border-gray-200">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="index.php" class="flex items-center bg-card p-4 rounded-lg">
      <img src="components/assets/img/school_logo.png" class="h-8 mr-3" alt="Flowbite Logo" />
      <span class="text-black font-bold ml-2">Sistem Pengurusan Kaunseling</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
      </svg>
    </button>
    <div class="bg-card p-4 rounded-lg hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
        <?php foreach ($links as $link) { ?>
          <li>
            <a href="<?php echo $link['url']; ?>" class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"><?php echo $link['name']; ?></a>
          </li>
        <?php } ?>
        <div class="flex items-center md:order-2">
          <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
            <span class="sr-only">Open user menu</span>
            <img class="w-10 h-10 rounded-full" src="<?php echo $picture_base64; ?>" alt="components/assets/img/emptyprofilepicture.jpg">
          </button>
          <!-- Dropdown menu -->
          <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
            <div class="px-4 py-3">
              <span class="block text-sm text-gray-900 dark:text-white"><?php echo $NAME; ?></span>
            </div>
            <ul class="py-2" aria-labelledby="user-menu-button">
              <li>
                <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Tetapan</a>
              </li>
              <li>
                <a href="components/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Log Keluar</a>
              </li>
            </ul>
          </div>
        </div>
      </ul>
    </div>
  </div>
</nav>
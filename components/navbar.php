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
$picture_base64 = !empty($row['profile_picture']) ? 'data:image/jpg;charset=utf8;base64,' . base64_encode($row['profile_picture']) : "components/assets/img/emptyprofilepicture.jpg";
?>

<nav class="w-full bg-transparent">
  <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <!-- Logo and company name -->
      <a href="index.php" class="flex-shrink-0 flex items-center">
        <img class="h-12 w-12" src="components/assets/img/school_logo.png" alt="Logo">
        <span class="text-black font-bold ml-2">Sistem Pengurusan Kaunseling</span>
      </a>

      <!-- Mobile menu options -->
      <div class="hidden sm:flex sm:items-center sm:ml-6" id="mobile-menu">
        <?php foreach ($links as $link) { ?>
          <a href="<?php echo $link['url']; ?>" class="text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium mr-4"><?php echo $link['name']; ?></a>
        <?php } ?>
        <a href="profile.php">
          <img class="w-10 h-10 rounded-full mt-4" src="<?php echo $picture_base64; ?>" alt="components/assets/img/emptyprofilepicture.jpg">
        </a>
      </div>

      <!-- Hamburger menu -->
      <div class="flex sm:hidden">
        <div class="relative">
          <button type="button" class="text-black hover:bg-gray-700 hover:text-white inline-flex items-center justify-center p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" aria-controls="mobile-menu" aria-expanded="false" onclick="toggleMobileMenu()">
            <span class="sr-only">Open main menu</span>
            <!-- Hamburger icon -->
            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <!-- Close icon -->
            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>

          <!-- Menu options -->
          <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-200 z-10 hidden" id="mobile-menu">
            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="mobile-menu">
              <?php foreach ($links as $link) { ?>
                <a href="<?php echo $link['url']; ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem"><?php echo $link['name']; ?></a>
              <?php } ?>
            </div>
            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="mobile-menu">
              <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Profile</a>
            </div>
          </div>
        </div>
      </div>

</nav>

<script>
  function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
  }

  function closeMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.add('hidden');
  }

  window.addEventListener('resize', function() {
    const windowWidth = window.innerWidth;
    const breakpoint = 640; // Adjust this value to your desired breakpoint

    if (windowWidth > breakpoint) {
      closeMobileMenu();
    }
  });

  // Close mobile menu on outside click
  document.addEventListener('click', function(event) {
    const mobileMenu = document.getElementById('mobile-menu');
    const isClickInsideMenu = mobileMenu.contains(event.target);
    const isClickOnHamburger = event.target.closest('.flex').classList.contains('sm:hidden');

    if (!isClickInsideMenu && !isClickOnHamburger) {
      closeMobileMenu();
    }
  });
</script>
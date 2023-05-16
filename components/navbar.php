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
<nav class="w-full border-gray-200">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="index.php" class="flex items-center bg-card p-4 rounded-lg">
      <div id="logoContainer">
        <img id="logo" src="components/assets/img/school_logo.png" class="h-12 mr-3" alt="Flowbite Logo" />
      </div>

      <script src="components/js/spinny.js"></script>



      <div id="textContainer">
        <span id="boldText" class="text-black font-bold ml-2"></span>
        <script src="components/js/scroll.js"></script>
      </div>

    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
      </svg>
    </button>
    <div class="bg-card p-4 rounded-lg hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0" id="navbar-options">
      </ul>
    </div>
  </div>
</nav>

<script>
  // Data for the navbar options
  const links = [{
      name: "Laman Utama",
      url: "index.php"
    },
    {
      name: "Tempah",
      url: "booking.php"
    },
    {
      name: "Pengakuan",
      url: "anonconn.php"
    },
    {
      name: "Blog",
      url: "blog.php"
    },
    {
      name: "Hubungi Kami",
      url: "contact_us.php"
    },
    {
      name: "Profile",
      url: "profile.php",
      image: "components/assets/img/emptyprofilepicture.jpg"
    }
  ];

  // Get the navbar options container
  const navbarOptions = document.getElementById("navbar-options");

  // Generate the HTML for the navbar options
  const optionsHTML = links
    .map(link => {
      if (link.image) {
        return `
          <li>
            <a href="${link.url}" class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-black md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-black md:dark:hover:bg-transparent">
            <img class="w-10 h-10 rounded-full" src="${link.image}" alt="${link.name}">
        </a>
      </li>
    `;
      } else {
        return `
      <li>
        <a href="${link.url}" class="block py-2 pl-3 pr-4 text-black rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-black md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-black md:dark:hover:bg-transparent">${link.name}</a>
      </li>
    `;
      }
    })
    .join("");
  // Set the generated HTML as the content of the navbar options container
  navbarOptions.innerHTML = optionsHTML;
</script>
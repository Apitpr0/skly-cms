<?php
include('Components/db/db_connection.php');
include('Components/header.php');
include('Components/navbar.php');
include('Components/auth.php');
$ic = $_SESSION['ic']
?>
<h1 class="pl-10 font-medium leading-tight text-5xl pt-1 text-black">ADMIN DASHBOARD</h1>
<div class="p-8 m-8 bg-gray-400 rounded-lg">
    <?php
    $data = mysqli_query($connection, "SELECT * FROM users WHERE ic='$ic'");
    $info = mysqli_fetch_array($data);
    ?>
    <b class="text-lg text-white">WELCOME ADMIN <?php echo strtoupper(
        $info["name"]
    ); ?></b><br>
    <button type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out"><a href="components/logout.php">Logout</a></button>
    <button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"><a href=""></a></button>
  </div>
<?php
include('Components/footer.php');
?>
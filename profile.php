<?php
include('Components/db/db_connection.php');
include('Components/header.php');
include('Components/navbar.php');
include('Components/auth.php');
$user = "users"
//  $profile_picture = $picture_base64 ? "data:image/jpeg;base64,$picture_base64" : "Components/assets/img/emptyprofilepicture.jpg";

?>
<div class="mx-auto">
<h1 class="text-purple-900 font-bold">Helo , Selamat Datang <?php echo $user ?></h1>
<div class="flex justify-between items-center">
    <div class="w-1/2">
        <img class="rounded-xl w-96 border-8 border-pink-500" src="Components/assets/img/emptyprofilepicture.jpg" alt="">
    </div>
    <div class="w-1/2">
        <div class="border-8 border-pink-500  rounded-xl bg-white p-8">
            <p>Muhammad Afiq Muhaimin bin Mohd Zain</p>
            <p>020926-07-0255</p>
            <p>KELAS : MURTIARA 5</p>
            <p>PASSWORD : ********NIG</p>
            <p>Risk</p>
        </div>
    </div>
</div>
</div>
<?php
include('Components/footer.php');
?>
<?php
include('Components/db/db_connection.php');
include('Components/header.php');
include('Components/navbar.php');
include('Components/auth.php');
$is_admin = $_SESSION['is_admin'];
if (isset($_POST["update"])) {
  $fileName = basename($_FILES["image"]["name"]);
  $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
  $allowTypes = ["jpg", "png", "jpeg", "gif"];
  $IC = $_POST["IC"];
  $PASS = $_POST["PASS"];
  $NAMES = $_POST["NAMES"];
  $hashed_password = hash('sha512', $PASS);
  if (in_array($fileType, $allowTypes)) {
    $image = $_FILES["image"]["tmp_name"];
    $imgContent = addslashes(file_get_contents($image));
    $result = mysqli_query(
      $connection,
      "UPDATE users SET profile_picture='$imgContent',name='$NAMES' WHERE ic='$IC'"
    );
  } else {
    $errorMessage = "Invalid file type. Allowed file types are " . implode(", ", $allowTypes);
    die($errorMessage);
  }
} else if (isset($_POST['submit2'])) {
  if ($is_admin == 1) {
    header('Location: dashboard_admin.php');
  } else {
    header('Location: index.php');
  }



  if ($result) { ?>
    <main x-data="{ open: false }">
      <button type="button" @click="open = true; setTimeout(() => open = false, 50)" x-show="!open" x-transition.duration.300ms class="fixed top-4 right-4 z-50 rounded-md bg-green-500 px-4 py-2 text-white transition hover:bg-green-600" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="flex items-center space-x-2">
          <span class="text-3xl"><i class="bx bx-check"></i></span>
          <p class="font-bold">Berjaya!</p>
        </div>
      </button>
    </main>


  <?php } else { ?>
    <main x-data="app">
      <button type="button" @click="closeToast()" x-show="open" x-transition.duration.300ms class="fixed top-4 right-4 z-50 rounded-md bg-green-500 px-4 py-2 text-white transition hover:bg-green-600" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="flex items-center space-x-2">
          <span class="text-3xl"><i class="bx bx-x"></i></span>
          <p class="font-bold">Tidak Berjaya, Sila cuba lagi</p>
        </div>
      </button>
    </main>
<?php }
}
?>
<div class="p-8 m-8 bg-white rounded-lg">
  <form method="post">
    <button type="submit" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" name="submit2">Kembali</button>
    <a href="components/logout.php" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
      Log Keluar
    </a>
    <a href="update_password.php" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
      Kemaskini Kata Laluan
    </a>

  </form>

</div>
<?php
$ic = $_SESSION["ic"];
$result = mysqli_query($connection, "SELECT * FROM users WHERE ic='$ic'");
while ($res = mysqli_fetch_array($result)) {
  $ic = $res["ic"];
  $NAME = $res["name"];
}
?>
<div class="flex items-center justify-center">
  <div class="px-8 py-6 mt-20 text-left bg-white shadow-lg rounded-lg">
    <h3 class="text-2xl font-bold">Kemaskini Maklumat <?php echo $NAME; ?></h3>
    <form method="post" enctype='multipart/form-data'>
      <div class="mt-4">
        <div class="mt-4">
          <label class="block" for="file_input">Masukkan Gambar anda [Tinggalkan kosong jika tiada perubahan]</label>
          <input type="file" name="image">
        </div>
        <div class="mt-4">
          <label class="block">IC</label>
          <input name="IC" type="text" readonly="readonl" class="w-full px-4 py-2 mt-2 border bg-gray-500 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" maxlength="5" value="<?php echo $ic; ?>">
        </div>
        <div class="mt-4">
          <label class="block">Nama</label>
          <input name="NAMES" type="text" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" value="<?php echo $NAME; ?>">
        </div>
        <div class="flex items-baseline justify-between">
          <button type="submit" name="update" class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Kemaskini</button>
          <button type="reset"><a class="text-sm text-blue-600 hover:underline">Clear</a></button>
        </div>
      </div>
    </form>
  </div>
</div>
<?php include "Components/footer.php"; ?>
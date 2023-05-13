<?php
include('Components/header.php');
error_reporting(0);
?>
<?php
include('Components/db/db_connection.php');
include('Components/navbar.php');
//include files for phpmailer
require 'Components/phpmailer/Exception.php';
require 'Components/phpmailer/PHPMailer.php';
require 'Components/phpmailer/SMTP.php';
//define name space
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $cl_name = $_POST['name'];
  $cl_email = $_POST['email'];
  $cl_message = $_POST['message'];

  //Insert data into db
  $query = "INSERT INTO contact (name,email,message) VALUES ('$cl_name','$cl_email','$cl_message')";
  mysqli_query($connection, $query);

  //Check if data was inserted
  if (mysqli_affected_rows($connection) > 0) {
    echo '<div class="bg-green-500 text-white font-bold py-2 px-4 rounded mb-4">Message sent!</div>';
  } else {
    echo '<div class="bg-red-500 text-white font-bold py-2 px-4 rounded mb-4">Message not sent</div>';
  }
}
?>

<body>
  <form method="POST" class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-black">Hubungi Kami</h2>
    <p class="mb-8 lg:mb-16 font-light text-center text-black sm:text-xl">Anda mempunyai masalah? Hubungi kami untuk mendapatkan bantuan.</p>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      <div>
        <label for="name" class="block mb-2 text-sm font-medium text-black">Nama</label>
        <input type="text" id="name" name="name" class="block w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-100 dark:border-gray-300 dark:placeholder-gray-500 dark:text-gray-900 dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Masukkan Nama" required>
      </div>
      <div>
        <label for="email" class="block mb-2 text-sm font-medium text-black">Emel anda</label>
        <input type="email" id="email" name="email" class="block w-full p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-100 dark:border-gray-300 dark:placeholder-gray-500 dark:text-gray-900 dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Emel anda" required>
      </div>
    </div>
    <div class="col-span-2">
      <label for="message" class="block mb-2 text-sm font-medium text-black">Mesej anda</label>
      <textarea id="message" name="message" rows="6" class="block w-full p-2.5 text-sm text-gray-900 bg-white rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-100 dark:border-gray-300 dark:placeholder-gray-500 dark:text-gray-900 dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Tinggalkan mesej anda"></textarea>
    </div>
    <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-black rounded-lg bg-white border border-gray-300 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-blue-500 dark:text-white dark:hover:bg-blue-500 dark:focus:ring-primary-800">Hantar Mesej</button>
  </form>
</body>

<?php include('Components/footer.php'); ?>

<?php
// Create a new PHPMailer instance
require_once "config/config.php";
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "tls";
$mail->Port = "587";
$mail->Username = "apitpro123@gmail.com";
$mail->Password = $gm_pass;
$mail->Subject = "SKLY-CMS: Mesej dari Pengguna";
$mail->setFrom($_POST['email']);
$mail->addAddress("apitpro123@gmail.com");
$mail->isHTML(true);
$mail->Body = ($_POST['message']);
$mail->send();
?>
<?php include('Components/footer.php'); ?>
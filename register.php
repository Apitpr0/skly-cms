<?php
require('components/db/db_connection.php');
include('Components/header.php');
if (isset($_POST['submit'])) {
    $ic = mysqli_real_escape_string($connection, $_POST['ic']);
    $password = $_POST['password'];
    $cPass = $_POST['cpass'];
    $nama = $_POST['name'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0; // check if the checkbox is checked

    if (empty($ic)) {
        $msg = "Kotak IC tidak boleh kosong";
    } elseif (mysqli_num_rows(mysqli_query($connection, "SELECT * FROM USERS WHERE ic='$ic'")) > 0) {
        $msg = "IC telah wujud dalam pangkalan data";
    } elseif ($password != $cPass) {
        $msg = "Kata Laluan tidak sama";
    } elseif (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-zA-Z]+#", $password)) {
        $msg = "Kata Laluan mesti sekurang-kurangnya 8 aksara dan mengandungi sekurang-kurangnya satu nombor dan satu huruf";
    } else {
        $hashed_password = hash('sha512', $password);
        if (!mysqli_query($connection, "INSERT INTO USERS (ic, name, password) VALUES ('$ic', '$nama', '$hashed_password')")) {
            $msg = "An error occurred while registering. Please try again.";
        } else {
            header("Location: login.php");
            exit;
        }
    }
}
?>

<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Daftar</h2>
        <?php
        if (isset($msg)) {
            echo '<div class="mt-2 text-center text-sm text-red-600">' . $msg . '</div>';
        }
        ?>
        <form class="mt-8 space-y-6" method="post">
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="ic" class="sr-only">No Kad Pengenalan</label>
                    <input id="ic" name="ic" type="textbox" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="No Kad Pengenalan">
                </div>
                <div>
                    <label for="name" class="sr-only">Nama</label>
                    <input id="name" name="name" type="textbox" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Nama anda">
                </div>
                <div>
                    <label for="password" class="sr-only">Kata Laluan</label>
                    <input id="password" name="password" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Kata Laluan">
                </div>
                <div>
                    <label for="cpass" class="sr-only">Sahkan Kata Laluan</label>
                    <input id="cpass" name="cpass" type="password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Sahkan Kata Laluan">
                </div>
            </div>



            <div>
                <button type="submit" name="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Hantar
                </button>
            </div>
        </form>
    </div>
</div>
<?php
include('Components/header.php');
?>
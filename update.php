<?php
include 'components/db/db_connection.php';
include 'components/header.php';
include 'components/footer.php';

if (isset($_POST['submit'])) {
    $appt_id = $_POST['appt_id'];
    $name = $_POST['name'];
    $appt_date = $_POST['appt_date'];

    // update the appointment record
    $sql = "UPDATE appointment SET name='$name', appointment_date='$appt_date' WHERE appt_id='$appt_id'";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo "Rekod Temujanji berjaya dikemaskini!";
    } else {
        echo "Ralat mengemaskini rekod temujanji: " . mysqli_error($connection);
    }
}
?>

<div class="max-w-md mx-auto py-4">
    <h1 class="text-2xl font-bold mb-4">Kemaskini Temujanji</h1>
    <?php
    if (isset($_GET['appt_id'])) {
        $appt_id = $_GET['appt_id'];
        $sql = "SELECT * FROM appointment WHERE appt_id='$appt_id'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    ?>
            <form method="post" action="">
                <input type="hidden" name="appt_id" value="<?php echo $row['appt_id']; ?>">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="name">Nama Kaunselor:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="name" id="name" value="<?php echo $row['name']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="appt_date">Tarikh Temujanji:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="datetime-local" name="appt_date" id="appt_date" value="<?php echo date('Y-m-d\TH:i', strtotime($row['appointment_date'])); ?>">
                </div>
                <div class="flex items-center justify-between">
                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit" value="Kemaskini">
                    <a href="dashboard_admin.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Kembali ke paparan admin</a>
                </div>
            </form>
    <?php
        } else {
            echo "Tiada rekod temujanji dijumpai.";
        }
    } else {
        echo "Invalid request.";
    }
    ?>
</div>

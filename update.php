<?php
include('Components/db/db_connection.php');
include('Components/header.php');
include('Components/navbar.php');

if(isset($_POST["update"])) {
    $id = $_POST["appt_id"];
    $date_t = $_POST["date_time"];
    $counsellor = $_POST["name"];
    
    $result = mysqli_query(
        $connection,
        "UPDATE appointment SET appointment_date='$date_t', name='$counsellor' WHERE appt_id='$id'"
    );
    
    if($result) { 
        ?>
        <div class="bg-green-200 text-green-800 rounded-md p-4 mb-4">
            Appointment updated successfully!
        </div>
        <?php 
    } else { 
        ?>
        <div class="bg-red-200 text-red-800 rounded-md p-4 mb-4">
            Failed to update appointment!
        </div>
        <?php 
    }
}

if (isset($_GET['appt_id'])) {
  $appt_id = $_GET['appt_id'];
  $result = mysqli_query($connection, "SELECT * FROM appointment WHERE appt_id='$appt_id'");
  $res = mysqli_fetch_array($result);
  $date = $res["appointment_date"];
  $counsellor = $res["name"];
} 

?>

<div class="p-8 m-8 bg-white rounded-lg">
    <button type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
        <a href="dashboard_admin.php">Kembali ke admin</a>
    </button>
</div>

<div class="flex items-center justify-center">
    <div class="px-8 py-6 mt-20 text-left bg-white shadow-lg rounded-lg">
        <h3 class="text-2xl font-bold">Kemaskini Temujanji</h3>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $appt_id; ?>">
            <div class="mt-4">
                <label class="block">Tarikh dan Masa</label>
                <input name="date_time" type="datetime-local" required class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" value="<?php echo date('Y-m-d\TH:i', strtotime($date . ' ' . $time)); ?>">
            </div>
            <div class="mt-4">
                <label class="block">Kaunselor</label>
                <input name="counsellor" type="text" required class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" value="<?php echo $counsellor; ?>">

            </div>
            <div class="mt-8">
                <button type="submit" name="update" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Kemaskini</button>
            </div>
        </form>
    </div>
</div>

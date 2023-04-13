<?php
include('Components/db/db_connection.php');
include('Components/navbar.php');
include('Components/footer.php');
include('Components/header.php');

//check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $counselor_name=$_POST['counselor-name'];
    $session_time=$_POST['session-time'];
    $status=$_POST['counseling-type'];
    $icnum=$_POST['client-ic'];
    $phone=$_POST['client-phone'];
	$topics=$_POST['client-topic'];

//Insert data into db
    $query="INSERT INTO appointment (name,appointment_date,status,topics,phone_number) VALUES ('$counselor_name','$session_time','$status','$topics','$phone')";
    mysqli_query($connection, $query);

    //Check if data was inserted
    if (mysqli_affected_rows($connection) > 0) {
        echo "Tempahan Disahkan";
    } else {
        echo "Tempahan Tidak Disahkan, sila cuba lagi";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Booking Form</title>
	<!-- Add Tailwind CSS CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.17/tailwind.min.css">
</head>
<body class="bg-gray-100">

	<div class="container mx-auto my-4 p-4 bg-white rounded-lg shadow-lg">
		<h2 class="text-xl font-bold mb-4">Tempah sesi kaunseling anda</h2>

		<form method="POST">
			<div class="mb-4">
				<label for="counselor-name" class="block text-gray-700 font-bold mb-2">Nama Kaunselor:</label>
				<input type="text" id="counselor-name" name="counselor-name" class="w-full p-2 border rounded-md" required>
			</div>

			<div class="mb-4">
				<label for="session-time" class="block text-gray-700 font-bold mb-2">Waktu Sesi:</label>
				<input type="datetime-local" id="session-time" name="session-time" class="w-full p-2 border rounded-md" required>
			</div>

			<div class="mb-4">
				<label for="counseling-type" class="block text-gray-700 font-bold mb-2">Jenis Kaunseling:</label>
				<select id="counseling-type" name="counseling-type" class="w-full p-2 border rounded-md" required>
					<option value="">--Pilih Jenis Kaunseling--</option>
					<option value="Individual Counseling">Kaunseling Individu</option>
					<option value="Couples Counseling">Kaunseling Kelompok</option>
				</select>
			</div>

			<div class="mb-4">
				<label for="client-topic" class="block text-gray-700 font-bold mb-2">Topik yang ingin Dibincangkan:</label>
				<input type="topic" id="client-topic" name="client-topic" class="w-full p-2 border rounded-md" required>
			</div>

			<div class="mb-4">
				<label for="client-name" class="block text-gray-700 font-bold mb-2">Nombor IC:</label>
				<input type="text" id="client-ic" name="client-ic" class="w-full p-2 border rounded-md" value="<?php echo $_SESSION['ic']; ?>">
			</div>

			<div class="mb-4">
				<label for="client-phone" class="block text-gray-700 font-bold mb-2">Nombor Telefon:</label>
				<input type="tel" id="client-phone" name="client-phone" class="w-full p-2 border rounded-md" required>
			</div>

			<button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
			  Tempah
			</button>
		</form>

	</div>

</body>
</html>

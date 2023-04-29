<?php
include('Components/db/db_connection.php');
include('Components/header.php');
include('Components/navbar.php');
include('Components/footer.php');


//check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$counselor_name = $_POST['counselor-name'];
	$session_time = $_POST['session-time'];
	$session_date = $_POST['session-date']; // added session date
	$status = $_POST['counseling-type'];
	$icnum = $_POST['client-ic'];
	$phone = $_POST['client-phone'];
	$topics = $_POST['client-topic'];

	//Convert session_time to datetime format
	$session_datetime = date("Y-m-d H:i:s", strtotime($session_date . " " . $session_time));

	//Insert data into db
	$query = "INSERT INTO appointment (name,appointment_date,status,topics,phone_number) VALUES ('$counselor_name','$session_datetime','$status','$topics','$phone')";
	mysqli_query($connection, $query);

	//Check if data was inserted
	if (mysqli_affected_rows($connection) > 0) {
		echo "Tempahan Disahkan";
	} else {
		echo "Tempahan Tidak Disahkan, sila cuba lagi";
	}
}
?>

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
				<select id="session-time" name="session-time" class="w-full p-2 border rounded-md" required>
					<option value="">Pilih Waktu Sesi</option>
					<option value="08:00:00">8-9 AM</option> <!-- converted to datetime format -->
					<option value="10:00:00">10-11 AM</option>
					<option value="12:00:00">12-1 PM</option>
				</select>
			</div>

			<div class="mb-4">
				<label for="session-date" class="block text-gray-700 font-bold mb-2">Tarikh Sesi:</label>
				<input type="date" id="session-date" name="session-date" class="w-full p-2 border rounded-md" required>
				<span id="date-error" class="text-red-500 hidden">Sila pilih tarikh lain. Sesi tidak diadakan pada hujung minggu.</span>
			</div>

			<script>
				const dateInput = document.getElementById('session-date');
				const dateError = document.getElementById('date-error');

				dateInput.addEventListener('change', () => {
					const selectedDate = new Date(dateInput.value);
					const dayOfWeek = selectedDate.getDay();

					if (dayOfWeek === 0 || dayOfWeek === 6) {
						dateError.classList.remove('hidden');
						dateInput.setCustomValidity('Sila pilih tarikh lain. Sesi tidak diadakan pada hujung minggu.');
					} else {
						dateError.classList.add('hidden');
						dateInput.setCustomValidity('');
					}
				});
			</script>



			<div class="mb-4">
				<label for="counseling-type" class="block text-gray-700 font-bold mb-2">Jenis Kaunseling:</label>
				<select id="counseling-type" name="counseling-type" class="w-full p-2 border rounded-md" required>
					<option value="">Pilih Jenis Kaunseling</option>
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
<?php
include('Components/db/db_connection.php');
include('Components/header.php');
include('Components/navbar.php');
include('Components/auth.php');
$ic = $_SESSION['ic'];

?>
<h1 class="pl-10 font-medium leading-tight text-5xl pt-1 text-black">ADMIN DASHBOARD</h1>
<div class="p-8 m-8 bg-gray-400 rounded-lg">
  <?php
  $data = mysqli_query($connection, "SELECT * FROM users WHERE ic='$ic'");
  $info = mysqli_fetch_array($data);
  ?>
  <b class="text-lg text-white">Selamat Datang ADMIN
    <?php echo strtoupper($info["name"]); ?></b><br>
  <button type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" onclick="location.href='components/logout.php';">Log Keluar</button>
  <button type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" onclick="location.href='blocked_user.php';">Pengguna Disekat</button>
  <button type="button" class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" onclick="location.href='report_gen.php';">Jana Laporan</button>
  <!---<button type="button" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"><a href=""></a></button>!--->
</div>
<center><u class="text-black">Senarai Temujanji</u></center>
<div class="px-8 pb-6 mt-4 flex flex-col ">
  <div class=" sm:-mx-6 lg:-mx-8">
    <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden rounded-lg">
        <table class="min-w-full text-center">
          <thead class="border-b bg-gray-500">
            <tr>
              <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                Pengguna
              </th>
              <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                Topik
              </th>
              <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                Tarikh
              </th>
              <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                Status
              </th>
              <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                Ditugaskan Kepada
              </th>
              <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                Tindakan
              </th>
            </tr>
          </thead class="border-b">
          <tbody>
            <?php
            $data = mysqli_query($connection, "SELECT * FROM appointment");
            while ($info = mysqli_fetch_array($data)) { ?>
              <tr class="bg-gray-400 border-b">
                <td class="text-base text-white font-medium px-6 py-4 whitespace-nowrap">
                  <?php
                  //$icUser = $info["ic"];
                  //echo $ic;
                  $result = mysqli_query($connection, "SELECT * FROM users WHERE ic='$ic'");
                  $row = mysqli_fetch_assoc($result);
                  $picture_base64 = !empty($row['profile_picture']) ? 'data:image/jpg;charset=utf8;base64,' . base64_encode($row['profile_picture']) : "components/assets/img/emptyprofilepicture.jpg";
                  ?>
                  <img class="object-cover w-full h-28 rounded-lg" src="<?php echo $picture_base64; ?>" />
                </td>
                <td class="text-base text-white font-medium px-6 py-4 whitespace-nowrap">
                  <?php echo $info["topics"]; ?>
                </td>
                <td class="text-base text-white font-medium px-6 py-4 whitespace-nowrap">
                  <?php $date_Appointment = $info["appointment_date"];
                  $startDate = strtotime(date('Y-m-d', strtotime($date_Appointment)));
                  $currentDate = strtotime(date('Y-m-d'));
                  if ($startDate < $currentDate) {
                    echo '<span class="text-red-500 font-bold text-2xl">Tarikh sudah melepasi masa yang ditetapkan, sila ubah tarikh temujanji</span>';
                  } else {
                    echo $date_Appointment;
                  }
                  ?>
                </td>
                <td class="text-base text-white font-medium px-6 py-4 whitespace-nowrap">
                  <?php echo $info["status"]; ?>
                </td>
                <td class="text-base text-white font-medium px-6 py-4 whitespace-nowrap">
                  <?php echo $info["name"]; ?>
                </td>
                <td class="text-base text-white font-medium px-6 py-4 whitespace-nowrap">
                  <div class="flex space-x-2 justify-center">
                    <div>
                      <button type="button" class="inline-block px-6 py-2.5 bg-blue-800 text-white font-medium text-xs leading-tight uppercase rounded shadow-lg hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"><a href="update.php?appt_id=<?php echo $info["appt_id"]; ?>">Kemaskini</a></button>
                      <button type="button" data-modal-toggle="staticModal" class="inline-block px-6 py-2.5 bg-red-800 text-white font-medium text-xs leading-tight uppercase rounded shadow-lg hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                        <a href="update.php?appt_id=<?php echo $info["appt_id"]; ?>">Padam</a>
                      </button>
                    </div>
                    <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
                      <div class="relative w-full max-w-2xl h-full md:h-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                          <!-- Modal header -->
                          <div href="padamappointments.php" class="flex justify-between items-start p-4 rounded-t bg-red-700 border-b dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-white">
                              DELETE!
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="staticModal">
                              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                              </svg>
                            </button>
                          </div>
                          <!-- Modal body -->
                          <div class="p-6 space-y-6">
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                              Are you sure want to delete this data?
                            <p class="text-red-300">this action is irreversible!</p>
                            </p>
                          </div>
                          <!-- Modal footer -->
                          <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                            <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"><a href="padamappointments.php?delete_id=<?php echo $info["appt_id"]; ?>">YES DELETE! <?php echo $info["appt_id"] ?></a></button>
                            <button data-modal-toggle="staticModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">CANCEL</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
      </div>
      </td>
    <?php }
    ?>
    </tr>
    </tbody>
    </table>
    </div>
  </div>
</div>
</div>
<?php
include('Components/footer.php');
?>